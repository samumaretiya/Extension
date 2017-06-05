<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Faq\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;



class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
		
		
		if(version_compare($context->getVersion(), '0.0.6', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable( 'dcs_faq_items' ),
                'category',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null],
                'Category'
            );
        }
		if(version_compare($context->getVersion(), '0.0.3', '<')) {
        $table  = $installer->getConnection()
            ->newTable($installer->getTable('dcs_faq_category'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Id'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null],
                'Name'
            )->addColumn(
				'sort_order',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['default' => null],
				'Sort Order'
			)->addColumn(
				'status',
				\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
				null,
				['nullable' => false, 'default' => '1'],
				'Publish'
			);
		
        $installer->getConnection()->createTable($table);
		}
        $installer->endSetup();
    }
}
