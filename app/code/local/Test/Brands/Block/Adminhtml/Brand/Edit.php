<?php
class Test_Brands_Block_Adminhtml_Brand_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'test_brands';
        $this->_controller = 'adminhtml_brand';
        $this->_mode = 'edit';
        $newOrEdit = $this->getRequest()->getParam('id') ? $this->__('Edit') : $this->__('New');
        $this->_headerText = $newOrEdit . ' ' . $this->__('Brand');
    }
}