<?php

namespace Petryk\DeleteLogger\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Petryk\DeleteLogger\Model;

class Edit extends Action
{
    protected $resultPageFactory;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Model\LogFactory
     */
    protected $logFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        Registry $registry,
        Model\LogFactory $logFactory
    ) {
        $this->resultPageFactory = $pageFactory;
        $this->registry = $registry;
        $this->logFactory = $logFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $logId = $this->getRequest()->getParam('log_id');
        $log = $this->logFactory->create();

        if ($logId) {
            $log->load($logId);

            if (!$log->getId()) {
                $this->messageManager->addErrorMessage(__('This log no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->registry->register('petryk_deletelogger_log', $log);

        $resultPage = $this->resultPageFactory->create();

        $resultPage->getConfig()->getTitle()->prepend(__('Log'));
        $resultPage->getConfig()->getTitle()->prepend('Log ' . $log->getId());

        return $resultPage;

    }
}
