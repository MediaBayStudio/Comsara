contactPopup = new Popup('.contact-popup', {
  closeButtons: '.contact-popup__close'
});
contactPopup.addEventListener('popupclose', function() {
 contactPopup.classList.remove('success', 'fail');
});
// contactPopup.openPopup();