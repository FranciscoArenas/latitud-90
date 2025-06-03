import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.vue"
  ],

  theme: {
    extend: {
      colors: {
        negro: "#3B7ABE",
        gris: "#3B7ABE",
        "gris-4": "#D3D3D3",
        "gris-3": "##F9F9F9",
        "gris-2": "#F0F0F0",
        "gris-1": "#FFFFFF",
        blanco: "#FFFFFF",
        turquesa: "#007E93",
        amarillo: "#FFB232",
        "verde-oscuro": "#1C4F4A",
        rojo: "#D54A42",
        naranja: "#FD671A"
      },
      fontFamily: {
        nexa: ["Nexa", "sans-serif"],
        quincy: ["Quincy", "sans-serif"]
      }
    }
  },

  plugins: [forms]
};
