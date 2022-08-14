<?php

namespace Drupal\location_timezone\Services;

use Drupal\Core\Datetime\DrupalDateTime;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Class LocationTimezone
 */

 
class LocationTimezone {
  /*
  * @var \Drupal\Core\Datetime\DrupalDateTime $datetime
  */
 protected $datetime;
/**
   * Constructs a new object.
   */
 public function __construct(DrupalDateTime $date_time) {
   $this->datetime = $date_time;
 }

/*
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('date.formatter')
    );
  }*
  /**
   * Return timezone details
   */

public function getTimezoneDetails() {
    
    $config = \Drupal::configFactory()->get('location_timezone.settings');
    $country = $config->get('country');
    $city = $config->get('city');
    $timezone = $config->get('timezone');
    $input = new \DateTime('now', new \DateTimeZone($timezone));
    //$result = \Drupal::service('date.formatter')->format( $input->getTimestamp(), 'custom', 'jS F Y \- h:i A'  );
    $result = $this->datetime->format( $input->getTimestamp(), 'custom', 'jS F Y \- h:i A'  );
    $k = 0;
    $timezone_render = [
        'timezone'=> $timezone,
        'result' => $result  
    ];   
    print_r($result);
    return $timezone_render;
    
  }

}
