<?php

namespace Drupal\timezone\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TimezoneSettingsForm.
 *
 */
class TimezoneSettingsForm extends ConfigFormBase {

    /**
     * {@inheritdoc}
     */

    protected function getEditableConfigNames() {
        return ['timezone.settings'];
    }

    /**
     * {@inheritdoc}
     */

    public function getFormId() {
        return 'timezone_settings_form';
    }

    /**
     * {@inheritdoc}
     */

    public function buildForm(array $form, FormStateInterface $form_state) {
        // Get config.
        $config = $this->config('timezone.settings');
        
        $form['country'] = [ 
            '#type' => 'textfield',
            '#title' => $this->t('Country'),
            '#default_value' => $config->get('country'),
            '#size' => 60,
            '#maxlength' => 128,
            '#required' => TRUE,
        ]; 
        
        $form['city'] = [ 
            '#type' => 'textfield',
            '#title' => $this->t('City'),
            '#default_value' => $config->get('city'),
            '#size' => 60,
            '#maxlength' => 128,
            '#required' => TRUE,
      ];

        $form['type_options'] = [
            '#type' => 'value',
            '#value' => ['America/Chicago' => t('America/Chicago'),
                        'America/New_York' => t('America/New_York'),
                        'Asia/Tokyo' => t('Asia/Tokyo'),
                        'Asia/Dubai' => t('Asia/Dubai'),
                        'Europe/Amsterdam' => t('Europe/Amsterdam'),
                        'Europe/Oslo' => t('Europe/Oslo'),
                        'Europe/London' => t('Europe/London')]
      ];
     
        $form['timezone'] = [
            '#title' => t('Timezone'),
            '#type' => 'select',
            '#description' => "Select the timezone.",
            '#options' => $form['type_options']['#value'],
      ];
      
        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */

    public function submitForm(array &$form, FormStateInterface $form_state) {
        
        parent::submitForm($form, $form_state);

        $this->config('timezone.settings')
            ->set('country', $form_state->getValue('country'))
            ->set('city', $form_state->getValue('city'))
            ->set('timezone', $form_state->getValue('timezone'))
            ->save();
    }
}