<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 23/06/2016
 * Time: 08:39
 */

$installer = $this;
$installer->startSetup();

$cepageTable = $installer->getConnection()
    ->newTable($installer->getTable('learning_domaine/cepage'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    ))
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('image_url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('region', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('country', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array());

$installer->getConnection()->createTable($cepageTable);

$installer->endSetup();
