/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./template/**/*.php"],
  theme: {
    screens: {
      sm: "576px",
      md: "768px",
      lg: "992px",
      xl: "1200px",
      xxl: "1440px",
    },
    container: {
      padding: {
        DEFAULT: "2rem",
      },
    },
    extend: {
      colors: {
        primary: "#005bac",
        secondary: "#8436ab",
        body: "#4f4f4f",
        grey: "#e2e8f0",
        warning: "#ffa900",
        success: "#10b981",
        danger: "#f93154",
        info: "#39c0ed",
      },
    },
  },
  plugins: [],
};

