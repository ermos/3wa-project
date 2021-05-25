function calendar(booking) {
    let result = ""
    let notEmpty = {}

    const afterDay = today()
    afterDay.setDate(afterDay.getDate() + 32)

    booking.forEach((b) => {
        for (let d = new Date(b.date_min); d <= new Date(b.date_max); d.setDate(d.getDate() + 1)) {
            notEmpty[d.getTime()] = true
        }
    })

    result +=       '<div class="calendar">'
    for (let d = today(); d < afterDay; d.setDate(d.getDate() + 1)) {
        result +=       '<div class="calendar__item' + (notEmpty[d.getTime()] === undefined ? ' calendar__item--booking' : '') + '">'
        result +=           d.getDate().toString()
        result +=       '</div>'
    }
    result +=       '</div>'

    return result
}

function today() {
    const d = new Date(new Date().toISOString().slice(0, 10))
    d.setHours(0,0,0,0)
    return d
}