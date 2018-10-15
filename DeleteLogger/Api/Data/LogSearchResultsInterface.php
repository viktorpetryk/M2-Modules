<?php

namespace Petryk\DeleteLogger\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for DeleteLogger log search results
 * @api
 */
interface LogSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get logs list
     *
     * @return \Petryk\DeleteLogger\Api\Data\LogInterface[]
     */
    public function getItems();

    /**
     * Set logs list
     *
     * @param \Petryk\DeleteLogger\Api\Data\LogInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
