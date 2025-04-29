const slides = document.querySelectorAll('.slide');
let index = 0;

function showSlide() {
  slides.forEach((slide, i) => {
    slide.style.opacity = i === index ? 1 : 0;
  });
  index = (index + 1) % slides.length;
}

setInterval(showSlide, 3000);
showSlide(); 
