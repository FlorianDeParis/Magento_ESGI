<?php

class Learning_Domaine_Model_Resource_Cepage_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        $this->_init('learning_domaine/cepage');
    }

    /**
     * Filter collection by status
     *
     * @return Learning_Domaine_Model_Resource_Cepage_Collection
     */
    public function addIsActiveFilter()
    {
        $this->addFieldToFilter('is_active', 1);

        return $this;
    }

}
