<?php

namespace Drupal\location_timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Cache\Cache;

/**
 * Provides a 'Location Timezone' block.
 *
 * @Block(
 *   id = "location_timezone_block",
 *   admin_label = @Translation("Location Timezone")
 * )
 */

class LocationTimezoneBlock extends BlockBase implements ContainerFactoryPluginInterface {
  
  /**
   * @var Drupal\location_timezone\Services\LocationTimezone $loctimezone
   */
  protected $loctimezone;

   /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\location_timezone\Services\LocationTimezone $loctimezone
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, locationTimezone $locdata) {
    $this->loctimezone = $locdata;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('location_timezone.details'),
    );
  }

  /**
   * {@inheritdoc}
   */

  public function build() {

    $locationtimezone = $this->loctimezone->getTimezoneDetails();
    return [
      '#theme' => 'location_timezone',
      '#timezone_data' => $locationtimezone,
      '#cache' => [
        'max-age' => 0
      ]
    ];
    
  }

}
