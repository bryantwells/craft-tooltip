<?php
/**
 * Tooltip plugin for Craft CMS 3.x
 *
 * Transforms Craft's CP field instructions into a tooltip.
 *
 * @link      github.com/bryantwells
 * @copyright Copyright (c) 2020 Bryant Wells
 */

namespace bryantwells\tooltip\resources;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class TooltipAssetBundle extends AssetBundle
{
    public function init()
    {
        // path to publishable resources
        $this->sourcePath = '@bryantwells/tooltip/resources/dist';

        // dependencies
        $this->depends = [
            CpAsset::class,
        ];

        // relative path to CSS/JS files
        $this->js = ['main.js'];
        $this->css = ['main.css'];

        parent::init();
    }
}