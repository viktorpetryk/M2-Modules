<?php

namespace Petryk\DeleteLogger\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Petryk\DeleteLogger\Api\Data;
use Petryk\DeleteLogger\Api\LogRepositoryInterface;
use Petryk\DeleteLogger\Model;

class LogRepository implements LogRepositoryInterface
{
    /**
     * @var LogFactory
     */
    protected $logFactory;

    /**
     * @var ResourceModel\Log
     */
    protected $logResource;

    /**
     * @var ResourceModel\Log\CollectionFactory
     */
    protected $logCollectionFactory;

    /**
     * @var Data\LogSearchResultsInterfaceFactory
     */
    protected $logSearchResultsInterfaceFactory;

    /**
     * LogRepository constructor.
     * @param LogFactory $logFactory
     * @param ResourceModel\Log $logResource
     * @param ResourceModel\Log\CollectionFactory $logCollectionFactory
     * @param Data\LogSearchResultsInterfaceFactory $logSearchResultsInterfaceFactory
     */
    public function __construct(
        Model\LogFactory $logFactory,
        Model\ResourceModel\Log $logResource,
        Model\ResourceModel\Log\CollectionFactory $logCollectionFactory,
        Data\LogSearchResultsInterfaceFactory $logSearchResultsInterfaceFactory
    ) {
        $this->logFactory = $logFactory;
        $this->logResource = $logResource;
        $this->logCollectionFactory = $logCollectionFactory;
        $this->logSearchResultsInterfaceFactory = $logSearchResultsInterfaceFactory;
    }

    /**
     * Save log
     *
     * @param Data\LogInterface $log
     * @return Data\LogInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\LogInterface $log)
    {
        try {
            $this->logResource->save($log);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $log;
    }

    /**
     * Retrieve log
     *
     * @param int $logId
     * @return Data\LogInterface
     * @throws NoSuchEntityException
     */
    public function getById($logId)
    {
        $log = $this->logFactory->create();
        $this->logResource->load($log, $logId);

        if (!$log->getId()) {
            throw new NoSuchEntityException(__('Log with id "%1" does not exist.', $logId));
        }

        return $log;
    }

    /**
     * Retrieve logs matching the specified criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return Data\LogSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /* @var ResourceModel\Log\Collection $collection */
        $collection = $this->logCollectionFactory->create();

        /* @var Data\LogSearchResultsInterface $searchResult */
        $searchResult = $this->logSearchResultsInterfaceFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }

    /**
     * Delete log
     *
     * @param Data\LogInterface $log
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\LogInterface $log)
    {
        try {
            $this->logResource->delete($log);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * Delete log by ID
     *
     * @param int $logId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($logId)
    {
        return $this->delete($this->getById($logId));
    }
}
