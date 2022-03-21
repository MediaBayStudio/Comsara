cvPopup = new Popup('.cv-popup', {
  openButtons: '[data-form-id="154"]',
  closeButtons: '.cv-popup__close'
});
cvPopup.addEventListener('popupclose', function() {
 cvPopup.classList.remove('success', 'fail');
});
// cvPopup.openPopup();