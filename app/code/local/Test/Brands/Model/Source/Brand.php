<?php

class Test_Brands_Model_Source_Brand
    extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        $brandCollection = Mage::getModel('test_brands/brand')->getCollection()
            ->setOrder('name', 'ASC');

        $options = array(
            array(
                'label' => '',
                'value' => '',
            ),
        );

        foreach ($brandCollection as $item) {
            $options[] = array(
                'label' => $item->getName(),
                'value' => $item->getId(),
            );
        }

        return $options;
    }

}