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