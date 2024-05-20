const modal = document.getElementById("modal");
const overlay = document.getElementById("overlay");

overlay.addEventListener("click", () => {
    modal.classList.add("hidden")
})

function closeModal() {
    modal.classList.add("hidden")
}

function showModal() {
    modal.classList.remove("hidden")
}