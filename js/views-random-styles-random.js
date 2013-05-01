(function ($) {
  Drupal.ViewsRandomStyle = function(blocks, options) {
    function getRandomInt(min, max) {
      // https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/Math/random
      // Math.random() returns a floating-point, pseudo-random number
      // in the range [0, 1) that is, from 0 (inclusive) up to
      // but not including 1 (exclusive)
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    var s = $.extend({
      rows_number : 1
    }, options);

    if (s.rows_number && blocks) {
      var n = s.rows_number;
      while (blocks.length > 0 && n > 0) {
        var i = getRandomInt(0, blocks.length - 1);
        var selected = blocks[i];
        document.write(selected);
        blocks.splice(i, 1);
        n--;
      }
    }
  };

})(jQuery);
