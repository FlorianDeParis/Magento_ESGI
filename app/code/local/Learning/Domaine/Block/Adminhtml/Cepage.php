<?php

class Learning_Domaine_Block_Adminhtml_Cepage extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller     = 'adminhtml_cepage';
        $this->_blockGroup     = 'learning_domaine';
        $this->_headerText     = Mage::helper('learning_domaine')->__('Manage Cepages');
        $this->_addButtonLabel = Mage::helper('learning_domaine')->__('Add Cepage');
        parent::__construct();
    }
}
