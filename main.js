
const headers = new Headers(); headers.append("Content-Type", "application/json; charset=utf-8");
async function getdayInformation() {
    const res = await fetch('main.php', { headers, method: "GET" })
    const data = await res.text()
    const busyDayInformation = JSON.parse(data)
    console.log("Ответ от сервера:" , busyDayInformation)
    const fullmMnthDays = {}
    document.querySelectorAll("today, .thu, .wed, .tue, .mon, .sun, .sat, .fri").forEach(el =>
        fullmMnthDays[el.textContent] = el) 
    for (let day in busyDayInformation) {
        let noday;
        if (busyDayInformation[day] >=  5 ) { 
            day[0] == 0 ? noday = day.slice(1) : noday = day 
            fullmMnthDays[noday].classList.add("noday")
        }  
    }
}

getdayInformation()

const today = new Date()
const lastDayCurrentMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
$("input").glDatePicker({
    showAlways: true,
    selectableMonths: [today.getMonth()], 
});
