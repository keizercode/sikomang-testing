import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/hasil-pemantauan.css",
                "resources/css/hasil-pemantauan-popup.css",
                "resources/css/monitoring.css",
                "resources/js/app.js",
                "resources/js/hasil-pemantauan.js",
                "resources/js/detail-lokasi.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
