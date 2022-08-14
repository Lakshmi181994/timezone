<?php

namespace Drupal\timezone\Services;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Class TimezoneDetails
 */

class TimezoneDetails {

  /**
   * Return timezone result
   */

public function getTimezoneDetails() {
    
    $config = \Drupal::configFactory()->get('timezone.settings');
    $country = $config->get('country');
    $city = $config->get('city');
    $timezone = $config->get('timezone');
    $input = new \DateTime('now', new \DateTimeZone($timezone));
    $result = \Drupal::service('date.formatter')->format( $input->getTimestamp(), 'custom', 'jS F Y \- h:i A'  );
    
    $return = [
        'timezone'=> $timezone,
        'result' => $result  
    ];   
   
    return $return;
    
  }

}
