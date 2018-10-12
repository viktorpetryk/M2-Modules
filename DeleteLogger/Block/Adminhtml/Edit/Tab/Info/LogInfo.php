<?php

namespace Petryk\DeleteLogger\Block\Adminhtml\Edit\Tab\Info;

use Magento\Backend\Block\Template;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime;
use Magento\User\Model\UserFactory;

class LogInfo extends Template
{
    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var
     */
    protected $localeDate;

    /**
     * @var UserFactory
     */
    protected $userFactory;

    /**
     * @var mixed
     */
    protected $log;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        UserFactory $userFactory,
        array $data = []
    ) {
        $this->localeDate = $context->getLocaleDate();
        $this->coreRegistry = $registry;
        $this->userFactory = $userFactory;
        $this->log = $this->coreRegistry->registry('petryk_deletelogger_log');
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function getLog()
    {
        return $this->coreRegistry->registry('petryk_deletelogger_log');
    }

    public function getEntityType()
    {
        $entityType = $this->log->getEntityType();
        $entityTypes = $this->log->getEntityTypes();

        return $entityTypes[$entityType];
    }

    public function getUserName()
    {
        $userId = $this->log->getUserId();
        $user = $this->userFactory->create()->load($userId);

        return $user['firstname'] . ' ' . $user['lastname'];
    }

    public function getDeletedAt()
    {
        $deletedAt = $this->log->getDeletedAt();

        return $this->formatDate($deletedAt, \IntlDateFormatter::MEDIUM, true);
    }
}
