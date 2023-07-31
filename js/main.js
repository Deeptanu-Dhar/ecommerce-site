// -----------------scroll to top action------------------- 
const toTop = document.querySelector(".to-top");

window.addEventListener("scroll", () => {
    if (window.pageYOffset > 100) {
        toTop.classList.add("active");
    } else {
        toTop.classList.remove("active");
    }
});

// ---------------------------user window-----------------------

let profile = document.querySelector('#header .profile');
let userIcon = document.querySelector('#header #user-btn');
let navbar = document.querySelector('#header #navbar');

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


// -------------------------Shadow for newsletter form---------------------------

const newsForm = document.getElementById("news-form");

newsForm.addEventListener("click", () => {
    newsForm.classList.add("shadow-style");
});

document.addEventListener("click", (event1) => {
    if (!newsForm.contains(event1.target)) {
        newsForm.classList.remove("shadow-style");
    }
});

// -------------------------Shadow for newsletter form---------------------------


const contactForm = document.getElementById("form-container");

contactForm.addEventListener("click", () => {
    contactForm.classList.add("shadow-style2");
});

document.addEventListener("click", (event2) => {
    if (!contactForm.contains(event2.target)) {
        contactForm.classList.remove("shadow-style2");
    }
});