<?php

namespace Drutiny\Plugin\Drupal8\Audit;

use Drutiny\Sandbox\Sandbox;
use Drutiny\Audit\AbstractAnalysis;

/**
 * Retrieve all Drupal settings. Settings can be set in settings.php in the $settings array.
 */
class SettingAnalysis extends AbstractAnalysis
{


    public function configure()
    {
        parent::configure();
    }

  /**
   * @inheritDoc
   */
    public function gather(Sandbox $sandbox)
    {

      $drush = $this->getTarget()->getService('drush');
      $settings = $drush->runtime(function () {
          return \Drupal\Core\Site\Settings::getAll();
      });

      if (!is_array($settings)) {
          throw new \Exception("Settings retrieved were not in a known format. Expected Array.");
      }

        $this->set('settings', $settings);
    }
}
