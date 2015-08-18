<?php
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = Mage::getResourceModel('catalog/setup', 'catalog_setup');

$installer->removeAttribute(Mage_Catalog_Model_Product::ENTITY, 'brand_id');

$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'brand_id', array(
    'type'          => 'int',
    'input'         => 'select',
    'required'      => false,
    'group'         => 'General',
    'label'         => 'Brand',
    'source'        => 'test_brands/source_brand',
    'visible'       => true,
    'user_defined'  => true,
));


/*$brandAttribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'brand_id');
$brandAttribute->setData('used_in_forms', array('adminhtml_brand'));

$brandAttribute->save();*/

$installer->endSetup();
/*
 * http://fishpig.co.uk/magento/tutorials/addattributetofilter/
 * https://wiki.magento.com/display/m1wiki/Using+Magento+1.x+collections
 * http://devdocs.magento.com/guides/m1x/magefordev/mage-for-dev-8.html
 *
 * Mage::getResourceModel('
 */