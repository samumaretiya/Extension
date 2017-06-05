<?php

namespace Dcs\Faq\Block;
 
use Magento\Framework\View\Element\Template;

class Category extends Template
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
    
 
    protected $_resource;
    
 
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Maxime\Jobs\Model\Job $job
     * @param \Maxime\Jobs\Model\Department $department
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Dcs\Faq\Model\Category $category,
                 
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ) {
        $this->_category = $category;        
        $this->_resource = $resource;
        
 
        parent::__construct(
            $context,
            $data
        );
    }

    public function _getCategoryCollection()
    {
        $categoriesArray = $this->_category->getCollection()
            ->addFieldToSelect('*')
            ->addFieldToFilter('status' , 1)
            ->setOrder('sort_order' , 'ASC')             
            ->load()
            ->toArray();
        
        $categories = array("" => "---Select Category---");
         
        foreach ($categoriesArray["items"] as $category)
        {
            
                $categories[$category['id']] = $category['name'];
            
        }
 
        return $categories;
    }

     public function getLoadedFaqCategoryCollection()
    {
        return $this->_getCategoryCollection();
    }

      
}
