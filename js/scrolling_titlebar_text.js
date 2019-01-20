(function($, Drupal, drupalSettings) {
  var scrl = document.title + drupalSettings.scrollingTitlebarText.endstring;
  scrl = scrl.substring(1, scrl.length) + scrl.substring(0, 1);
  (function titleScroller(text) {
    document.title = text;
    setTimeout(function () {
      titleScroller(text.substr(1) + text.substr(0, 1));
    }, drupalSettings.scrollingTitlebarText.speed);
  }(scrl));
})(jQuery, Drupal, drupalSettings);
