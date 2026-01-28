// Parse coordinates
const coords = '{{ $location["coords"] }}'
    .split(",")
    .map((c) => parseFloat(c.trim()));

// Initialize map
const map = L.map("detailMap").setView([coords[0], coords[1]], 15);

// Add tile layer
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

// Add marker
const marker = L.marker([coords[0], coords[1]]).addTo(map);
marker
    .bindPopup(
        '<strong>{{ $location["name"] }}</strong><br>{{ $location["location"] }}',
    )
    .openPopup();

// Add circle to show approximate area
L.circle([coords[0], coords[1]], {
    color: "#009966",
    fillColor: "#00996633",
    fillOpacity: 0.3,
    radius: 500,
}).addTo(map);

// Modal functions
function openModal(imageSrc) {
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImage");
    modal.style.display = "block";
    modalImg.src = imageSrc;
}

function closeModal() {
    document.getElementById("imageModal").style.display = "none";
}

// Generate Report function
function generateReport() {
    alert("Fitur generate report akan segera tersedia");
}

// Accordion toggle function
function toggleAccordion(id) {
    const content = document.getElementById(`accordion-${id}`);
    const header = content.previousElementSibling;

    // Toggle active class
    header.classList.toggle("active");
    content.classList.toggle("active");
}

// Close modal on Escape key
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        closeModal();
    }
});
