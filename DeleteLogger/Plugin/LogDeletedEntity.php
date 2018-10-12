<?php

namespace Petryk\DeleteLogger\Plugin;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Stdlib\DateTime;
use Petryk\DeleteLogger\Model;

class LogDeletedEntity
{
    /**
     * @var Session
     */
    protected $authSession;

    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * @var Model\LogFactory
     */
    protected $logFactory;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * LogDeletedEntity constructor.
     * @param Session $authSession
     * @param DateTime $dateTime
     * @param Model\LogFactory $logFactory
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        Session $authSession,
        DateTime $dateTime,
        Model\LogFactory $logFactory,
        ManagerInterface $messageManager
    ) {
        $this->authSession = $authSession;
        $this->dateTime = $dateTime;
        $this->logFactory = $logFactory;
        $this->messageManager = $messageManager;
    }

    /**
     * @param EntityManager $entityManager
     * @param $result
     * @param $entity
     */
    public function afterDelete(EntityManager $entityManager, $result, $entity)
    {
        $entityType = $entity->getEventPrefix();
        $userId = $this->authSession->getUser()->getId();
        $deletedAt = $this->dateTime->formatDate(true);

        try {
            $log = $this->logFactory->create();
            $log->setEntityType($entityType);
            $log->setUserId($userId);
            $log->setDeletedAt($deletedAt);
            $log->save();
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('An error occurred during log saving.'));
        }
    }
}
