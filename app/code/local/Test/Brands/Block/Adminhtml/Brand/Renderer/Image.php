<?php
/**
 * Created by PhpStorm.
 * User: valera
 * Date: 8/13/15
 * Time: 2:19 PM
 */

class Test_Brands_Block_Adminhtml_Brand_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
        if($index = $row->getData($this->getColumn()->getIndex())) {
            $html = '<img ';
            $html .= 'id="' . $this->getColumn()->getId() . '" ';
            $html .= 'class="small-image-preview v-middle" height="50"';
            $html .= 'src="/' .'media' . DS . $index . '"';
            $html .= 'class="grid-image ' . $this->getColumn()->getInlineCss() . '"/>';
            return $html;
        }
        else{
            $html = '<img ';
            $html .= 'class="small-image-preview v-middle" height="50"';
            $html .= 'src="' . $this->getSkinUrl('images/placeholder/thumbnail.jpg') . '"';
            $html .= 'class="grid-image "/>';
            return $html;
        }
    }
}

