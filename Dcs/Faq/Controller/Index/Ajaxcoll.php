<?php

namespace Dcs\Faq\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\Page;
 
class Ajaxcoll extends Action
{
    protected $resultPageFactory;
    protected $_items;    

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Dcs\Faq\Model\Items $items,
        array $data = []
    )
    {
        $this->_items = $items;
        parent::__construct($context , $data);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
		ob_start();
        $id = $this->getRequest()->getParam('id');
        //var_dump($id, $this->getRequest()->getPostValue());
        $faqCollection = $this->_items->getCollection()
                ->addFieldToSelect('*')
                ->addFieldToFilter('status' , 1)
                ->setOrder('rank' , 'ASC');
                 if($id !=0 )
                {
                    $faqCollection->addFieldToFilter('category' , $id);
                }
                else
                {
                    $faqCollection->addFieldToFilter('category' , null);
                }
                $filter = \Magento\Framework\App\ObjectManager::getInstance(); 
				echo "<div id='faq'>";
                $countCollection = $faqCollection->count();
                if($countCollection > 0){
                    foreach ($faqCollection as $faq)
                    {
						$faqAnswer = $faq->getAnswer();
						$filterAnswer = $filter->get('Magento\Cms\Model\Template\FilterProvider')->getPageFilter()->filter($faqAnswer);						
                           echo "<div class='faqBox'><dt class='faqQuestion'>".$faq->getQuestion()."</dt>";
                           echo "<dd class='faqAnswer'>".$filterAnswer."</dd></div>";
                    }  
                } else {
                    echo "<span class='no-record'>". __("No Record Found")."</span>";
                }
                  echo "</div>";    	  
    }
}
