/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{php,js}"],
  theme: {
    container: {
      center: true,
    },
    extend: {
      colors: {
        "bg": "rgba(244, 239, 233, 1)",
        "cream-02": "rgba(244, 239, 233, 1)",
        "light-blue": "rgba(237, 245, 255, 1)",
        "midnight-50": "rgba(229, 232, 234, 1)",
        "midnight-200": "rgba(183, 188, 193, 1)",
        "midnight-400": "rgba(136, 144, 152, 1)",
        "midnight-700": "rgba(64, 77, 88, 1)",
        "midnight-900": "rgba(17, 32, 47, 1)",
        "blue-main": "rgba(1, 132, 253, 1)",
        "yellow-main": "rgba(249, 167, 37, 1)",
        "divider": "rgba(137, 115, 88, 0.2)",
        "orange-main": "rgba(207, 87, 46, 1)",
        "p-green": "rgba(137, 242, 120, 1)",
        "p-beige": "rgba(242, 167, 120, 1)",
        "p-purple": "rgba(105, 111, 255, 1)",
        
      },
      fontFamily: {
        sans: ["Ravi", "arial", "sans-serif"],
      },
      fontSize: {
        xxs: "0.5rem",
      },
      boxShadow: {
      },
      dropShadow: {
        hero: "0px 2px 32px rgba(0, 0, 0, 0.35)",
      },
      borderRadius: {},
      backgroundImage: {
        "black-cover":
          "linear-gradient(0deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.5) 100%)",
        grad: "linear-gradient(180deg, #FFFFFF 0%, #EDF2F5 100%)",
      },
      backgroundSize: {},
      backgroundPosition: {},
      gridTemplateRows: {},
    },
  },
  plugins: [
    require("tailwindcss-labeled-groups")(["1", "2", "3", "4", "5", "6"]),
    ({ addUtilities }) => {
      addUtilities({
        ".flex-center": {
          display: "flex",
          alignItems: "center",
          justifyContent: "center",
        },
        ".bold-48": {
          fontWeight: "bold",
          fontSize: "3rem",
          lineHeight: "4.625rem",
        },
        ".bold-24": {
          fontWeight: "bold",
          fontSize: "1.5rem",
          lineHeight: "2.3125rem",
        },
        ".semibold-12": {
          fontWeight: "600",
          fontSize: "0.75rem",
          lineHeight: "1.125rem",
        },
        ".semibold-14": {
          fontWeight: "600",
          fontSize: "0.875rem",
          lineHeight: "1.375rem",
        },
        ".semibold-36": {
          fontWeight: "600",
          fontSize: "2.25rem",
          lineHeight: "3.5rem",
        },
        ".semibold-28": {
          fontWeight: "600",
          fontSize: "1.75rem",
          lineHeight: "2.6875rem",
        },
        ".semibold-22": {
          fontWeight: "600",
          fontSize: "1.375rem",
          lineHeight: "2.125rem",
        },
        ".semibold-18": {
          fontWeight: "600",
          fontSize: "1.125rem",
          lineHeight: "1.75rem",
        },
        ".semibold-16": {
          fontWeight: "600",
          fontSize: "1rem",
          lineHeight: "1.5625rem",
        },
        ".regular-28": {
          fontWeight: "400",
          fontSize: "1.75rem",
          lineHeight: "2.75rem",
        },
        ".regular-18": {
          fontWeight: "400",
          fontSize: "1.125rem",
          lineHeight: "1.75rem",
        },
        ".regular-16": {
          fontWeight: "400",
          fontSize: "1rem",
          lineHeight: "1.75rem",
        },
        ".regular-14": {
          fontWeight: "400",
          fontSize: "0.875rem",
          lineHeight: "1.5rem",
        },
        ".regular-12": {
          fontWeight: "400",
          fontSize: "0.75rem",
          lineHeight: "1.25rem",
        },
      });
    },
  ],
};
