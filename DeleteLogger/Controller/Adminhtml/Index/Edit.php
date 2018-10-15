<?php

namespace Petryk\DeleteLogger\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Petryk\DeleteLogger\Model;

class Edit extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var Model\LogRepository
     */
    protected $logRepository;

    /**
     * Edit constructor.
     * @param Action\Context $context
     * @param PageFactory $pageFactory
     * @param Registry $registry
     * @param Model\LogRepository $logRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        Registry $registry,
        Model\LogRepository $logRepository
    ) {
        $this->resultPageFactory = $pageFactory;
        $this->coreRegistry = $registry;
        $this->logRepository = $logRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $logId = $this->getRequest()->getParam('log_id');

        if ($logId) {
            $log = $this->logRepository->getById($logId);

            if (!$log->getId()) {
                $this->messageManager->addErrorMessage(__('This log no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }

            $this->coreRegistry->register('petryk_deletelogger_log', $log);
        }

        $resultPage = $this->resultPageFactory->create();

        $resultPage->getConfig()->getTitle()->prepend(__('Log'));
        $resultPage->getConfig()->getTitle()->prepend('Log ' . $log->getId());

        return $resultPage;
    }
}
