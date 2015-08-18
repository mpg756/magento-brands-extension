<?php

class Test_Brands_Block_Adminhtml_Brand_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('brands_tabs');
        $this->setDestElementId('edit_form');
        $this->setTittle($this->helper('test_brands')->__('Manage Brands'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('edit_section', array(
            'label' => Mage::helper('test_brands')->__('Add Brand'),
            'title' => Mage::helper('test_brands')->__('Add Brand'),
            'content'=> $this->getLayout()->createBlock('test_brands/adminhtml_brand_edit')->toHtml()
        ));
/*        $this->addTab('products_section', array(
            'label' => Mage::helper('test_brands')->__('Add Brand'),
            'title' => Mage::helper('test_brands')->__('Add Brand'),
            'content'=> $this->getLayout()->createBlock('test_brands/adminhtml_brand_edit')->toHtml()
        ));*/
        return parent::_beforeToHtml();
    }
}