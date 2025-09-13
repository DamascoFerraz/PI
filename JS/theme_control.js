const icon = document.getElementById("theme-icon");
const html = document.getElementById('htmltag');

(function(){
    if (localStorage.getItem('theme') == null){
        localStorage.setItem('theme', 'light');
    }
    html.setAttribute('data-theme', localStorage.getItem('theme'));
    if (localStorage.getItem('theme') === 'dark'){
        icon.setAttribute('class','fa-regular fa-moon');
    }
    else {
        icon.setAttribute('class','fa-regular fa-sun');
    }
})();

function darkMode () {
    var targetTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';

    if (targetTheme === 'dark'){
        html.setAttribute('data-theme', targetTheme);
        localStorage.setItem('theme', targetTheme);
        icon.setAttribute('class','fa-regular fa-moon');
    }
    else {
        html.setAttribute('data-theme', targetTheme);
        localStorage.setItem('theme', targetTheme);
        icon.setAttribute('class','fa-regular fa-sun');
    }
    }
