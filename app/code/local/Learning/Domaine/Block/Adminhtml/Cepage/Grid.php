<?php

class Learning_Domaine_Block_Adminhtml_Cepage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('entity_id');
        $this->setId('learning_domaine_cepage_grid');
        $this->setDefaultDir('asc');
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('learning_domaine/cepage')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return $this
     * @throws Exception
     */
    protected function _prepareColumns()
    {

        $this->addColumn('entity_id', array(
            'header' => $this->__('ID'),
            'align'  => 'right',
            'width'  => '50px',
            'index'  => 'entity_id'
        ));

        $this->addColumn('name', array(
            'header' => $this->__('Name'),
            'align'  => 'right',
            'width'  => '100px',
            'index'  => 'name'
        ));

        $this->addColumn('image_url', array(
            'header'  => $this->__('Status'),
            'index'   => 'image_url',
            'type'    => 'options',
            'align'   => 'left',
            'width'   => '100px'
        ));

        $this->addColumn('city', array(
            'header' => $this->__('City'),
            'align'  => 'right',
            'width'  => '100px',
            'index'  => 'position'
        ));
        $this->addColumn('region', array(
            'header' => $this->__('Region'),
            'align'  => 'right',
            'width'  => '100px',
            'index'  => 'region'
        ));
        $this->addColumn('country', array(
            'header' => $this->__('Coutry'),
            'align'  => 'right',
            'width'  => '100px',
            'index'  => 'country'
        ));

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('cepage');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'   => Mage::helper('learning_domaine')->__('Delete'),
            'url'     => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('learning_domaine')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('is_active', array(
            'label'      => Mage::helper('learning_domaine')->__('Change status'),
            'url'        => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name'   => 'is_active',
                    'type'   => 'select',
                    'class'  => 'required-entry',
                    'label'  => Mage::helper('learning_domaine')->__('Status'),
                    'values' => Mage::getSingleton('adminhtml/system_config_source_enabledisable')->toOptionArray()
                )
            )
        ));

        return $this;
    }

    /**
     * Get row URL on click
     *
     * @param $row
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
