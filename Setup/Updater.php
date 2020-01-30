<?php
/**
 * Copyright © 2019 Magenest. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Magenest_magento231_blank01 extension
 * NOTICE OF LICENSE
 *
 * @category Magenest
 * @package Magenest_magento231_blank01
 */

namespace Magenest\CFSampleData\Setup;

use Magento\Framework\Setup;

class Updater implements Setup\SampleData\InstallerInterface
{
    protected $widgetToCreate;

    protected $cmsBlock;

    public function __construct(\Magenest\CFSampleData\Model\CmsBlock $cmsBlock)
    {
        $this->cmsBlock = $cmsBlock;
        $this->widgetToCreate = [];
    }

    /**
     * @inheritDoc
     */
    public function install()
    {
        if (count($this->widgetToCreate)) {
            $this->cmsBlock->install($this->widgetToCreate);
        }
        $this->widgetToCreate = [];
        // TODO: Implement install() method.
    }

    public function setWidgetToCreate($widgetCsv){
        array_push($this->widgetToCreate, $widgetCsv);
        return $this;

    }
}