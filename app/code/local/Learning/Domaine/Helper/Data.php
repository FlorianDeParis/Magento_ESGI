<?php

/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 23/06/2016
 * Time: 10:19
 */



class Learning_Domaine_Helper_Data extends Mage_Core_Helper_Abstract
{
    const IMAGE_FOLDER = "cepage";

    /**
     * Renvoie l'URL de l'image
     * @param $filename
     * @return string
     */
    public function getImageUrl($filename)
    {
        return Mage::getBaseUrl('media') . self::IMAGE_FOLDER . '/' . $filename;
    }

}
