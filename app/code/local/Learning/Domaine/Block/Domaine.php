<?php

class Learning_Domaine_Block_Domaine extends Mage_Core_Block_Template
{
    public function getSlides()
    {
        $cepages = Mage::getModel('learning_domaine/cepage')
            ->getCollection()
            ->addIsActiveFilter()
            ->addOrderByPosition();
        return $cepages;
    }


}
