<?php

class Test_Brands_Helper_Brand extends Mage_Core_Helper_Abstract
{
    public function getBrandUrl(Test_Brands_Model_Brand $brand)
    {
        if (!$brand instanceof Test_Brands_Model_Brand) {
            return '#';
        }

        return $this->_getUrl(
            'brand/index/view',
            array(
                'url' => $brand->getUrlKey(),
            )
        );
    }


}