let currentIndex = 0;
let images = [];

window.openModal = function (index) {
    currentIndex = index;
    showImage();
    document.getElementById("imageModal").style.display = "flex";
};

window.closeModal = function () {
    document.getElementById("imageModal").style.display = "none";
};

window.nextImage = function () {
    if (currentIndex < images.length - 1) {
        currentIndex++;
        showImage();
    }
};

window.previousImage = function () {
    if (currentIndex > 0) {
        currentIndex--;
        showImage();
    }
};

function showImage() {
    const img = document.getElementById("modalImage");
    const counter = document.getElementById("imageCounter");

    img.src = images[currentIndex];
    counter.textContent = `${currentIndex + 1} / ${images.length}`;
}
