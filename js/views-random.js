(function ($) {
  Drupal.behaviors.viewsRandom = {
    attach: function(context, settings) {
      var _getRandomKeys = function(items, count) {
        var keys = Object.keys(items).filter(function(key) {
          return !isNaN(key); // Is numeric.
        });

        var result = new Array(count),
          len = keys.length,
          taken = new Array(len);

        if (count > len) return keys;

        while (count--) {
          var x = Math.floor(Math.random() * len);
          result[count] = keys[x in taken ? taken[x] : x];
          taken[x] = --len;
        }

        return result;
      };

      $.each(settings.views_random, function(view_name, displays) {
        $.each(displays, function(display, count) {
          var view = $('.view-id-' + view_name + '.view-display-id-' + display, context);
          var items = $('.view-content .views-row', view);
          var lucky_keys = _getRandomKeys(items, count);

          // Keep N random items and delete rest.
          $.each(items, function(key, item) {
            if (lucky_keys.indexOf(key.toString()) < 0) {
              $(item).empty();
            }
          });

          $(view).removeClass('views-random-hide');
        });
      });
    }
  };
})(jQuery);
