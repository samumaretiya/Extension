<?php
/**
 * @copyright Copyright (c) 2016 www.dcs.com
 */
namespace Dcs\Testimonial\Model\Testimonial\Source;

use Magento\Framework\Option\ArrayInterface;

class IsActive implements ArrayInterface
{

    protected $_testimonial;

    /**
     * IsActive constructor.
     * @param \Dcs\Testimonial\Model\Testimonial $testimonia
     */
    public function __construct(\Dcs\Testimonial\Model\Testimonial $testimonia)
    {
        $this->_testimonial = $testimonia;
    }


    /**
     * Get options
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        $availableOptions = $this->_testimonial->getAvailableStatuses();
        foreach ($availableOptions as $key => $value){
            $options[] = [
                'label' => $value,
                'value' => $key
            ];
        }

        return $options;
    }
}
