<?php

namespace Petryk\HelloWorld\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangeDisplayText implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $displayText = $observer->getData('text');
        $displayText->setText('Hello from Observer');

        return $this;
    }
}
