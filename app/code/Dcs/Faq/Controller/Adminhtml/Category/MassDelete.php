<?php
namespace Dcs\Faq\Controller\Adminhtml\Category;
 
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Dcs\Faq\Model\Category;
 
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $filter;
 
    /**
     * @var CollectionFactory
     */
    protected $category;
 
 
    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, Category $category)
    {
        $this->filter = $filter;
        $this->category = $category;
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
         $faqIds = $this->getRequest()->getParam('category');
        if (!is_array($faqIds) || empty($faqIds)) {
            $this->messageManager->addError(__('Please select Category(s).'));
        } else {
            $faqCollection = $this->category->getCollection()
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