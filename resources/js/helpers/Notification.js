class Notification {
  success(message) {
    new Noty({
      type: 'success',
      layout: 'topRight',
      text: 'Bingo!',
      timeout: 1000
    }).show();
  }
  alert(message) {
    new Noty({
      type: 'alert',
      layout: 'topRight',
      text: 'Are you sure?',
      timeout: 1000
    }).show();
  }
  error(message) {
    new Noty({
      type: 'alert',
      layout: 'topRight',
      text: 'Something went wrong.',
      timeout: 1000
    }).show();
  }
  warning(message) {
    new Noty({
      type: 'warning',
      layout: 'topRight',
      text: 'Oopsie! Something not working!',
      timeout: 1000
    }).show();
  }
  image_validation(message) {
    new Noty({
      type: 'error',
      layout: 'topRight',
      text: 'Upload Image less than 10MB',
      timeout: 2000
    }).show();
  }
}

export default Notification = new Notification();
