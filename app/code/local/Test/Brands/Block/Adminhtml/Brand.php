<?php

/**
 * Created by PhpStorm.
 * User: valera
 * Date: 8/7/15
 * Time: 3:17 PM
 */
class Test_Brands_Block_Adminhtml_Brand extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'test_brands';

        $this->_headerText = Mage::helper('test_brands')->__('Brands Control');
        $this->_controller = 'adminhtml_brand';
    }

    public function getCreateUrl()
    {
        return $this->getUrl('test_brands_admin/brand/edit');
    }
}