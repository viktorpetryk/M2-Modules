<?php

namespace Petryk\DeleteLogger\Model\ResourceModel\Log;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Petryk\DeleteLogger\Model\Log', 'Petryk\DeleteLogger\Model\ResourceModel\Log');
    }
}
