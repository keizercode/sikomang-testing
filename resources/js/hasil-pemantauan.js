// ===========================
// HASIL PEMANTAUAN - JAVASCRIPT
// ===========================

class HasilPemantauanManager {
    constructor(locations) {
        this.locations = locations;
        this.groupMap = null;
        console.log(
            "HasilPemantauanManager initialized with",
            locations.length,
            "locations",
        );
    }

    // Filter functionality
    filterCards(searchTerm) {
        const cards = document.querySelectorAll(".location-card");
        console.log("Filtering cards with term:", searchTerm);

        cards.forEach((card) => {
            const title =
                card.querySelector(".card-title")?.textContent.toLowerCase() ||
                "";
            const description =
                card.querySelector(".description")?.textContent.toLowerCase() ||
                "";

            if (
                title.includes(searchTerm) ||
                description.includes(searchTerm)
            ) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    filterByGroup(group) {
        const cards = document.querySelectorAll(".location-card");
        const tabs = document.querySelectorAll(".filter-tabs .tab");

        console.log("Filtering by group:", group);

        // Update active tab
        tabs.forEach((tab) => tab.classList.remove("active"));
        if (event && event.target) {
            event.target.classList.add("active");
        }

        // Filter cards
        let visibleCount = 0;
        cards.forEach((card) => {
            const cardGroup = card.getAttribute("data-group");
            if (group === "all" || cardGroup === group) {
                card.style.display = "block";
                visibleCount++;
            } else {
                card.style.display = "none";
            }
        });

        console.log(
            `Filtered to group: ${group}, visible cards: ${visibleCount}`,
        );
    }

    // Matrix modal
    toggleMatrix() {
        console.log("Toggle matrix called");
        const modal = document.getElementById("matrixModal");
        const backdrop = document.getElementById("matrixBackdrop");

        if (modal && backdrop) {
            modal.classList.toggle("show");
            backdrop.classList.toggle("show");
            console.log(
                "Matrix toggled, show:",
                modal.classList.contains("show"),
            );
        } else {
            console.error("Matrix modal elements not found");
        }
    }

    closeMatrix() {
        console.log("Close matrix called");
        const modal = document.getElementById("matrixModal");
        const backdrop = document.getElementById("matrixBackdrop");

        if (modal && backdrop) {
            modal.classList.remove("show");
            backdrop.classList.remove("show");
        }
    }

    // Map modal
    openMapModal() {
        console.log("Open map modal called");
        const modal = document.getElementById("mapGroupModal");
        const backdrop = document.getElementById("mapGroupBackdrop");

        if (modal && backdrop) {
            modal.classList.add("show");
            backdrop.classList.add("show");

            setTimeout(() => {
                if (!this.groupMap) {
                    this.initGroupMap();
                } else {
                    this.groupMap.invalidateSize();
                }
            }, 100);
        } else {
            console.error("Map modal elements not found");
        }
    }

    closeMapModal() {
        console.log("Close map modal called");
        const modal = document.getElementById("mapGroupModal");
        const backdrop = document.getElementById("mapGroupBackdrop");

        if (modal && backdrop) {
            modal.classList.remove("show");
            backdrop.classList.remove("show");
        }
    }

    // Initialize group map
    initGroupMap() {
        console.log("Initializing group map");

        if (typeof L === "undefined") {
            console.error("Leaflet is not loaded!");
            return;
        }

        this.groupMap = L.map("groupMap").setView([-6.1, 106.8], 12);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19,
        }).addTo(this.groupMap);

        // Convert locations to map format
        const allLocations = this.locations.map((location) => {
            const coordsArray = location.coords
                .split(",")
                .map((c) => parseFloat(c.trim()));
            return {
                name: location.name,
                coords: coordsArray,
                area: location.area,
                density: location.density,
                slug: location.slug,
            };
        });

        // Density colors
        const densityColors = {
            Jarang: "#8dd3c7",
            Sedang: "#FFFFB3",
            Lebat: "#BEBADA",
        };

        // Create marker icon
        const createMarkerIcon = (density) => {
            const color = densityColors[density] || "#999";
            return L.divIcon({
                className: "custom-map-marker",
                html: `
                    <div style="
                        background: ${color};
                        width: 32px;
                        height: 32px;
                        border-radius: 50% 50% 50% 0;
                        transform: rotate(-45deg);
                        border: 3px solid white;
                        box-shadow: 0 3px 8px rgba(0,0,0,0.3);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    ">
                        <div style="
                            width: 12px;
                            height: 12px;
                            background: white;
                            border-radius: 50%;
                            transform: rotate(45deg);
                        "></div>
                    </div>
                `,
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });
        };

        // Add markers
        allLocations.forEach((location) => {
            const marker = L.marker(location.coords, {
                icon: createMarkerIcon(location.density),
            }).addTo(this.groupMap);

            const densityClass = location.density.toLowerCase();
            const popupContent = `
                <div class="custom-popup">
                    <div class="popup-header">
                        <div class="popup-title">${location.name}</div>
                    </div>
                    <div class="popup-body">
                        <div class="popup-info">
                            <span class="popup-icon">📍</span>
                            <div class="popup-content-wrapper">
                                <div class="popup-label">Koordinat</div>
                                <div class="popup-value">${location.coords[0].toFixed(4)}, ${location.coords[1].toFixed(4)}</div>
                            </div>
                        </div>
                        <div class="popup-info">
                            <span class="popup-icon">📏</span>
                            <div class="popup-content-wrapper">
                                <div class="popup-label">Luas Area</div>
                                <div class="popup-value">${location.area}</div>
                            </div>
                        </div>
                        <div class="popup-info">
                            <span class="popup-icon">🌳</span>
                            <div class="popup-content-wrapper">
                                <div class="popup-label">Kerapatan Mangrove</div>
                                <div class="popup-value">
                                    <span class="density-badge ${densityClass}">${location.density}</span>
                                </div>
                            </div>
                        </div>
                        <div class="popup-footer">
                            <a href="/monitoring/lokasi/${location.slug}" class="popup-link">
                                <span>Lihat Detail</span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            `;

            marker.bindPopup(popupContent, {
                maxWidth: 320,
                className: "custom-leaflet-popup",
            });

            marker.bindTooltip(location.name, {
                permanent: false,
                direction: "top",
                className: "custom-tooltip",
            });
        });

        // Fit bounds
        if (allLocations.length > 0) {
            const bounds = L.latLngBounds(
                allLocations.map((loc) => loc.coords),
            );
            this.groupMap.fitBounds(bounds, { padding: [50, 50] });
        }

        console.log("Group map initialized successfully");
    }

    // Initialize event listeners
    initEventListeners() {
        console.log("Initializing event listeners");

        // Search
        const searchBtn = document.querySelector(".btn-search");
        const searchInput = document.getElementById("searchInput");

        if (searchBtn && searchInput) {
            searchBtn.addEventListener("click", () => {
                this.filterCards(searchInput.value.toLowerCase());
            });

            searchInput.addEventListener("keypress", (e) => {
                if (e.key === "Enter") {
                    this.filterCards(searchInput.value.toLowerCase());
                }
            });
            console.log("Search listeners attached");
        } else {
            console.warn("Search elements not found");
        }

        // Filter tabs
        const tabs = document.querySelectorAll(".tab");
        tabs.forEach((tab) => {
            tab.addEventListener("click", function () {
                tabs.forEach((t) => t.classList.remove("active"));
                this.classList.add("active");
            });
        });
        console.log("Tab listeners attached to", tabs.length, "tabs");

        // Escape key
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                this.closeMatrix();
                this.closeMapModal();
            }
        });
        console.log("Escape key listener attached");
    }
}

