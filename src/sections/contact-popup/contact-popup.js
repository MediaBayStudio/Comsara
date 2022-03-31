contactPopup = new Popup('.contact-popup', {
  openButtons: '.contact-popup-open',
  closeButtons: '.contact-popup__close'
});
contactPopup.addEventListener('popupclose', function() {
 contactPopup.classList.remove('success', 'fail');
});
// contactPopup.openPopup();