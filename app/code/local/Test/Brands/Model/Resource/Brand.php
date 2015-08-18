<?php

class Test_Brands_Model_Resource_Brand extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('test_brands/brand','entity_id');
    }
}