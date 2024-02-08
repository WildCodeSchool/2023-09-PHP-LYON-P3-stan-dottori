/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

require('bootstrap');

document.addEventListener('DOMContentLoaded', function() {
    var themeToggle = document.getElementById('theme-toggle');
    themeToggle.addEventListener('click', function () {
        var body = document.body;
        var theme = body.getAttribute('data-theme');
        var themeIcon = document.getElementById('theme-icon');
        var themeLogo = document.getElementById('theme-logo');
        if (theme=== 'dark') {
            body.setAttribute('data-theme', 'light');
            themeIcon.innerHTML = '<i class="fa-solid fa-sun"></i>'//sun
            themeLogo.innerHTML = url('../images/black_logo.png');
        } else {
            body.setAttribute('data-theme', 'dark');
            themeIcon.innerHTML = '<i class="fa-solid fa-moon"></i>';//moon
        }
    });
});

const links = document.querySelectorAll(".link")

const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    entry.target.classList.toggle("show", entry.isIntersecting)
  })
}, {
  threshold: 0.5,
})

links.forEach(link => {
  observer.observe(link)
});
