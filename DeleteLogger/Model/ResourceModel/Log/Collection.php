<?php

namespace Petryk\DeleteLogger\Model\ResourceModel\Log;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'log_id';

    protected function _construct()
    {
        $this->_init('Petryk\DeleteLogger\Model\Log', 'Petryk\DeleteLogger\Model\ResourceModel\Log');
        // $this->_map['fields']['log_id'] = 'main_table.log_id';
    }
}
