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

document.addEventListener('DOMContentLoaded', function() {
    var themeToggle = document.getElementById('theme-toggle');
    themeToggle.addEventListener('click', function () {
        var body = document.body;
        var theme = body.getAttribute('data-theme');
        var themeIcon = document.getElementById('theme-icon');
        if (theme=== 'dark') {
            body.setAttribute('data-theme', 'light');
            themeIcon.innerHTML = '☼'//sun
        } else {
            body.setAttribute('data-theme', 'dark');
            themeIcon.innerHTML = '&#9790;';//moon
        }
    });
});
