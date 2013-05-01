<?php

/**
 * Implements hook_views_plugins().
 */
function views_random_views_plugins() {
  $plugins = array(
    'style' => array(
      'views_random_styles_unformatted' => array(
        'title' => t('Unformatted list (JS Random)'),
        'help' => t('Displays random rows (selected with JS) one after another.'),
        'path' =>  drupal_get_path('module', 'views_random') . '/plugins',
        'handler' => 'ViewsRandomPluginStyleUnformatted',
        'parent' => 'default',
        'theme' => 'views_random_styles_unformatted',
        'theme path' => drupal_get_path('module', 'views_random') . '/theme',
        'theme file' => 'theme.inc',
        'uses row plugin' => TRUE,
        'uses grouping' => FALSE,
        'uses options' => TRUE,
        'type' => 'normal',
      ),
    ),
  );

  return $plugins;
}
