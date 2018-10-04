<?php

namespace Petryk\HelloWorld\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '0.1.1', '<')) {
            $installer->getConnection()->dropColumn(
                $installer->getTable('petryk_topic'),
                'creation_time'
            );
        }

        $installer->endSetup();
    }
}
