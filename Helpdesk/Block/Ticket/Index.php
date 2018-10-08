<?php

namespace Petryk\Helpdesk\Block\Ticket;

use Magento\Catalog\Model\Session;
use Magento\Framework\Stdlib\DateTime;
use Magento\Framework\View\Element\Template;
use Petryk\Helpdesk\Model;

class Index extends Template
{
    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var Model\TicketFactory
     */
    protected $ticketFactory;

    /**
     * Index constructor.
     * @param Template\Context $context
     * @param DateTime $dateTime
     * @param Session $customerSession
     * @param Model\TicketFactory $ticketFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        DateTime $dateTime,
        Session $customerSession,
        Model\TicketFactory $ticketFactory,
        array $data = []
    ) {
        $this->dateTime = $dateTime;
        $this->customerSession = $customerSession;
        $this->ticketFactory = $ticketFactory;

        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public function getTickets()
    {
        return $this->ticketFactory->create()
            ->getCollection()
            ->addFieldToFilter('customer_id', $this->customerSession->getCustomerId());
    }

    public function getSeverities()
    {
        return Model\Ticket::getSeveritiesOptionArray();
    }
}
