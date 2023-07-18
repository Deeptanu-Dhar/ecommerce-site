// -----------------scroll to top action------------------- 
const toTop = document.querySelector(".to-top");

window.addEventListener("scroll", () => {
	if(window.pageYOffset > 100){
		toTop.classList.add("active");
	}else{
		toTop.classList.remove("active");
	}
})


// -------------------------Shadow for newsletter form---------------------------

const newsForm = document.getElementById("news-form");

newsForm.addEventListener("click",()=>{
	newsForm.classList.add("shadow-style");
});

document.addEventListener("click", (event) => {
  if (!newsForm.contains(event.target)){
    newsForm.classList.remove("shadow-style");
  }
});

// -------------------------Shadow for newsletter form---------------------------


const contactForm = document.getElementById("form-container");

contactForm.addEventListener("click",()=>{
	contactForm.classList.add("shadow-style2");
});

document.addEventListener("click", (event) => {
  if (!contactForm.contains(event.target)){
    contactForm.classList.remove("shadow-style2");
  }
});

// ---------------------------user window-----------------------

let profile = document.querySelector('#header .profile');
let userIcon = document.querySelector('#header #user-btn');

document.querySelector('#user-btn').onclick = () =>{
	profile.classList.toggle('active');
	userIcon.classList.toggle('active');

}

//----------------------------zoom on mouse hover---------------------


document.addEventListener("DOMContentLoaded", function() {
  const productImage = document.getElementById("productImg");
  const magnifier = document.querySelector(".magnifier");

  productImage.addEventListener("mousemove", function(event) {
    const imageWidth = productImage.offsetWidth;
    const imageHeight = productImage.offsetHeight;

    const magnifierWidth = magnifier.offsetWidth;
    const magnifierHeight = magnifier.offsetHeight;

    const rect = productImage.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    const offsetX = x / imageWidth * (imageWidth - magnifierWidth);
    const offsetY = y / imageHeight * (imageHeight - magnifierHeight);

    magnifier.style.display = "block";
    magnifier.style.backgroundImage = `url('${productImage.src}')`;
    magnifier.style.backgroundPosition = `-${offsetX}px -${offsetY}px`;
  });

  productImage.addEventListener("mouseleave", function() {
    magnifier.style.display = "none";
  });
});