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

    const afterDay = today()
    afterDay.setDate(afterDay.getDate() + 32)

    data.forEach((e) => {
        let notEmpty = {}
        e.booking.forEach((b) => {
            for (let d = new Date(b.date_min); d <= new Date(b.date_max); d.setDate(d.getDate() + 1)) {
                notEmpty[d.getTime()] = true
            }
        })
        result += '<div class="block room-list__item">'
        result +=   '<img class="room-list__picture" src="' + e.picture + '" alt="' + e.name + '" />'
        result +=   '<div class="room-list__content">'
        result +=       '<div class="room-list__header">'
        result +=           '<div>'
        result +=               '<h3 class="room-list__title">' + e.name + '</h3>'
        result +=               '<p class="room-list__type">' + e.type + '</p>'
        result +=           '</div>'
        result +=           '<button class="btn btn--neutral room-list__btn" type="submit">Poser une réservation</button>'
        result +=       '</div>'
        result +=       '<div class="room-list__calendar">'
        for (let d = today(); d < afterDay; d.setDate(d.getDate() + 1)) {
            result +=       '<div class="calendar__item' + (notEmpty[d.getTime()] === undefined ? ' calendar__item--booking' : '') + '">'
            result +=           d.getDate().toString()
            result +=       '</div>'
        }
        result +=               ''
        result +=       '</div>'
        result +=   '</div>'
        result += '</div>'
    })
    roomList.innerHTML = result
}

function today() {
    const d = new Date(new Date().toISOString().slice(0, 10))
    d.setHours(0,0,0,0)
    return d
}