const data = null;
const xhr = new XMLHttpRequest();

const roomType      = document.querySelector("#search-room-type")
const roomAvailable = document.querySelector("#search-available")
const roomDates   = document.querySelector("#search-date")
const roomDateMin   = document.querySelector("#search-date-min")
const roomDateMax   = document.querySelector("#search-date-max")
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

roomType.addEventListener("click", handleChange)
roomAvailable.addEventListener("click", handleChange)
roomDateMin.addEventListener("click", handleChange)
roomDateMax.addEventListener("click", handleChange)

xhr.open("GET", "/?api=home&method=room_list");
xhr.send(data);

function handleChange() {
    let queries = ""
    queries += roomType.value !== ""        ? "&type=" + roomType.value : ""
    queries += roomAvailable.value !== ""   ? "&available=" + roomAvailable.value : ""
    queries += roomDateMin.value !== ""     ? "&date-min=" + roomDateMin.value : ""
    queries += roomDateMax.value !== ""     ? "&date-max=" + roomDateMax.value : ""

    xhr.open("GET", "/?api=home&method=room_list" + queries);
    xhr.send(data);
}

function constructRoomList(data) {
    let result = ""

    data.forEach((e) => {
        result += '<div class="block room-list__item">'
        result +=   '<img class="room-list__picture" src="' + e.picture + '" alt="' + e.name + '" />'
        result +=   '<div class="room-list__content">'
        result +=       '<div class="room-list__header">'
        result +=           '<div>'
        result +=               '<h3 class="room-list__title">' + e.name + '</h3>'
        result +=               '<p class="room-list__type">' + e.type + '</p>'
        result +=           '</div>'
        result +=           '<a href="?p=booking&id=' + e.id + '">'
        result +=               '<button class="btn btn--neutral room-list__btn" type="submit">Poser une réservation</button>'
        result +=           '</a>'
        result +=       '</div>'
        result +=       calendar(e.booking)
        result +=   '</div>'
        result += '</div>'
    })
    roomList.innerHTML = result
}