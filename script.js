const books = document.getElementById("books");
const cardArray = document.getElementsByClassName("cardContainer");
const newDiv = document.createElement("div");

const sort = document.getElementById("sortingSymbol");
const dropdown = document.getElementById("dropdown");

const noResult = document.getElementById("noResults");

// making sure the sorting arrows on the bottom of katalog.php are always on the bottom by always keeping the amount of cards dividable by 4
newDiv.classList.add("cardContainer");

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

// show message when no books are found
 if(cardArray.length === 0) {
    noResult.classList.toggle("hidden")
 }
console.log(cardArray.length)

// if url includes desc add class to visualise it
if(location.href.includes("desc=1")) {
    sort.classList.remove("fa-arrow-down-wide-short")
    sort.classList.add("fa-arrow-up-wide-short")
}
// if dropdown options is in url select it as default in the form
if(location.href.includes("sortBy")) {
    if (location.href.includes("sortBy=kurztitle")) {
        dropdown.options[1].setAttribute('selected', true)
    } else if (location.href.includes("sortBy=kategorie")) {
        dropdown.options[2].setAttribute('selected', true)
    } else if (location.href.includes("sortBy=autor")) {
        dropdown.options[3].setAttribute('selected', true)
    }
}
// add dropdown options to url when clicked
for (let i = 0; i < dropdown.options.length; i++) {
    dropdown.options[i].addEventListener("click", () => {
        location.href = location.href.replace(/&sortBy=.*/g, "") + "&sortBy=" + dropdown.options[i].value
    })
}


// change appearance of sorting symbol at the right of screen on click
sort.addEventListener("click", () => {
    if(sort.classList.contains("fa-arrow-down-wide-short")) {
        sort.classList.remove("fa-arrow-down-wide-short")
        sort.classList.add("fa-arrow-up-wide-short")
        location.href = location.href.replace(/&sortBy=.*/g, "") + "&sortBy=" + dropdown.value + "&desc=1"
    } else if(sort.classList.contains("fa-arrow-up-wide-short")) {
        sort.classList.remove("fa-arrow-up-wide-short")
        sort.classList.add("fa-arrow-down-wide-short")
        location.href = location.href.replace("&desc=1", "")
    }
})