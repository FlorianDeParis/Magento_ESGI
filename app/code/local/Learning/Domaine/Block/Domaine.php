<?php

class Learning_Domaine_Block_Domaine extends Mage_Core_Block_Template
{
    public function getCepages()
    {
        $cepages = Mage::getModel('learning_domaine/cepage')
            ->getCollection()
            ->addIsActiveFilter()
            ->addOrderByPosition();
        return $cepages;
    }


}
