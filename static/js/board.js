const data = null;
const xhr = new XMLHttpRequest();

const roomType      = document.querySelector("#search-room-type")
const roomAvailable = document.querySelector("#search-available")
const roomDates   = document.querySelector("#search-date")
const roomDateMin   = document.querySelector("#search-date-min")
const roomDateMax   = document.querySelector("#search-date-max")
const roomSubmit    = document.querySelector("#search-submit")
const roomList      = document.querySelector("#room-list")

xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function() {
    if (this.readyState === this.DONE) {
        constructRoomList(JSON.parse(this.response))
    }
});

roomAvailable.addEventListener("change", (e) => {
    roomDates.style.display = e.target.value != "" ? "flex" : "none"
})

roomSubmit.addEventListener("click", () => {
    let queries = ""
    queries += roomType.value !== ""        ? "&type=" + roomType.value : ""
    queries += roomAvailable.value !== ""   ? "&available=" + roomAvailable.value : ""
    queries += roomDateMin.value !== ""     ? "&date-min=" + roomDateMin.value : ""
    queries += roomDateMax.value !== ""     ? "&date-max=" + roomDateMax.value : ""

    xhr.open("GET", "/?api=home&method=room_list" + queries);
    xhr.send(data);
})

xhr.open("GET", "/?api=home&method=room_list");
xhr.send(data);

function constructRoomList(data) {
    let result = ""
    data.forEach((e) => {
        result += '<div class="block room-list__item">'
        result +=   '<img class="room-list__picture" src="' + e.picture + '" alt="' + e.room_name + '" />'
        result +=   '<div class="room-list__content">'
        result +=       '<div class="room-list__header">'
        result +=           '<h3 class="room-list__title">' + e.room_name + '</h3>'
        result +=           '<p class="room-list__type">' + e.type + '</p>'
        result +=       '</div>'
        result +=       '<div class="btn-group">'
        result +=           '<a href="#">'
        result +=               '<button class="btn btn--default">Mot de passe oublié ?</button>'
        result +=           '</a>'
        result +=           '<button class="btn btn--neutral" type="submit">Se connecter</button>'
        result +=       '</div>'
        result +=   '</div>'
        result += '</div>'
    })
    roomList.innerHTML = result
}