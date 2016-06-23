<?php

class Learning_Domaine_Block_Adminhtml_Cepage_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->_objectId   = 'id';
        $this->_blockGroup = 'learning_domaine';
        $this->_controller = 'adminhtml_cepage';

        $this->_updateButton('save', 'label', Mage::helper('learning_domaine')->__('Save Cepage'));
        $this->_updateButton('delete', 'label', Mage::helper('learning_domaine')->__('Delete Cepage'));
        $this->_removeButton('reset');

        $this->_addButton('saveandcontinue', array(
            'label'   => Mage::helper('learning_domaine')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class'   => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('cepage_data') && Mage::registry('cepage_data')->getId()) {
            return Mage::helper('learning_domaine')->__("Edit Cepage '%s'", Mage::registry('cepage_data')->getName());
        } else {
            return Mage::helper('learning_domaine')->__('Add Cepage');
        }
    }
}
