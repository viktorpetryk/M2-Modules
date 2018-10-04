<?php

namespace Petryk\HelloWorld\Block;

use Magento\Framework\View\Element\Template;

class Topic extends Template
{
    protected $_topicFactory;

    public function __construct(
        Template\Context $context,
        \Petryk\HelloWorld\Model\TopicFactory $topicFactory
    ) {
        $this->_topicFactory = $topicFactory;
        parent::__construct($context);
    }

    /**
     * @return Template
     */
    protected function _prepareLayout()
    {
        $topic = $this->_topicFactory->create();
        $collection = $topic->getCollection();

        foreach ($collection as $item) {
            var_dump($item->getData());
        }

        return parent::_prepareLayout();
    }
}
