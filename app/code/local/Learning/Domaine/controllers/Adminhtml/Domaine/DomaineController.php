<?php

class Learning_Domaine_Adminhtml_Domaine_SlideController extends Mage_Adminhtml_Controller_Action
{

    /**
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        return $this->loadLayout()->_setActiveMenu('learning_domaine');
    }

    /**
     * @return Mage_Core_Controller_Varien_Action
     */
    public function indexAction()
    {
        return $this->_initAction()->renderLayout();
    }

    /**
     * @return $this
     */
    public function newAction()
    {
        $this->_forward('edit');

        return $this;
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Learning_Domaine_Model_Slide $cepage */
        $cepage = Mage::getModel('learning_domaine/cepage')->load($id);

        if ($cepage->getId() || $id == 0) {

            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $cepage->setData($data);
            }
            Mage::register('cepage_data', $cepage);

            return $this->_initAction()->renderLayout();
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('learning_domaine')->__('Cepage does not exist'));

        return $this->_redirect('*/*/');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            $delete = (!isset($data['image_url']['delete']) || $data['image_url']['delete'] != '1') ? false : true;
            $data['image_url'] = $this->_saveImage('image_url', $delete);

            /** @var Learning_Domaine_Model_Slide $cepage */
            $cepage = Mage::getModel('learning_domaine/cepage');

            if ($id = $this->getRequest()->getParam('id')) {
                $cepage->load($id);
            }

            try {
                $cepage->addData($data);
                $cepage->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_domaine')->__('The cepage has been saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array(
                        'id'       => $cepage->getId(),
                        '_current' => true
                    ));

                    return;
                }

                $this->_redirect('*/*/');

                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $this->_getSession()->addException($e, Mage::helper('learning_domaine')->__('An error occurred while saving the cepage.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array(
                'id' => $this->getRequest()->getParam('id')
            ));

            return;
        }
        $this->_redirect('*/*/');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                /** @var Learning_Domaine_Model_Slide $cepage */
                $cepage = Mage::getModel('learning_domaine/cepage');
                $cepage->load($id)->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_domaine')->__('Cepage was successfully deleted'));
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                return;
            }
        }

        return $this->_redirect('*/*/');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function massDeleteAction()
    {
        $cepageIds = $this->getRequest()->getParam('cepage');
        if (!is_array($cepageIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('learning_domaine')->__('Please select cepage(s)'));
        } else {
            try {
                foreach ($cepageIds as $cepage) {
                    Mage::getModel('learning_domaine/cepage')->load($cepage)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_domaine')->__('Total of %d cepage(s) were successfully deleted', count($cepageIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        return $this->_redirect('*/*/index');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function massStatusAction()
    {
        $cepageIds = $this->getRequest()->getParam('cepage');
        if (!is_array($cepageIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select cepage(s)'));
        } else {
            try {
                foreach ($cepageIds as $cepage) {
                    Mage::getSingleton('learning_domaine/cepage')->load($cepage)->setIsActive($this->getRequest()->getParam('is_active'))->setIsMassupdate(true)->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_domaine')->__('Total of %d cepage(s) were successfully updated', count($cepageIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        return $this->_redirect('*/*/index');
    }

    /**
     *
     */
    protected function _saveImage($imageAttr, $delete)
    {
        if ($delete) {
            $image = '';
        } elseif (isset($_FILES[$imageAttr]['name']) && $_FILES[$imageAttr]['name'] != '') {
            try {
                $uploader = new Varien_File_Uploader($imageAttr);
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);
                $path = Mage::getBaseDir('media') . DS . 'cepage' . DS;
                $uploader->save($path, $_FILES[$imageAttr]['name']);
                $image = $_FILES[$imageAttr]['name'];
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                return $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        } else {
            $model = Mage::getModel('learning_domaine/cepage')->load($this->getRequest()->getParam('id'));
            $image = $model->getData($imageAttr);
        }
        return $image;
    }

}
