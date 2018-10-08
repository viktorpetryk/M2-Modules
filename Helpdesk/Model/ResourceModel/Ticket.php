<?php

namespace Petryk\Helpdesk\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Ticket extends AbstractDb
{

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('petryk_helpdesk_ticket', 'ticket_id');
    }
}
