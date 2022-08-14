<?php

namespace Drupal\timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;

/**
 * Provides a 'TimeZone' block.
 *
 * @Block(
 *   id = "display_timezone",
 *   admin_label = @Translation("Timezone")
 * )
 */

class DisplayTimeZone extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function build() {

    $getdisplaytimezone = \Drupal::service('timezone.timezonedetails')->getTimezoneDetails();

    return [
      '#theme' => 'display_time_zone',
      '#displaytimezone' => $getdisplaytimezone,
      '#cache' => [
        'max-age' => 0
      ]
    ];
    
  }

}
