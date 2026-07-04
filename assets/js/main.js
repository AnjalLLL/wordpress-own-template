/**
 * Finexiah Theme Main JavaScript
 */
document.addEventListener('DOMContentLoaded', () => {
  // Mobile menu toggle
  const menuToggle = document.querySelector('.menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', () => {
      const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
      menuToggle.setAttribute('aria-expanded', !isExpanded);
      
      if (isExpanded) {
        mobileMenu.setAttribute('hidden', '');
        mobileMenu.style.display = 'none';
      } else {
        mobileMenu.removeAttribute('hidden');
        mobileMenu.style.display = 'block';
      }
    });
  }

  // Smooth Back-to-top handler if window.scrollTo is not native
  const backToTopBtn = document.querySelector('.back-to-top');
  if (backToTopBtn) {
    backToTopBtn.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
});
