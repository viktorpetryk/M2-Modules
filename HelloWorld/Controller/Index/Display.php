<?php

namespace Petryk\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Display
 * @package Petryk\HelloWorld\Controller\Index
 */
class Display extends Action
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Display constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        $this->_resultPageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
//        $resultPage = $this->_resultPageFactory->create();
//        return $resultPage;

        $textDisplay = new \Magento\Framework\DataObject(['text' => 'Hello World']);
        $this->_eventManager->dispatch('petryk_helloworld_display_text', ['text' => $textDisplay]);

        echo $textDisplay->getText();

        exit;
    }
}
