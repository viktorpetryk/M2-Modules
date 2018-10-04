<?php

namespace Petryk\HelloWorld\Model\ResourceModel\Topic;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Petryk\HelloWorld\Model\Topic::class, \Petryk\HelloWorld\Model\ResourceModel\Topic::class);
    }
}
