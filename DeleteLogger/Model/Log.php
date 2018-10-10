<?php

namespace Petryk\DeleteLogger\Model;

use Magento\Framework\Model\AbstractModel;

class Log extends AbstractModel
{
    const ENTITY_TYPE_CATEGORY = 'catalog_category';
    const ENTITY_TYPE_PRODUCT = 'catalog_product';
    const ENTITY_TYPE_CMS_PAGE = 'cms_page';

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('Petryk\DeleteLogger\Model\ResourceModel\Log');
    }

    /**
     * @return array
     */
    public function getEntityTypes()
    {
        return [
            self::ENTITY_TYPE_CATEGORY => __('Category'),
            self::ENTITY_TYPE_PRODUCT => __('Product'),
            self::ENTITY_TYPE_CMS_PAGE => __('CMS Page'),
        ];
    }
}
