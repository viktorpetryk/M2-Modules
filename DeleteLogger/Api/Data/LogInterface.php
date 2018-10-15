<?php

namespace Petryk\DeleteLogger\Api\Data;

/**
 * DeleteLogger Interface
 * @api
 */
interface LogInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const LOG_ID = 'log_id';
    const ENTITY_TYPE = 'entity_type';
    const USER_ID = 'user_id';
    const DELETED_AT = 'deleted_at';
    /**#@-*/

    /**
     * Entity types
     */
    const ENTITY_TYPE_CATEGORY = 'catalog_category';
    const ENTITY_TYPE_PRODUCT = 'catalog_product';
    const ENTITY_TYPE_CMS_PAGE = 'cms_page';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get entity type
     *
     * @return string|null
     */
    public function getEntityType();

    /**
     * Get user ID
     *
     * @return int|null
     */
    public function getUserId();

    /**
     * Get deleted at
     *
     * @return string|null
     */
    public function getDeletedAt();

    /**
     * Set ID
     *
     * @param int $id
     * @return LogInterface
     */
    public function setId($id);

    /**
     * Set entity type
     *
     * @param string $entityType
     * @return LogInterface
     */
    public function setEntityType($entityType);

    /**
     * Set user ID
     *
     * @param int $userId
     * @return LogInterface
     */
    public function setUserId($userId);

    /**
     * Set deleted at
     *
     * @param string $deletedAt
     * @return LogInterface
     */
    public function setDeletedAt($deletedAt);
}
