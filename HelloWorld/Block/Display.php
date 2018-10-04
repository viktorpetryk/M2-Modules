<?php

namespace Petryk\HelloWorld\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class Display
 * @package Petryk\HelloWorld\Block
 */
class Display extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function helloWorld()
    {
        return __('Hello World!');
    }
}
