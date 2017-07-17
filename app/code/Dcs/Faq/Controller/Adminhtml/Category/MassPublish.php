<?php
namespace Dcs\Faq\Controller\Adminhtml\Category;
//use Dcs\Faq\Controller\Adminhtml\Items;
use Dcs\Faq\Model\Category;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;

    class MassPublish extends \Magento\Backend\App\Action
    {
      protected $filter;
 
    /**
     * @var CollectionFactory
     */
    protected $category;
       /**
        * @return void
        */
       public function __construct(Context $context, Filter $filter, Category $category)
    {
        $this->filter = $filter;
        $this->category = $category;
        parent::__construct($context);
    }
       
        public function execute()
        {
            $faqIds = $this->getRequest()->getParam('category');
            if (!is_array($faqIds) || empty($faqIds)) {
            $this->messageManager->addError(__('Please select FAQ Category(s).'));
        } 
        else
        {
                $faqCollection = $this->category->getCollection()
                    ->addFieldToFilter('id', ['in' => $faqIds]);
                try
                {                     
                        foreach ($faqIds as $faqId)
                        {
                            $model = $this->_objectManager->create('Dcs\Faq\Model\Category')->load($faqId);

                            if($model->getId())
                            {
                           $model->setStatus('1');
                            $model->save();
                            }
                             
                        }
                        $this->messageManager->addSuccess(
                            __('A total of %1 record(s) have been published.', count($faqIds))
                        );
                } 
                catch (\Exception $e)
                {
                        $this->messageManager->addError($e->getMessage());
                }
        }
            $resultRedirect = $this->resultRedirectFactory->create();

            return $resultRedirect->setPath('*/*/');
        }
    }
     
