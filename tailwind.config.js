/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
	    "./resources/**/*.blade.php", // Para los blade de las vistas
	    "./resources/**/*.js", // Para los javascript
	    "./resources/**/*.vue", // para los vue.js
      "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

// module.exports = {
//   content: [
//     './**/*.{html,js}',
//   ],
// }

