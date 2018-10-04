<?php

namespace Petryk\HelloWorld\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Petryk\HelloWorld\Api\Data\TopicInterface;

/**
 * Class Topic
 * @package Petryk\HelloWorld\Model
 */
class Topic extends AbstractModel implements IdentityInterface, TopicInterface
{
    const CACHE_TAG = 'petryk_topic';

    /**
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    protected function _construct()
    {
        $this->_init(\Petryk\HelloWorld\Model\ResourceModel\Topic::class);
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return parent::getData(self::TOPIC_ID);
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return parent::getData(self::TITLE);
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return parent::getData(self::CONTENT);
    }

    /**
     * @return mixed
     */
    public function getCreationTime()
    {
        return parent::getData(self::CREATION_TIME);
    }

    /**
     * @param mixed $id
     * @return AbstractModel|mixed|Topic
     */
    public function setId($id)
    {
        return $this->setData(self::TOPIC_ID, $id);
    }

    /**
     * @param $title
     * @return mixed|Topic
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @param $content
     * @return mixed|Topic
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }
}
