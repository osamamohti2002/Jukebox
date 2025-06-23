  const menuButton = document.getElementById('mobile-menu-button');
  const menu = document.getElementById('mobile-menu');

  menuButton.addEventListener('click', () => {
    menu.classList.toggle('hidden');
      });


  const slides = document.getElementById("slides");
  let index = 0;

  function updateSlide() {
    slides.style.transform = `translateX(-${index * 100}%)`;
  }

  function nextSlide() {
    index = (index + 1) % 2; // Aantal slides (hier 2)
    updateSlide();
  }

  function prevSlide() {
    index = (index - 1 + 2) % 2;
    updateSlide();
  }