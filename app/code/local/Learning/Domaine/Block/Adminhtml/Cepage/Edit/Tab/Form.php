<?php

class Learning_Domaine_Block_Adminhtml_Cepage_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('cepage_form', array('legend' => Mage::helper('learning_domaine')->__('Cepage information')));

        $fieldset->addType('image', 'Learning_Domaine_Block_Adminhtml_Form_Renderer_Image');

        $fieldset->addField('name', 'text', array(
            'label'    => Mage::helper('learning_domaine')->__('Name'),
            'name'     => 'name',
            'class'    => 'required-entry',
            'required' => true
        ));

        $fieldset->addField('image_url', 'image', array(
            'label'     => Mage::helper('learning_domaine')->__('Image'),
            'required'  => false,
            'name'      => 'image_url',
            'directory' => 'cepage/'
        ));

        $fieldset->addField('is_active', 'select', array(
            'label'    => Mage::helper('learning_domaine')->__('Status'),
            'name'     => 'is_active',
            'class'    => 'required-entry',
            'values'   => Mage::getSingleton('adminhtml/system_config_source_enabledisable')->toOptionArray(),
            'required' => true
        ));

        $fieldset->addField('region', 'text', array(
            'label'    => Mage::helper('learning_domaine')->__('Region'),
            'name'     => 'region',
            'required' => true,
        ));

        if (Mage::getSingleton('adminhtml/session')->getCepageData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getCepageData());
            Mage::getSingleton('adminhtml/session')->getCepageData(null);
        } elseif (Mage::registry('cepage_data')) {
            $form->setValues(Mage::registry('cepage_data')->getData());
        }

        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return Mage::helper('learning_domaine')->__('Cepage Information');
    }

    public function getTabTitle()
    {
        return Mage::helper('learning_domaine')->__('Cepage Information');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}
