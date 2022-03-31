cvPopup = new Popup('.cv-popup', {
  openButtons: '.cv-popup-open',
  closeButtons: '.cv-popup__close'
});
cvPopup.addEventListener('popupclose', function() {
 cvPopup.classList.remove('success', 'fail');
});
// cvPopup.openPopup();