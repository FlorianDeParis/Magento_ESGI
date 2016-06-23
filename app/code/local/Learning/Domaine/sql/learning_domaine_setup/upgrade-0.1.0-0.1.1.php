<?php
$installer = $this;
$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('learning_domaine/cepage'), 'is_active', array(
        'type' => Varien_Db_Ddl_Table::TYPE_BOOLEAN,
        'nullable' => false,
        'comment' => 'Actif'
    ));
$installer->endSetup();