<?php

namespace Petryk\Helpdesk\Model\ResourceModel\Ticket;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Petryk\Helpdesk\Model\Ticket', 'Petryk\Helpdesk\Model\ResourceModel\Ticket');
    }
}
