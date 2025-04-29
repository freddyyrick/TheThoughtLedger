//This is for kuan slideshow eme kanang background
const slides = document.querySelectorAll('.slide');
let currentSlide = 0;

function showSlide() {
  slides.forEach((slide, index) => {
    slide.style.opacity = index === currentSlide ? 1 : 0;
  });
  currentSlide = (currentSlide + 1) % slides.length;
}
setInterval(showSlide, 3000);
showSlide(); // Initial load

//Date adn Time 
function updateDateTime() {
  const now = new Date();
  document.getElementById('current-date').textContent = now.toDateString();
  document.getElementById('current-time').textContent = now.toLocaleTimeString();
}
setInterval(updateDateTime, 1000);
updateDateTime(); // Initial load

// Navigation section toggles (ambot chatgpt rani nga part)
const homeLink = document.getElementById('home-link');
const addEntryLink = document.getElementById('add-entry-link');
const viewJournalsLink = document.getElementById('view-journals-link');

const homeSection = document.getElementById('home-section');
const addEntrySection = document.getElementById('add-entry-section');
const viewJournalsSection = document.getElementById('view-journals-section');

function setActiveLink(activeLink) {
  document.querySelectorAll('.sidebar nav a').forEach(link => {
    link.classList.remove('active');
  });
  activeLink.classList.add('active');
}

homeLink.addEventListener('click', () => {
  homeSection.style.display = 'block';
  addEntrySection.style.display = 'none';
  viewJournalsSection.style.display = 'none';
  setActiveLink(homeLink);
});

addEntryLink.addEventListener('click', () => {
  homeSection.style.display = 'none';
  addEntrySection.style.display = 'block';
  viewJournalsSection.style.display = 'none';
  setActiveLink(addEntryLink);
});

viewJournalsLink.addEventListener('click', () => {
  homeSection.style.display = 'none';
  addEntrySection.style.display = 'none';
  viewJournalsSection.style.display = 'block';
  setActiveLink(viewJournalsLink);
});

// sa new journal button
document.getElementById('new-journal-btn').addEventListener('click', () => {
  addEntryLink.click();
});

function loadQuote() {
    fetch('quotes.php')
      .then(response => response.text()) // ← Get raw text na gikan sa DB
      .then(text => {
        console.log('Raw response:', text); // Log it
        const data = JSON.parse(text); 
        document.getElementById("quote-text").textContent = `"${data.quote_text}"`;
        document.getElementById("quote-author").textContent = `- ${data.quote_author}`;
      })
      .catch(error => {
        console.error('Error fetching quote:', error);
        document.getElementById("quote-text").textContent = "Oops! Couldn’t load quote.";
        document.getElementById("quote-author").textContent = "";
      });
  }
  