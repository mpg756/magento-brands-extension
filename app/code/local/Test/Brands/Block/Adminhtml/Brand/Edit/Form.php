<?php
class Test_Brands_Block_Adminhtml_Brand_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    private $_productList = array();

    protected function _prepareForm()
    {
        $model = Mage::registry('current_brand');
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'test_brands_admin/brand/edit',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ));
//        $form->setUseContainer(true);
//        $this->setForm($form);


        $fieldsetMain = $form->addFieldset('general',
            array(
                'legend' => $this->__('Brand Details')
            )
        );


        $this->_addFieldsToFieldset($fieldsetMain, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
            'url_key' => array(
                'label' => $this->__('URL Key'),
                'input' => 'text',
                'required' => true,
            ),
            'description' => array(
                'label' => $this->__('Description'),
                'input' => 'textarea',
                'required' => true,
            ),
            'image' => array(
                'label' => $this->__('Image'),
                'input' => 'image',
                'required' => false,
            ),
            'link' => array(
                'label' => $this->__('Brand website link'),
                'input' => 'text',
                'required' => false,
                'name' => 'fileinputname',
            ),
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);


        return parent::_prepareForm();
    }

    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('brandData'));

        foreach($fields as $name => $data)
        {
            if($requestValue = $requestData->getData($name))
            {
                $data['value'] = $requestValue;
            }
            $data['name'] = "brandData[$name]";
            $data['title'] = $data['label'];
            if (!array_key_exists('value', $data)) {
                $_data['value'] = $this->_getBrand()->getData($name);
            }
            $fieldset->addField($name, $data['input'], $data);
        }

        return $this;
    }

    protected function _getBrand()
    {
        if(!$this->hasData('brand')){
            $brand = Mage::registry('current_brand');

            if(!$brand instanceof Test_Brands_Model_Brand){
                $brand = Mage::getModel('test_brands/brand');
            }

            $this->setData('brand', $brand);
        }
        return $this->getData('brand');
    }
}