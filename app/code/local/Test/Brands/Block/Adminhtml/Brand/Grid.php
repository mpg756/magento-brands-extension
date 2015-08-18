<?php

class Test_Brands_Block_Adminhtml_Brand_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     *
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('test_brands/brand')->getCollection();

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl(
          '*/*/edit',
            array(
                'id' => $row->getId()
            )
        );
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'entity_id',
        ));

        $this->addColumn('image',array(
            'header' => $this->_getHelper()->__('Image'),
            'align'     =>'left',
            'width' => '100px',
            'index'     => 'image',
            'renderer'  => 'test_brands/adminhtml_brand_renderer_image'
        ));

        $this->addColumn('created_at',array(
            'header' => $this->_getHelper()->__('Created'),
            'type' => 'datatime',
            'index' => 'created_at'
        ));

        $this->addColumn('updated_at',array(
            'header' => $this->_getHelper()->__('Updated'),
            'type' => 'datatime',
            'index' => 'updated_at'
        ));

        $this->addColumn('name',array(
            'header' => $this->_getHelper()->__('Name'),
            'type' => 'text',
            'index' => 'name'
        ));

        $this->addColumn('description',array(
            'header' => $this->_getHelper()->__('Description'),
            'type' => 'text',
            'index' => 'description'
        ));

        $this->addColumn('lastname', array(
            'header' => $this->_getHelper()->__('Url Key'),
            'type' => 'text',
            'index' => 'url_key',
        ));



        return parent::_prepareColumns();
    }

    protected function _getHelper()
    {
        return Mage::helper('test_brands');
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('brand_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->_getHelper()->__('Delete'),
            'url' => $this->getUrl('*/*/delete', array(''=>'')),
            //'confirm' => $this->_getHelper()->__('Are you sure?'),
        ));

        return $this;
    }

}