// Initialize on DOM ready
document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM Content Loaded - Initializing Hasil Pemantauan");

    // Check if locations data exists
    if (typeof window.locationsData === "undefined") {
        console.error("ERROR: window.locationsData is not defined!");
        console.log(
            "Please make sure the blade file has: window.locationsData = @json($locations);",
        );
        return;
    }

    console.log(
        "Locations data found:",
        window.locationsData.length,
        "locations",
    );

    // Create global manager instance
    window.hasilPemantauanManager = new HasilPemantauanManager(
        window.locationsData,
    );

    // Initialize event listeners
    window.hasilPemantauanManager.initEventListeners();

    console.log("Hasil Pemantauan Manager ready!");
});

// Make functions globally accessible for onclick handlers
window.filterByGroup = function (group) {
    console.log("Global filterByGroup called with:", group);
    if (window.hasilPemantauanManager) {
        window.hasilPemantauanManager.filterByGroup(group);
    } else {
        console.error("hasilPemantauanManager not initialized!");
    }
};

window.toggleMatrix = function () {
    console.log("Global toggleMatrix called");
    if (window.hasilPemantauanManager) {
        window.hasilPemantauanManager.toggleMatrix();
    } else {
        console.error("hasilPemantauanManager not initialized!");
    }
};

window.closeMatrix = function () {
    console.log("Global closeMatrix called");
    if (window.hasilPemantauanManager) {
        window.hasilPemantauanManager.closeMatrix();
    } else {
        console.error("hasilPemantauanManager not initialized!");
    }
};

window.openMapModal = function () {
    console.log("Global openMapModal called");
    if (window.hasilPemantauanManager) {
        window.hasilPemantauanManager.openMapModal();
    } else {
        console.error("hasilPemantauanManager not initialized!");
    }
};

window.closeMapModal = function () {
    console.log("Global closeMapModal called");
    if (window.hasilPemantauanManager) {
        window.hasilPemantauanManager.closeMapModal();
    } else {
        console.error("hasilPemantauanManager not initialized!");
    }
};

console.log("Hasil Pemantauan script loaded - waiting for DOM ready");
