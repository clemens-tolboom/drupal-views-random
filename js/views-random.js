(function ($) {
  Drupal.behaviors.viewsRandom = {
    attach: function(context, settings) {
      var _getRandom = function(arr, n) {
        var result = new Array(n),
          len = arr.length,
          taken = new Array(len);

        if (n > len) return arr;

        while (n--) {
          var x = Math.floor(Math.random() * len);
          result[n] = arr[x in taken ? taken[x] : x];
          taken[x] = --len;
        }

        return result;
      };

      $.each(settings.views_random, function(view_name, displays) {
        $.each(displays, function(display, count) {
          var view = $('.view-id-' + view_name + '.view-display-id-' + display, context);
          var items = $('.view-content', view).children();

          var keys = Object.keys(items).filter(function(key) {
            return !isNaN(key); // Is numeric.
          });

          var lucky_keys = _getRandom(keys, count);

          // Keep N random items and delete rest.
          $.each(items, function(key, item) {
            if (lucky_keys.indexOf(key.toString()) < 0) {
              $(item).empty();
            }
          });

          //@TODO: Show the view.
        });
      });
    }
  };
})(jQuery);
