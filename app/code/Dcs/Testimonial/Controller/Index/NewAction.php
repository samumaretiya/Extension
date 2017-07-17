<?php
/**
 * @copyright Copyright (c) 2016 www.dcs.com
 */
namespace Dcs\Testimonial\Controller\Index;

use Dcs\Testimonial\Helper\Data;
use Dcs\Testimonial\Model\TestimonialFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\RequestInterface;

class NewAction extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \Dcs\Testimonial\Helper\Data
     */
    protected $_dataHelper;

    /**
     * @var \Dcs\Testimonial\Model\TestimonialFactory
     */
    protected $_testimonialFactory;

    /**
     * News constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Data $dataHelper
     * @param TestimonialFactory $testimonialFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Data $dataHelper,
        TestimonialFactory $testimonialFactory
    )
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_dataHelper = $dataHelper;
        $this->_testimonialFactory = $testimonialFactory;
    }

    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->set('Add New Testimonial');
        return $resultPage;
    }

}