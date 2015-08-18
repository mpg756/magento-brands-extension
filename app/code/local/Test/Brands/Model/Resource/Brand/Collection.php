<?php

/**
 * Created by PhpStorm.
 * User: valera
 * Date: 8/7/15
 * Time: 3:09 PM
 */
class Test_Brands_Model_Resource_Brand_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();

        $this->_init('test_brands/brand','test_brands/brand');
    }
}