<?php

namespace Petryk\DeleteLogger\Model;

use Magento\Framework\Model\AbstractModel;
use Petryk\DeleteLogger\Api\Data\LogInterface;

class Log extends AbstractModel implements LogInterface
{
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('Petryk\DeleteLogger\Model\ResourceModel\Log');
    }

    /**
     * Get entity type
     *
     * @return string|null
     */
    public function getEntityType()
    {
        return $this->getData(self::ENTITY_TYPE);
    }

    /**
     * Get user ID
     *
     * @return int|null
     */
    public function getUserId()
    {
        return $this->getData(self::USER_ID);
    }

    /**
     * Get deleted at
     *
     * @return string|null
     */
    public function getDeletedAt()
    {
        return $this->getData(self::DELETED_AT);
    }

    /**
     * Set entity type
     *
     * @param string $entityType
     * @return LogInterface
     */
    public function setEntityType($entityType)
    {
        return $this->setData(self::ENTITY_TYPE, $entityType);
    }

    /**
     * Set user ID
     *
     * @param int $userId
     * @return LogInterface
     */
    public function setUserId($userId)
    {
        return $this->setData(self::USER_ID, $userId);
    }

    /**
     * Set deleted at
     *
     * @param string $deletedAt
     * @return LogInterface
     */
    public function setDeletedAt($deletedAt)
    {
        return $this->setData(self::DELETED_AT, $deletedAt);
    }

    /**
     * @return array
     */
    public function getAvailableEntityTypes()
    {
        return [
            self::ENTITY_TYPE_CATEGORY => __('Category'),
            self::ENTITY_TYPE_PRODUCT => __('Product'),
            self::ENTITY_TYPE_CMS_PAGE => __('CMS Page'),
        ];
    }
}
