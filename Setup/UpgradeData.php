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
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magenest\CFSampleData\Setup\Updater;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var Setup\SampleData\Executor
     */
    protected $executor;

    /**
     * @var Updater
     */
    protected $updater;

    public function __construct(
        Setup\SampleData\Executor $executor,
        Updater $updater
    )
    {
        $this->executor = $executor;
        $this->updater = $updater;

    }

    /**
     * @inheritDoc
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        /** Install Widget */
        if (version_compare($context->getVersion(), '2.3.1', '<')) {
            $this->updater->setWidgetToCreate('Magenest_CFSampleData::fixtures/widgets/widget_blocks.csv');
            $this->executor->exec($this->updater);
        }
        $setup->endSetup();
        // TODO: Implement upgrade() method.
    }
}