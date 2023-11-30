import './bootstrap';


function setActiveLink() {
    const links = document.querySelectorAll('.nav-link');

    links.forEach(link => {

        if (link.href.replace(/\/$/, '') === currentUrl) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}

document.addEventListener('DOMContentLoaded', function(){
    document.querySelector('.loading').style.display = 'none'
})

window.onload = () => {
    setActiveLink();
    document.querySelector('.loading').style.display = 'none'
}

