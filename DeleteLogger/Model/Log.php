<?php

namespace Petryk\DeleteLogger\Model;

use Magento\Framework\Model\AbstractModel;

class Log extends AbstractModel
{
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('Petryk\DeleteLogger\Model\ResourceModel\Log');
    }
}
