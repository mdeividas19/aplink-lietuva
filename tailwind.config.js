import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Lithuanian-inspired color palette
                "forest-green": {
                    DEFAULT: "#1F4D36",
                    50: "#E8F5ED",
                    100: "#D1EBDB",
                    200: "#A3D7B7",
                    300: "#75C393",
                    400: "#47AF6F",
                    500: "#2D7A4F",
                    600: "#1F4D36",
                    700: "#17382A",
                    800: "#0F241D",
                    900: "#071210",
                },
                "baltic-blue": {
                    DEFAULT: "#2C5F8D",
                    50: "#E9F2F9",
                    100: "#D3E5F3",
                    200: "#A7CBE7",
                    300: "#7BB1DB",
                    400: "#4F97CF",
                    500: "#2C5F8D",
                    600: "#234C71",
                    700: "#1A3955",
                    800: "#122639",
                    900: "#09131D",
                },
                amber: {
                    DEFAULT: "#F59E0B",
                    50: "#FEF9E7",
                    100: "#FEF3CF",
                    200: "#FDE79F",
                    300: "#FCDB6F",
                    400: "#FBCF3F",
                    500: "#F59E0B",
                    600: "#C77D09",
                    700: "#995E07",
                    800: "#6B3F05",
                    900: "#3D2003",
                },
                "earth-brown": {
                    DEFAULT: "#8B6F47",
                    50: "#F5F1EB",
                    100: "#EBE3D7",
                    200: "#D7C7AF",
                    300: "#C3AB87",
                    400: "#AF8F5F",
                    500: "#8B6F47",
                    600: "#6F5939",
                    700: "#53432B",
                    800: "#372C1D",
                    900: "#1B160F",
                },
                "moss-green": {
                    DEFAULT: "#6B8E23",
                    50: "#EEF5E1",
                    100: "#DDEBC3",
                    200: "#BBD787",
                    300: "#99C34B",
                    400: "#7DAF2F",
                    500: "#6B8E23",
                    600: "#56721C",
                    700: "#415615",
                    800: "#2C3A0E",
                    900: "#161D07",
                },
            },
            backgroundImage: {
                "gradient-radial": "radial-gradient(var(--tw-gradient-stops))",
            },
        },
    },

    plugins: [forms],
};
