<?php
namespace Dcs\Faq\Block;

 
use Magento\Framework\View\Element\Template;

class Faq extends Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }   

   /* public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }*/
    protected $_items;    
 
    protected $_resource;
 
    protected $_faqCollection = null;
 
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Maxime\Jobs\Model\Job $job
     * @param \Maxime\Jobs\Model\Department $department
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Dcs\Faq\Model\Items $items,         
        \Magento\Framework\App\ResourceConnection $resource,
        \Dcs\Faq\Model\Category $category,
        \Dcs\Faq\Helper\Data $faqHelper,
        array $data = []
    ) {
        $this->_items = $items;        
        $this->_resource = $resource;
        $this->_category = $category;
        $this->_faqHelper = $faqHelper;
 
        parent::__construct(
            $context,
            $data
        );
    }

    protected function _getFaqCollection()
    {
        //if ($this->_faqCollection === null) {
 
            $faqCollection = $this->_items->getCollection()
                ->addFieldToSelect('*');               
 
            $this->_faqCollection = $faqCollection;
        //}
        return $this->_faqCollection;
    }

     public function getLoadedFaqCollection()
    {
        return $this->_getFaqCollection();
    }

    public function _getCategoryCollection()
    {
        $categoriesCollection = $this->_category->getCollection()
            ->addFieldToSelect('*')
            ->addFieldToFilter('status' , 1)
            ->setOrder('sort_order' , 'ASC');            
            
           $this->_categoriesCollection = $categoriesCollection;
           return $this->_categoriesCollection; 
        
    }

     public function getLoadedFaqCategoryCollection()
    {
        return $this->_getCategoryCollection();
    }
     public function isEnabled()
    {
         return $this->_faqHelper->isEnabled();
    }

    public function getFaqList()
    { 
    	echo "hello i m here BLOCK File";
    }
}
