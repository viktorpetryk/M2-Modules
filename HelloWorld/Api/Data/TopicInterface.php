<?php

namespace Petryk\HelloWorld\Api\Data;

interface TopicInterface
{
    const TOPIC_ID = 'topic_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const CREATION_TIME = 'creation_time';

    public function getId();

    public function getTitle();

    public function getContent();

    public function getCreationTime();

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id);

    /**
     * @param $title
     * @return mixed
     */
    public function setTitle($title);

    /**
     * @param $content
     * @return mixed
     */
    public function setContent($content);

    /**
     * @param $creationTime
     * @return mixed
     */
    public function setCreationTime($creationTime);
}
