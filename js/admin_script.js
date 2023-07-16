let profile = document.querySelector('#header .profile');
let userIcon = document.querySelector('#header #user-btn');

document.querySelector('#user-btn').onclick = () =>{
	profile.classList.toggle('active');
	userIcon.classList.toggle('active');

}

let links = document.querySelectorAll('.page-numbers > a');
let bodyId = parseInt(document.body.id) - 1;
links[bodyId].classList.add("active");
