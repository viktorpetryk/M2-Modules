<?php

namespace Petryk\DeleteLogger\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * DeleteLogger CRUD interface
 * @api
 */
interface LogRepositoryInterface
{
    /**
     * Save log
     *
     * @param \Petryk\DeleteLogger\Api\Data\LogInterface $log
     * @return \Petryk\DeleteLogger\Api\Data\LogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\LogInterface $log);

    /**
     * Retrieve log
     *
     * @param int $logId
     * @return \Petryk\DeleteLogger\Api\Data\LogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($logId);


    /**
     * Retrieve logs matching the specified criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Petryk\DeleteLogger\Api\Data\LogSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete log
     *
     * @param \Petryk\DeleteLogger\Api\Data\LogInterface $log
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\LogInterface $log);

    /**
     * Delete log by ID
     *
     * @param int $logId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($logId);
}
