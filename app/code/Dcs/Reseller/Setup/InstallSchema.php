<?php


namespace Dcs\Reseller\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
		$installer = $setup;
		$installer->startSetup();

		$table = $installer->getConnection()->newTable(
			$installer->getTable('dcs_reseller')
		)->addColumn(
			'id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Id'
		)->addColumn(
			'name',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Name'
		)->addColumn(
			'email',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'email'
		)->addColumn(
			'contactno',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['unsigned' => true, 'nullable' => true],
			'Contactno'
		)->addColumn(
			'enquiry',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			'2M',
			['nullable' => true],
			'Enquiry'
		)->addColumn(
			'postcode',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['unsigned' => true, 'nullable' => true],
			'Postcode'
		)->addColumn(
			'message',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			'2M',
			['nullable' => true,'default' => null],
			'message'
		)->addColumn(
			'created_at',
			\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
			null,
			['nullable' => false],
			'Created At'
		)->addColumn(
			'published_at',
			\Magento\Framework\DB\Ddl\Table::TYPE_DATE,
			null,
			['nullable' => true,'default' => null],
			'publish date'
		);
		$installer->getConnection()->createTable($table);
		$installer->endSetup();
	}
}