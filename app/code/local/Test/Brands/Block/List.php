<?php

class Test_Brands_Block_List extends Mage_Core_Block_Template
{
    public function getBrandCollection()
    {
        return Mage::getModel('test_brands/brand')->getCollection()
            ->setOrder('name', 'ASC');
    }
}