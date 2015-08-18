<?php

class Test_Brands_Adminhtml_BrandController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout()->renderLayout();
    }

    public function editAction()
    {
        $brand = Mage::getModel('test_brands/brand');
        if ($brandId = $this->getRequest()->getParam('id')) {
            $brand->load($brandId);

            if ($brand->getId() < 1) {
                $this->_getSession()->addError(
                    $this->__('This brand no longer exists.')
                );
                return $this->_redirect('*/*/');
            }

        }
        if ($postData = $this->getRequest()->getPost('brandData')) {
            try {
                if(!isset($brand->getData()['image'])) {
                    foreach ($_FILES['brandData']['name'] as $imgname => $img) {
                        if ($_FILES['brandData']['name'][$imgname] != '' && isset($_FILES['brandData']['name'][$imgname])) {
                            $imgArray = array(
                                'name' => $_FILES['brandData']['name'][$imgname],
                                'type' => $_FILES['brandData']['type'][$imgname],
                                'tmp_name' => $_FILES['brandData']['tmp_name'][$imgname],
                                'error' => $_FILES['brandData']['error'][$imgname],
                                'size' => $_FILES['brandData']['size'][$imgname]
                            );
                            $uploader = new Varien_File_Uploader($imgArray);
                            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
                            $uploader->setAllowRenameFiles(true);
                            $uploader->setFilesDispersion(false);

                            $path = Mage::getBaseDir('media') . DS . 'brands' . DS;

                            $name = Mage::helper('core')->getRandomString(30) . '.' . $this->_getFileType($imgArray['type']);

                            $uploader->save($path, $name);

                            $postData[$imgname] = 'brands' . DS . $uploader->getCorrectFileName($name);
                        } else {
                            if (isset($postData[$imgname]['delete']) and $postData[$imgname]['delete'] == 1) {
                                unlink(Mage::getBaseDir('media') . DS . $postData[$imgname]['value']);
                                $postData[$imgname] = null;
                            }
                        }
                    }
                }
                else
                {
                    unset($postData['image']);
                }

                $brand->addData($postData);
                $brand->save();
                /*
                 * To divide requests from create new row and edit existing
                 * */
                if ($brandId) {
                    $this->_getSession()->addSuccess($this->__('The brand with id %d has been saved.', $brandId));
                    return $this->_redirect(
                        '*/*/edit',
                        array('id' => $brand->getId())
                    );
                } else {
                    $this->_getSession()->addSuccess($this->__('The brand has been saved with id %d.', $brand->getId()));
                    return $this->_redirect(
                        '*/*/edit'
                    );
                }
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

        }
        Mage::register('current_brand', $brand);
        $brandEditBlock = $this->getLayout()->createBlock(
            'test_brands/adminhtml_brand_edit'
        );

        $this->loadLayout()
            ->_addContent($brandEditBlock)
            ->renderLayout();
    }

    public function deleteAction()
    {
        $delId = array();
        $brandId = $this->getRequest()->getParam('brand_id') ? : array($this->getRequest()->getParam('id'));
        if (!is_array($brandId)) {
            $this->_getSession()->addError($this->_getHelper()->__('Please select items'));
        } else {
            try {
                $brandModel = Mage::getModel('test_brands/brand');
                foreach ($brandId as $item) {
                    $brandModel->load($item)->delete();
                    $delId[] = $item;
                }
                $this->_getSession()->addSuccess($this->_getHelper()
                    ->__('Total of %d record(s) were deleted with id: %s',count($brandId),implode(', ', $delId)));

            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    protected function _isAllowed()
    {
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession->isAllowed('test_brands/brand');
                break;
        }
        return $isAllowed;
    }

    protected function _getFileType($name)
    {
        $type_arr = explode('/',$name);
        return $type_arr[count($type_arr)-1];
    }

}