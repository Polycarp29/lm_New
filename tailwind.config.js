/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            animation: {
                "bounce-once": "bounce-once 1s ease-out",
            },
            keyframes: {
                "bounce-once": {
                    "0%, 20%, 50%, 80%, 100%": { transform: "translateY(0)" },
                    "40%": { transform: "translateY(-10px)" },
                    "60%": { transform: "translateY(-5px)" },
                },
            },
        },
        container: {
            center: true,
        },
    },
    plugins: [],
};
