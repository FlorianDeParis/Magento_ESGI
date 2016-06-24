<?php

class Learning_Domaine_Block_Adminhtml_Cepage_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('cepage_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('learning_domaine')->__('Cepage Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('learning_domaine')->__('Domaines liés'),
            'title' => Mage::helper('learning_domaine')->__('Domaines liés'),
            'content' => $this->getLayout()->createBlock('learning_domaine/adminhtml_cepage_edit_tab_form')->toHtml()
        ));

        return parent::_beforeToHtml();
    }

}
