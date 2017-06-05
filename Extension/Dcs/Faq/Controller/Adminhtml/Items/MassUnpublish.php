<?php
namespace Dcs\Faq\Controller\Adminhtml\Items;
//use Dcs\Faq\Controller\Adminhtml\Items;
use Dcs\Faq\Model\Items;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;

    class MassUnpublish extends \Magento\Backend\App\Action
    {
      protected $filter;
 
    /**
     * @var CollectionFactory
     */
    protected $items;
       /**
        * @return void
        */
       public function __construct(Context $context, Filter $filter, Items $items)
    {
        $this->filter = $filter;
        $this->items = $items;
        parent::__construct($context);
    }
       public function execute()
        {
            $faqIds = $this->getRequest()->getParam('items');
            if (!is_array($faqIds) || empty($faqIds)) {
            $this->messageManager->addError(__('Please select faq(s).'));
        } 
        else
        {
                $faqCollection = $this->items->getCollection()
                    ->addFieldToFilter('id', ['in' => $faqIds]);
                try
                {                     
                        foreach ($faqIds as $faqId)
                        {
                            $model = $this->_objectManager->create('Dcs\Faq\Model\Items')->load($faqId);

                            if($model->getId())
                            {
                           $model->setStatus('0');
                            $model->save();
                            }
                             
                        }
                        $this->messageManager->addSuccess(
                            __('A total of %1 record(s) have been umpublished.', count($faqIds))
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
     
