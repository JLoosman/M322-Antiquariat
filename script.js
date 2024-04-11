const books = document.getElementById("books");
const cardArray = document.getElementsByClassName("card");
const newDiv = document.createElement("div");

const sort = document.getElementById("sortingSymbol");
const checkbox = document.getElementById("sortCheckbox");

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

// change appearance of sorting symbol at the right of screen on click
sort.addEventListener("click", () => {
    if(sort.classList.contains("fa-arrow-down-wide-short")) {
        sort.classList.remove("fa-arrow-down-wide-short")
        sort.classList.add("fa-arrow-up-wide-short")
        checkbox.checked = true;
    } else if(sort.classList.contains("fa-arrow-up-wide-short")) {
        sort.classList.remove("fa-arrow-up-wide-short")
        sort.classList.add("fa-arrow-down-wide-short")
        checkbox.checked = false;
    }
})