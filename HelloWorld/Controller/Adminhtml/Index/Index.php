<?php

namespace Petryk\HelloWorld\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $_resultPageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory
    ) {
        $this->_resultPageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();

        $resultPage->setActiveMenu('Petryk_HelloWorld::hello');
        $resultPage->getConfig()->getTitle()->prepend(__('Topics'));

        $resultPage->addBreadcrumb(__('Petryk'), __('Petryk'));
        $resultPage->addBreadcrumb(__('Hello World'), __('Topics'));

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Petryk_HelloWorld::hello');
    }
}
