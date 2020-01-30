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

use Magento\Framework\Setup;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Config\Model\ResourceModel\Config;
use Magento\Framework\Indexer\IndexerRegistry;
use Magento\Framework\App\Config\ReinitableConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Theme\Model\Data\Design\Config as DesignConfig;
use Magento\Theme\Model\ResourceModel\Theme;

class InstallData implements Setup\InstallDataInterface
{

    private $config;
    private $indexerRegistry;
    private $reIniTableConfig;
    private $theme;
    /**
     * @var Setup\SampleData\Executor
     */
    protected $executor;

    /**
     * @var Installer
     */
    protected $installer;

    public function __construct(Setup\SampleData\Executor $executor,
                                Installer $installer,
                                Config $config,
                                IndexerRegistry $indexerRegistry,
                                ReinitableConfigInterface $reIniTableConfig,
                                Theme $theme)
    {
        $this->executor = $executor;
        $this->config = $config;
        $this->theme = $theme;
        $this->indexerRegistry = $indexerRegistry;
        $this->reIniTableConfig = $reIniTableConfig;
        $this->installer = $installer;
    }

    /**
     * @inheritDoc
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->executor->exec($this->installer);
        /*$valueConfig = $this->getThemeIdMagenestCf();
        $this->config->saveConfig('design/theme/theme_id',$valueConfig,ScopeConfigInterface::SCOPE_TYPE_DEFAULT,0);
        $this->reIniTableConfig->reinit();
        $this->indexerRegistry->get(DesignConfig::DESIGN_CONFIG_GRID_INDEXER_ID)->reindexAll();*/
        // TODO: Implement install() method.
    }

    private function getThemeIdMagenestCf(){
        $themeIdDefault = 4;
        $themeTable = "theme";
        $themeCode = "Magenest/cf";
        $connection = $this->theme->getConnection();
        $select = $connection->select()->from($themeTable)->where(
            'code = ?',
            $themeCode
        );
        $row = $connection->fetchRow($select);
        if ($row && isset($row['theme_id'])){
            return $row['theme_id'];
        }else{
            return $themeIdDefault;
        }
    }
}