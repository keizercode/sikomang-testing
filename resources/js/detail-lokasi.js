// ===========================
// DETAIL LOKASI - HELPER FUNCTIONS
// ===========================
// Map initialization is done inline in the blade file
// This file only contains reusable helper functions

// Modal functions
function openModal(imageSrc) {
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImage");
    if (modal && modalImg) {
        modal.style.display = "block";
        modalImg.src = imageSrc;
    }
}

function closeModal() {
    const modal = document.getElementById("imageModal");
    if (modal) {
        modal.style.display = "none";
    }
}

// Generate Report function
function generateReport() {
    alert("Fitur generate report akan segera tersedia");
}

// Accordion toggle function
function toggleAccordion(id) {
    const content = document.getElementById(`accordion-${id}`);
    if (!content) return;

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

// Make functions globally available
window.openModal = openModal;
window.closeModal = closeModal;
window.generateReport = generateReport;
window.toggleAccordion = toggleAccordion;
