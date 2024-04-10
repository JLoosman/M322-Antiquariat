const books = document.getElementById("books");
const cardArray = document.getElementsByClassName("card");
const newDiv = document.createElement("div");
newDiv.classList.add("card");

console.log(books.lastElementChild)

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