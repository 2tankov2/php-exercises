
var ESC_KEYCODE = 27;
,
    isEscEvent: function (evt, action) {
      if (evt.keyCode === ESC_KEYCODE) {
        action();
        window.map.setDeactivePage();
      }
    },
    isButtonCkick: function (evt, action) {
      evt.preventDefault();
      action();
      window.map.setDeactivePage();
    },
    isMessageClick: function (action) {
      action();
      window.map.setDeactivePage();
    }