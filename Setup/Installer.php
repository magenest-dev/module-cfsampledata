<?php
/**
 * Copyright © 2019 Magenest. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Magenest extension
 * NOTICE OF LICENSE
 *
 * @category Magenest
 * @package Magenest_CFSampleData
 */

namespace Magenest\CFSampleData\Setup;

use Magenest\CFSampleData\Model\Block;
use Magenest\CFSampleData\Model\Page;
use Magento\Framework\Setup;

class Installer implements Setup\SampleData\InstallerInterface
{
    /**
     * @var Page
     */
    private $page;

    /**
     * @var Block
     */
    private $block;

    protected $cmsBlock;

    public function __construct(Page $page,
                                Block $block,
                                \Magenest\CFSampleData\Model\CmsBlock $cmsBlock)
    {
        $this->page = $page;
        $this->block = $block;
        $this->cmsBlock = $cmsBlock;
    }

    /**
     * @inheritDoc
     */
    public function install()
    {
        $this->page->install(['Magenest_CFSampleData::fixtures/pages/magenest_pages.csv']);
        $this->block->install(['Magenest_CFSampleData::fixtures/block/magenest_blocks.csv']);
        //$this->cmsBlock->install(['Magenest_CFSampleData::fixtures/widgets/widget_blocks.csv']);
        // TODO: Implement install() method.
    }
}