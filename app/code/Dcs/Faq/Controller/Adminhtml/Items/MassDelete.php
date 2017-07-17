<?php
namespace Dcs\Faq\Controller\Adminhtml\Items;
 
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Dcs\Faq\Model\Items;
 
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $filter;
 
    /**
     * @var CollectionFactory
     */
    protected $items;
 
 
    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, Items $items)
    {
        $this->filter = $filter;
        $this->items = $items;
        parent::__construct($context  );
    }
    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
         $faqIds = $this->getRequest()->getParam('items');
        if (!is_array($faqIds) || empty($faqIds)) {
            $this->messageManager->addError(__('Please select faq(s).'));
        } else {
            $faqCollection = $this->items->getCollection()
                ->addFieldToFilter('id', ['in' => $faqIds]);
            try {
                foreach ($faqCollection as $faq) {
                    $faq->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($faqIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}