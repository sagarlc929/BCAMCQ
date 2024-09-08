

function customConfirm(message, callback) {
  // Create overlay
  const overlay = document.createElement('div');
  overlay.className = 'custom-confirm-overlay';

  // Create confirm box
  const confirmBox = document.createElement('div');
  confirmBox.className = 'custom-confirm-box';

  // Create confirm message
  const confirmMessage = document.createElement('div');
  confirmMessage.className = 'custom-confirm-message';
  confirmMessage.textContent = message;

  // Create buttons container
  const buttonsContainer = document.createElement('div');
  buttonsContainer.className = 'custom-confirm-buttons';

  // Create OK button
  const okButton = document.createElement('button');
  okButton.className = 'custom-confirm-button custom-confirm-ok';
  okButton.textContent = 'OK';
  okButton.onclick = function() {
    document.body.removeChild(overlay);
    if (typeof callback === 'function') {
      callback(true);
    }
  };

  // Create Cancel button
  const cancelButton = document.createElement('button');
  cancelButton.className = 'custom-confirm-button custom-confirm-cancel';
  cancelButton.textContent = 'Cancel';
  cancelButton.onclick = function() {
    document.body.removeChild(overlay);
    if (typeof callback === 'function') {
      callback(false);
    }
  };

}