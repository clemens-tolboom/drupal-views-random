<?php

function template_preprocess_views_random_styles_unformatted(&$vars) {
  $rows = $vars['rows'];

  $vars['classes'] = array();
  // Set up striping values.
  foreach ($rows as $id => $row) {
    $row_classes = array();
    $row_classes[] = 'views-row';
    $row_classes[] = 'views-row-' . ($id + 1);

    // There is no sense to set -first and -odd classes, because they will be wrong
    // because of JS-randomizer.

    // Flatten the classes to a string for each row for the template file.
    $vars['classes'][$id] = implode(' ', $row_classes);
  }

  drupal_add_js(drupal_get_path('module', 'views_random') . '/js/views-random-styles-random.js');
}
