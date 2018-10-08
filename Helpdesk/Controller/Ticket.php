<?php

namespace Petryk\Helpdesk\Controller;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;

abstract class Ticket extends Action
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * Ticket constructor.
     * @param Context $context
     * @param Session $customerSession
     */
    public function __construct(
        Context $context,
        Session $customerSession
    ) {
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }

    /**
     * @param RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function dispatch(RequestInterface $request)
    {
        if (!$this->customerSession->authenticate()) {
            $this->_actionFlag->set('', 'no-dispatch', true);

            if (!$this->customerSession->getBeforeUrl()) {
                $this->customerSession->setBeforeUrl($this->_redirect->getRefererUrl());
            }
        }

        return parent::dispatch($request);
    }
}
