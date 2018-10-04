<?php

namespace Petryk\HelloWorld\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Topic extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('petryk_topic', 'topic_id');
    }
}
