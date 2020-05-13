<?php

/**
 * @file
 * Definition of views_random_pager.
 */

namespace Drupal\views_random\Plugin\views\pager;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\pager\PagerPluginBase;

/**
 * The plugin to handle full pager.
 *
 * @ingroup views_pager_plugins
 *
 * @ViewsPager(
 *   id = "random",
 *   title = @Translation("Random selection"),
 *   short_title = @Translation("Random"),
 *   help = @Translation("Random selection from list of items"),
 *   theme = "pager",
 *   register_theme = FALSE
 * )
 */
class Random extends PagerPluginBase {

  function summaryTitle() {
    return \Drupal::translation()
                  ->formatPlural($this->options['items'], '@count item', '@count items', ['@count' => $this->options['items']]);
  }

  function defineOptions() {
    $options = parent::defineOptions();
    $options['items'] = ['default' => 0];

    return $options;
  }

  /**
   * Provide the default form for setting options.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['items'] = [
      '#title' => t('Items'),
      '#type' => 'textfield',
      '#description' => t('The number of items to display. Enter 0 for no limit.'),
      '#default_value' => $this->options['items'],
    ];
  }

  function use_pager() {
    return FALSE;
  }

  function useCountQuery() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function render($input) {
    $view_name = $this->view->id();
    $display_name = $this->view->current_display;
    $settings = [
      $view_name => [
        $display_name => [
          'count' => $this->options['items'],
          'callbacks' => [],
        ]
      ]
    ];
    return [
      '#theme' => $this->themeFunctions(),
      '#attached' => [
        'library' => [
          'views_random/views-random',
        ],
        'drupalSettings' => [
          'viewsRandom' => $settings,
        ],
      ],
      '#parameters' => $input,
      '#route_name' => !empty($this->view->live_preview) ? '<current>' : '<none>',
    ];
  }

}
