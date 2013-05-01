<?php

class ViewsRandomPluginStyleUnformatted extends views_plugin_style {
  public function option_definition() {
    $options = parent::option_definition();
    $options['rows_number'] = array('default' => 1);

    return $options;
  }

  function options_form(&$form, &$form_state) {
  	parent::options_form($form, $form_state);

    $form['rows_number'] = array(
      '#type' => 'textfield',
      '#required' => TRUE,
      '#title' => t('Number of displayed rows'),
      '#default_value' => $this->options['rows_number'],
    );
  }

  public function options_validate(&$form, &$state) {
    $rows_number = $state['values']['style_options']['rows_number'];
    if (!is_numeric($rows_number) || intval($rows_number) <= 0) {
      form_error($form['rows_number'], t('Number of displayed rows must be positive integer.'));
    }
  }
}
