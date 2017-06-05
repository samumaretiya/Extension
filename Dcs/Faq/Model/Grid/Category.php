<?php
namespace Dcs\Faq\Model\Grid; 

//use \Dcs\Faq\Block\Category;

class Category implements \Magento\Framework\Option\ArrayInterface
{
    protected $_category;
    public function __construct(            
         \Dcs\Faq\Model\Category $category        
    ) {         
         $this->_category =$category;
    }
     

    public function getOptionArray()
    {
        $categoriesArray = $this->_category->getCollection()
            ->addFieldToSelect('*')
            //->addFieldToFilter('status' , 1)
            ->setOrder('sort_order' , 'ASC')             
            ->load()
            ->toArray();
        
        $categories = array(" " => "---Select Category---");
        foreach ($categoriesArray["items"] as $category)
        {
            
                $categories[$category['id']] = $category['name'];
            
        }
 
        return $categories;
    }
     public function getOptions()
    {
        $res = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }
   
    public function toOptionArray()
    {
        return $this->getOptions();
    }

    
      
}
