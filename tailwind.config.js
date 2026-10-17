/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    // Pastikan semua file Blade, JS, dan Vue tercakup
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./resources/**/*.ts",
    "./resources/**/*.jsx",
    "./resources/**/*.tsx",
  ],
  theme: {
    extend: {
      // Tambahkan keyframes khusus
      keyframes: {
        fadeUp: {
          "0%": { opacity: "0", transform: "translateY(30px)" },
          "100%": { opacity: "1", transform: "translateY(0)" },
        },
        fadeIn: {
          "0%": { opacity: "0", transform: "scale(0.96)" },
          "100%": { opacity: "1", transform: "scale(1)" },
        },
      },
      // Hubungkan keyframes ke nama utility `animation`
      animation: {
        "fade-up": "fadeUp 0.9s ease-out both",
        "fade-in": "fadeIn 1.1s ease-out both",
      },
    },
  },
  plugins: [],
};