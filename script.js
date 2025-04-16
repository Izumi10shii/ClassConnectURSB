const images = [
    '../bg/sample.png',
    '../bg/sample2.png'
];

let currentIndex = 0;

function nextImage(event) {
    if (event) event.stopPropagation();
    currentIndex = (currentIndex + 1) % images.length;
    updateImage();
}

function prevImage(event) {
    if (event) event.stopPropagation();
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    updateImage();
}

function updateImage() {
    const imageBanner = document.getElementById('imageBanner');
    imageBanner.style.backgroundImage = `url('${images[currentIndex]}')`;
    updateDots();
}

function updateDots() {
    const dotsContainer = document.getElementById('dotsContainer');
    dotsContainer.innerHTML = '';
    images.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.classList.add('dot');
        if (index === currentIndex) {
            dot.classList.add('active');
        }
        dotsContainer.appendChild(dot);
    });
}

function navigateWithEffect(targetUrl) {
    const wrapper = document.querySelector('.page-wrapper');
    wrapper.classList.add('fade-zoom-out');

    setTimeout(() => {
        window.location.href = targetUrl;
    }, 1000);
}

updateImage();
