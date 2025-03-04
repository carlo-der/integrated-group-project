// Get the elements
const openPopupBtn = document.getElementById("openPopupBtn");
const popup = document.getElementById("popup");
const closeBtn = document.getElementById("closeBtn");

// Open the popup when the image button is clicked
openPopupBtn.addEventListener("click", () => {
    popup.style.display = "flex";
});

// Close the popup when the close button is clicked
closeBtn.addEventListener("click", () => {
    popup.style.display = "none";
});

// Close the popup if clicking anywhere outside the popup content
window.addEventListener("click", (event) => {
    if (event.target === popup) {
        popup.style.display = "none";
    }
});
