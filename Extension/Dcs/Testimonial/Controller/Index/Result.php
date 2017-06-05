<?php
/**
 * @copyright Copyright (c) 2016 www.dcs.com
 */
namespace Dcs\Testimonial\Controller\Index;

use Dcs\Testimonial\Model\TestimonialFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Filesystem;
use Magento\Framework\View\Result\PageFactory;

class Result extends Action
{

    /**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    protected $cacheTypeList;

    protected $resultPageFactory;
    protected $testimonialFactory;
    protected $forwordFactory;
    /**
     * @var \Magento\Framework\Image\AdapterFactory
     */
    protected $adapterFactory;
    /**
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $uploader;
    /**
     * @var \Magento\Framework\Filesystem
     */
    //protected $filesystem;
    protected $_helper;


    /**
     * Recipient email config path
     */
    const XML_PATH_EMAIL_RECIPIENT = 'contact/email/recipient_email';
    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $_transportBuilder;

    /**
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    protected $inlineTranslation;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    //protected $storeManager;
    /**
     * @var \Magento\Framework\Escaper
     */
    protected $_escaper;

    protected $_filesystem;
    protected $_storeManager;
    protected $_directory;
    protected $_imageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        TestimonialFactory $testimonialFactory,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploader,
        \Magento\Framework\Filesystem $filesystem,
        \Dcs\Testimonial\Helper\Data $helper,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Escaper $escaper,

        //\Magento\Store\Model\StoreManagerInterface $storeManager,
        //\Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Image\AdapterFactory $imageFactory
    )
    {
        $this->_filesystem = $filesystem;
        $this->_storeManager = $storeManager;
        $this->_directory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_imageFactory = $imageFactory;

        $this->cacheTypeList = $cacheTypeList;
        $this->_helper = $helper;
        $this->adapterFactory = $adapterFactory;
        $this->uploader = $uploader;
        //$this->filesystem = $filesystem;
        $this->testimonialFactory = $testimonialFactory;
        $this->resultPageFactory = $pageFactory;
        parent::__construct($context);
        $this->_transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        //$this->storeManager = $storeManager;
        $this->_escaper = $escaper;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
		//echo '<pre>';print_r($data);exit;
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {


            //start block upload image
            if (isset($_FILES['avatar']) && isset($_FILES['avatar']['name']) && strlen($_FILES['avatar']['name'])) {
                /*
                * Save image upload
                */
                try {
                    $base_media_path = 'dcs/testimonial/images/';
                    $uploader = $this->uploader->create(
                        ['fileId' => 'avatar']
                    );
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    $imageAdapter = $this->adapterFactory->create();
                    $uploader->addValidateCallback('image', $imageAdapter, 'validateUploadFile');
                    $uploader->setAllowRenameFiles(true);
                    $mediaDirectory = $this->_filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                    $result = $uploader->save(
                        $mediaDirectory->getAbsolutePath($base_media_path)
                    );

                    // Resize and keep save new folder //
                    $this->imageResize($_FILES['avatar']['name']);
                    // Resize and keep save new folder //

                    $data['avatar'] = $result['name'];
                } catch (\Exception $e) {
                    if ($e->getCode() == 0) {
                        $this->messageManager->addError($e->getMessage());
                    }
                }
            }
            //end block upload image

            /** @var \Dcs\Testimonial\Model\Testimonial $model */
            $model = $this->_objectManager->create('Dcs\Testimonial\Model\Testimonial');

            $id = $this->getRequest()->getParam('dcs_testimonial_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            // Check approved
            if ($this->_helper->isApprove() == 1) {
                $model->setIsActive(2);
                if($this->_helper->isApproveEmail() ==1){
                    //$model->sendApprovedEmailToCustomer();
                }
            }

            try {
                $model->save();

                // Start send email
                if($this->_helper->isSubmitEmail() ==1){
                    //$model->sendSubmittedEmailToCustomer();
                }
                // End send email

                $this->cacheTypeList->invalidate('full_page');
                $this->messageManager->addSuccess(__($this->_helper->getMessageThankYou()));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['dcs_testimonial_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Testimonial.'));
            }

            return $resultRedirect->setPath('*/*/index', ['dcs_testimonial_id' => $this->getRequest()->getParam('dcs_testimonial_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    public function imageResize($data)
    {
        $image = $data;

        $absPath = $this->_filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath('dcs/testimonial/images/') . $image;

        $imageResized = $this->_filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath('dcs/testimonial/images/resized/') . $image;

        $imageResize = $this->_imageFactory->create();

        $imageResize->open($absPath);

        $resizeImage = 400;

        // get origin width image
        $widthOld = $imageResize->getOriginalWidth();

        // get origin height image
        $heightOld = $imageResize->getOriginalHeight();
        $scaleWidth = ($widthOld/$heightOld);
        $scaleHeight = ($heightOld/$widthOld);

        if($widthOld > $heightOld)
        {
            $imageResize->resize(null, $resizeImage);
            $newWidth = round($scaleWidth * $resizeImage);
            $imageResize->crop(0, ($newWidth - $resizeImage) / 2, ($newWidth - $resizeImage) / 2, 0);
        }else{
            $imageResize->resize($resizeImage, null);
            $newHeight = round($scaleHeight * $resizeImage);
            $imageResize->crop(($newHeight - $resizeImage) / 2, 0, 0, ($newHeight - $resizeImage) / 2);
        }
        $dest = $imageResized;

        $imageResize->save($dest);


        $resizedURL = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'dcs/testimonial/images/resized/' . $image;

    }
}