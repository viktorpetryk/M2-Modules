<?php

namespace Petryk\HelloWorld\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $_topicFactory;

    public function __construct(\Petryk\HelloWorld\Model\TopicFactory $topicFactory)
    {
        $this->_topicFactory = $topicFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $data = [
            'title' => 'Topic 1',
            'content' => 'Sample content 1'
        ];

        $topic = $this->_topicFactory->create();

        $topic->addData($data)->save();
    }
}
