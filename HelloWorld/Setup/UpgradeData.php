<?php

namespace Petryk\HelloWorld\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $_topicFactory;

    public function __construct(\Petryk\HelloWorld\Model\TopicFactory $topicFactory)
    {
        $this->_topicFactory = $topicFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '0.1.1', '<')) {
            $data = [
                'title' => 'Topic 2',
                'content' => 'Content 2'
            ];

            $topic = $this->_topicFactory->create();
            $topic->addData($data)->save();
        }
    }
}
