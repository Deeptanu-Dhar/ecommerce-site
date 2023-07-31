let profile = document.querySelector('#header .profile');
let userIcon = document.querySelector('#header #user-btn');
let navbar = document.querySelector('#header #navbar')

document.querySelector('#user-btn').onclick = () => {
    profile.classList.toggle('active');
    userIcon.classList.toggle('active');
    navbar.classList.remove('active');

}

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    profile.classList.remove('active');
    userIcon.classList.remove('active');
}

window.onscroll = () => {
    profile.classList.remove('active');
    userIcon.classList.remove('active');
    navbar.classList.remove('active');
}

let links = document.querySelectorAll('.page-numbers > a');
let bodyId = parseInt(document.body.id) - 1;
links[bodyId].classList.add("active");