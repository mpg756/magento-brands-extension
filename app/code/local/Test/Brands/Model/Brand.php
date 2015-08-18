<?php

class Test_Brands_Model_Brand extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('test_brands/brand');
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();

        $this->_updateTimestamps();
        //$this->_prepareUrlKey();

        return $this;
    }

    protected function _updateTimestamps()
    {
        $timestamp = Varien_Date::now();

        $this->setUpdatedAt($timestamp);

        if($this->isObjectNew()){
            $this->setCreatedAt($timestamp);
        }

        return $this;
    }

    protected function _prepareUrlKey()
    {
        //TODO check if entered url key is unique
        $url = $this->getUrlKey();

        return $this;
    }
}