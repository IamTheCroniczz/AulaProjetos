let currentIndex = 0;
const slides = document.querySelectorAll('.slide');

function showNextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    const offset = -currentIndex * 100;
    document.querySelector('.slides').style.transform = `translateX(${offset}%)`;
}

// Configura o slide para mudar a cada 3 segundos (3000ms)
setInterval(showNextSlide, 5000);
