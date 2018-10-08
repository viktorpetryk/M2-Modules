<?php

namespace Petryk\Helpdesk\Controller\Ticket;

use Exception;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Data\Form\FormKey\Validator;
use Petryk\Helpdesk\Controller\Ticket;
use Petryk\Helpdesk\Model;

class Save extends Ticket
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var Validator
     */
    protected $formKeyValidator;

    /**
     * @var Model\TicketFactory
     */
    protected $ticketFactory;

    
    public function __construct(
        Context $context,
        Session $customerSession,
        Validator $formKeyValidator,
        Model\TicketFactory $ticketFactory
    ) {
        $this->customerSession = $customerSession;
        $this->formKeyValidator = $formKeyValidator;
        $this->ticketFactory = $ticketFactory;
        parent::__construct($context, $customerSession);
    }

    public
    function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$this->formKeyValidator->validate($this->getRequest())) {
            return $resultRedirect->setRefererUrl();
        }

        $title = $this->getRequest()->getParam('title');
        $severity = $this->getRequest()->getParam('severity');

        try {
            /* Save ticket */
            $ticket = $this->ticketFactory->create();
            $ticket->setCustomerId($this->customerSession->getCustomerId());
            $ticket->setTitle($title);
            $ticket->setSeverity($severity);
            $ticket->setCreatedAt($this->dateTime->formatDate(true));
            $ticket->setStatus(Model\Ticket::STATUS_OPENED);
            $ticket->save();

            $customer = $this->customerSession->getCustomerData();

        } catch (Exception $e) {
            $this->messageManager->addError(__('Error occurred during ticket creation.'));
        }

        return $resultRedirect->setRefererUrl();
    }
}
