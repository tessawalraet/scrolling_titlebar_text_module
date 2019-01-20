<?php

/**
 * @file
 * Contains \Drupal\scrolling_titlebar_text\Form\ScrollingTitlebarSettings.
 */

namespace Drupal\scrolling_titlebar_text\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

class ScrollingTitlebarSettings extends ConfigFormBase {

  /**
  * {@inheritdoc}
  */

  public function getFormId() {
    return 'scrolling_titlebar_settings';
  }

  /**
  * {@inheritdoc}
  */

  protected function getEditableConfigNames() {
    return ['scrolling_titlebar_text.settings'];
  }

  /**
   * {@inheritdoc}
  */

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('scrolling_titlebar_text.settings');

    foreach (Element::children($form) as $variable) {
      $config->set($variable, $form_state->getValue($form[$variable]['#parents']));
    }
    $config->save();

    if (method_exists($this, '_submitForm')) {
      $this->_submitForm($form, $form_state);
    }

    parent::submitForm($form, $form_state);
  }

  /**
  * {@inheritdoc}
  */

  public function buildForm(array $form, \Drupal\Core\Form\FormStateInterface $form_state) {
    $config = $this->config('scrolling_titlebar_text.settings');

    $form['scrolling_titlebar_speed'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Scrolling Text Speed'),
      '#description' => $this->t('The Speed of the scrolling text effect of browsers title bar.'),
      '#default_value' => $config->get('scrolling_titlebar_speed'),
      '#size' => 5,
      '#maxlength' => 5,
    );

    $form['scrolling_titlebar_endstring'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Page Title End String'),
      '#description' => $this->t('Page title for scrolling ends with this end string.'),
      '#default_value' => $config->get('scrolling_titlebar_endstring'),
    );

    return parent::buildForm($form, $form_state);
  }
}
?>
