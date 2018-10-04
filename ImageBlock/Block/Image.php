<?php

namespace Petryk\ImageBlock\Block;

use Magento\Framework\View\Element\Template;
use Petryk\ImageBlock\Helper\Data;

/**
 * Class Image
 * @package Petryk\ImageBlock\Block
 */
class Image extends Template
{
    /**
     * @var Data
     */
    protected $_helper;

    /**
     * Image constructor.
     * @param Template\Context $context
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Data $helper,
        array $data = []
    ) {
        $this->_helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * Check whether the image is uploaded
     *
     * @return bool
     */
    public function isImageUpload()
    {
        $imageUrlFromConfig = $this->_helper->getImageUrlFromConfig();

        if (!$imageUrlFromConfig) {
            return false;
        }

        return true;
    }

    /**
     * Return image url
     *
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getImageUrl()
    {
        return $this->_helper->getImageUrl();
    }

    /**
     * Return resized image url
     *
     * @return string
     */
    public function getResizedImageUrl()
    {
        return $this->_helper->getResizedImageUrl();
    }
}
