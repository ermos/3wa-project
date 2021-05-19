const data = null;
const xhr = new XMLHttpRequest();

const roomType      = document.querySelector("#search-room-type")
const roomAvailable = document.querySelector("#search-available")
const roomDateMin   = document.querySelector("#search-date-min")
const roomDateMax   = document.querySelector("#search-date-max")
const roomSubmit    = document.querySelector("#search-submit")

xhr.withCredentials = true;

xhr.addEventListener("readystatechange", () => {
    if (this.readyState === this.DONE) {
        console.log(this.responseText);
    }
});

roomSubmit.addEventListener("click", () => {
    xhr.open("GET", "/?api=home&method=room_list");
    xhr.send(data);
})