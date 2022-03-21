contactPopup = new Popup('.contact-popup', {
  openButtons: '[data-form-id="6"]',
  closeButtons: '.contact-popup__close'
});
contactPopup.addEventListener('popupclose', function() {
 contactPopup.classList.remove('success', 'fail');
});
// contactPopup.openPopup();