<?php
/**
 * Tooltip plugin for Craft CMS 3.x
 *
 * Transforms Craft's CP field instructions into a tooltip.
 *
 * @link      github.com/bryantwells
 * @copyright Copyright (c) 2020 Bryant Wells
 */

namespace bryantwells\tooltip;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use craft\helpers\Json;

use bryantwells\tooltip\resources\TooltipAssetBundle;

use yii\base\Event;

/**
 * Class Tooltip
 *
 * @author    Bryant Wells
 * @package   Tooltip
 * @since     1.0.0
 *
 */
class Tooltip extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Tooltip
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     * @var bool
     */
    public $hasCpSection = false;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // check for cp request, logged in user, and test url segments for entries page
        if (Craft::$app->getRequest()->getIsCpRequest() 
            && Craft::$app->getUser()->getIdentity()
            && sizeof(Craft::$app->getRequest()->segments) > 2) {

            $desiredPath = !empty(array_intersect(
                ['entries', 'categories', 'globals', 'users', 'assets'],
                Craft::$app->getRequest()->segments));

            if ($desiredPath) {
                // Register asset bundle
                Craft::$app->getView()->registerAssetBundle(TooltipAssetBundle::class);

                // register javascript file
                Craft::$app->getView()->registerJs("generateTooltips();"); 
            }
        }

        Craft::info(
            Craft::t(
                'tooltip',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
