// ===========================
// IMPROVED GALLERY MODAL WITH THUMBNAILS
// ===========================
let currentImageIndex = 0;
let galleryImages = [];

/**
 * Initialize gallery with images and generate thumbnails
 */
function initializeGallery() {
    const galleryItems = document.querySelectorAll(".gallery-item img");
    galleryImages = Array.from(galleryItems).map((img) => img.src);

    // Generate thumbnails
    generateThumbnails();

    console.log(`Gallery initialized with ${galleryImages.length} images`);
}

/**
 * Generate thumbnail preview
 */
function generateThumbnails() {
    const thumbnailWrapper = document.getElementById("thumbnailWrapper");
    if (!thumbnailWrapper) return;

    thumbnailWrapper.innerHTML = "";

    galleryImages.forEach((imageSrc, index) => {
        const thumbnailItem = document.createElement("div");
        thumbnailItem.className = "thumbnail-item";
        thumbnailItem.onclick = () => goToImage(index);

        const thumbnailImg = document.createElement("img");
        thumbnailImg.src = imageSrc;
        thumbnailImg.alt = `Thumbnail ${index + 1}`;

        thumbnailItem.appendChild(thumbnailImg);
        thumbnailWrapper.appendChild(thumbnailItem);
    });
}

/**
 * Update active thumbnail
 */
function updateActiveThumbnail() {
    const thumbnails = document.querySelectorAll(".thumbnail-item");
    thumbnails.forEach((thumb, index) => {
        if (index === currentImageIndex) {
            thumb.classList.add("active");
            // Scroll thumbnail into view
            thumb.scrollIntoView({
                behavior: "smooth",
                block: "nearest",
                inline: "center",
            });
        } else {
            thumb.classList.remove("active");
        }
    });
}

/**
 * Go to specific image
 */
function goToImage(index) {
    if (index >= 0 && index < galleryImages.length) {
        currentImageIndex = index;
        updateModalImage();
    }
}

/**
 * Open modal at specific image index
 */
function openModal(index) {
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImage");
    const counter = document.getElementById("imageCounter");

    if (modal && modalImg) {
        currentImageIndex = index;
        modal.style.display = "block";
        modalImg.src = galleryImages[index];

        if (counter) {
            counter.textContent = `${index + 1} / ${galleryImages.length}`;
        }

        updateNavigationButtons();
        updateActiveThumbnail();
        document.body.style.overflow = "hidden";
    }
}

/**
 * Close modal
 */
function closeModal() {
    const modal = document.getElementById("imageModal");
    if (modal) {
        modal.style.display = "none";
        document.body.style.overflow = "auto";
    }
}

/**
 * Navigate to previous image
 */
function previousImage() {
    if (currentImageIndex > 0) {
        currentImageIndex--;
        updateModalImage();
    }
}

/**
 * Navigate to next image
 */
function nextImage() {
    if (currentImageIndex < galleryImages.length - 1) {
        currentImageIndex++;
        updateModalImage();
    }
}

/**
 * Update modal image and counter
 */
function updateModalImage() {
    const modalImg = document.getElementById("modalImage");
    const counter = document.getElementById("imageCounter");

    if (modalImg) {
        modalImg.style.opacity = "0";

        setTimeout(() => {
            modalImg.src = galleryImages[currentImageIndex];
            modalImg.style.opacity = "1";
        }, 150);
    }

    if (counter) {
        counter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
    }

    updateNavigationButtons();
    updateActiveThumbnail();
}

/**
 * Update navigation button states
 */
function updateNavigationButtons() {
    const prevBtn = document.getElementById("modalPrev");
    const nextBtn = document.getElementById("modalNext");

    if (prevBtn) {
        prevBtn.style.opacity = currentImageIndex === 0 ? "0.3" : "1";
        prevBtn.style.cursor =
            currentImageIndex === 0 ? "not-allowed" : "pointer";
    }

    if (nextBtn) {
        nextBtn.style.opacity =
            currentImageIndex === galleryImages.length - 1 ? "0.3" : "1";
        nextBtn.style.cursor =
            currentImageIndex === galleryImages.length - 1
                ? "not-allowed"
                : "pointer";
    }
}

/**
 * Handle keyboard navigation
 */
function handleKeydown(e) {
    const modal = document.getElementById("imageModal");

    if (modal && modal.style.display === "block") {
        switch (e.key) {
            case "Escape":
                closeModal();
                break;
            case "ArrowLeft":
                previousImage();
                break;
            case "ArrowRight":
                nextImage();
                break;
        }
    }
}

/**
 * Handle modal click (close on backdrop)
 */
function handleModalClick(e) {
    if (e.target.id === "imageModal") {
        closeModal();
    }
}

/**
 * Generate Report
 */
function generateReport() {
    alert("Fitur generate report akan segera tersedia");
}

/**
 * Toggle Accordion - SMOOTH VERSION
 */
function toggleAccordion(id) {
    console.log("toggleAccordion called with id:", id);

    const content = document.getElementById(`accordion-${id}`);
    if (!content) {
        console.error("Accordion content not found for id:", id);
        return;
    }

    const header = content.previousElementSibling;
    if (!header) {
        console.error("Accordion header not found");
        return;
    }

    // Check if currently active
    const isActive = content.classList.contains("active");

    if (isActive) {
        // CLOSING: First set max-height to current scrollHeight for smooth transition
        content.style.maxHeight = content.scrollHeight + "px";

        // Force reflow
        content.offsetHeight;

        // Then set to 0
        content.style.maxHeight = "0";

        // Remove active class
        content.classList.remove("active");
        header.classList.remove("active");
        console.log("Accordion closed:", id);
    } else {
        // OPENING: Set max-height to scrollHeight for smooth expansion
        content.classList.add("active");
        header.classList.add("active");

        // Calculate and set the actual height
        content.style.maxHeight = content.scrollHeight + "px";
        console.log("Accordion opened:", id, "Height:", content.scrollHeight);

        // After transition completes, remove inline max-height to allow dynamic content
        setTimeout(() => {
            if (content.classList.contains("active")) {
                content.style.maxHeight = "none";
            }
        }, 400);
    }
}

// ===========================
// INITIALIZE ON DOM READY
// ===========================
document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM loaded, initializing detail-lokasi...");

    // Initialize gallery
    initializeGallery();

    // Attach click event to all gallery items
    const galleryItems = document.querySelectorAll(".gallery-item");
    console.log("Found gallery items:", galleryItems.length);

    galleryItems.forEach((item, index) => {
        item.addEventListener("click", function (e) {
            console.log("Gallery item clicked, index:", index);
            e.preventDefault();
            openModal(index);
        });

        // Add pointer cursor
        item.style.cursor = "pointer";
    });

    // Keyboard navigation
    document.addEventListener("keydown", handleKeydown);

    // Modal backdrop click
    const modal = document.getElementById("imageModal");
    if (modal) {
        modal.addEventListener("click", handleModalClick);
    }

    console.log("Gallery modal with thumbnails initialized successfully");

    // Make toggleAccordion globally accessible
    window.toggleAccordion = toggleAccordion;
    console.log("toggleAccordion function attached to window");
});
