const books = document.getElementById("books");
const cardArray = document.getElementsByClassName("card");
const newDiv = document.createElement("div");

const sort = document.getElementById("sortingSymbol");
const dropdown = document.getElementById("dropdown");

// making sure the sorting arrows on the bottom of katalog.php are always on the bottom by always keeping the amount of cards dividable by 4
newDiv.classList.add("card");

if(cardArray.length % 4 !== 0) {
    for(let i = 0; i < 12; i++) {
        books.insertBefore(newDiv.cloneNode(), books.lastElementChild)
        console.log("appended child")

        if(cardArray.length % 4 === 0) {
            console.log("stopping")
            break;
        }
    }
}
console.log(cardArray.length)

if(location.href.includes("desc=1")) {
    sort.classList.remove("fa-arrow-down-wide-short")
    sort.classList.add("fa-arrow-up-wide-short")
}

// change appearance of sorting symbol at the right of screen on click
sort.addEventListener("click", () => {
    if(sort.classList.contains("fa-arrow-down-wide-short")) {
        sort.classList.remove("fa-arrow-down-wide-short")
        sort.classList.add("fa-arrow-up-wide-short")
        location.href = location.href.replace("&sortBy="+dropdown.value, "") + "&sortBy=" + dropdown.value + "&desc=1"
    } else if(sort.classList.contains("fa-arrow-up-wide-short")) {
        sort.classList.remove("fa-arrow-up-wide-short")
        sort.classList.add("fa-arrow-down-wide-short")
        location.href = location.href.replace("&desc=1", "")
    }
})