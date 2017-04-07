<?php

namespace Drupal\sum\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SumForm extends FormBase {

  /**
    * {@inheritdoc}.
    */
  public function getFormId() {
    return 'sum_form';
  }
  /**
    * {@inheritdoc}.
    */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['number_one'] = [
      '#type' => 'number',
      '#title' => $this->t('Enter a number'),
    ];

    $form['plus'] = [
      '#markup' => '<h3> + </h3>',
    ];

    $form['number_two'] = [
      '#type' => 'number',
      '#title' => $this->t('Enter another number'),
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('='),
    ];
    return $form;
  }

  /**
    * {@inheritdoc}.
    */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message($this->t('@number_one + @number_two = @total', [
      '@number_one' => $form_state->getValue('number_one'),
      '@number_two' => $form_state->getValue('number_two'),
      '@total' => $this->doAddition($form_state),
      ]));
  }

  /**
    * {@inheritdoc}.
    */
  public function doAddition($form_state) {
    if(is_numeric($form_state->getValue('number_one')) && is_numeric($form_state->getValue('number_two'))) {
      return (float) $form_state->getValue('number_one') + (float) $form_state->getValue('number_two');
    }
    return FALSE;
  }
}
