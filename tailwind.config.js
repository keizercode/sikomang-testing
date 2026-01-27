/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#009966",
                "primary-dark": "#2d5c54",
                "primary-light": "#5a9e91",
                secondary: "#242621",
                navbar: "#003D28",
                accent: "#8f9d5d",
                muted: "#4c5250",
                background: "#fbfbfb",
            },
            fontFamily: {
                sans: ["Inter", "sans-serif"],
            },
        },
    },
    plugins: [],
};
