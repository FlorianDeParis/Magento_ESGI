<?php

/* @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = Mage::getResourceModel('catalog/setup', 'catalog_setup');

$installer->startSetup();

$installer->getConnection()->addColumn(
        $installer->getTable('catalog/product'), 'cepage_name', array(
    'type' => Varien_Db_Ddl_Table::TYPE_VARCHAR,
    'length' => 255,
    'comment' => 'cepage name'
        )
);

$installer->addAttribute(
        'catalog_product', 'cepage_name', array(
    'label' => 'Cepage name',
    'type' => 'static'
        )
);

$installer->endSetup();
