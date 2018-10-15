<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Petryk\DeleteLogger\Block\Adminhtml\Edit\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Petryk\DeleteLogger\Model\LogRepository;

class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var LogRepository
     */
    protected $logRepository;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param LogRepository $logRepository
     */
    public function __construct(
        Context $context,
        LogRepository $logRepository
    ) {
        $this->context = $context;
        $this->logRepository = $logRepository;
    }

    /**
     * @return int|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getLogId()
    {
        try {
            return $this->logRepository->getById(
                $this->context->getRequest()->getParam('log_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }

        return null;
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
