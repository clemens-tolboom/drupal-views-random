<?php

/**
 * @file
 * Definition of views_random_pager.
 */

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\pager\PagerPluginBase;

/**
 * Plugin for views without pagers.
 *
 * @ingroup views_pager_plugins
 */
class Random extends PagerPluginBase {
  function summaryTitle() {
    return \Drupal::translation()->formatPlural($this->options['items'], '@count item', '@count items', ['@count' => $this->options['items']]);
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
}
