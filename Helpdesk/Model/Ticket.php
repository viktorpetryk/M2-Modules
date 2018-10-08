<?php

namespace Petryk\Helpdesk\Model;

use Magento\Framework\Model\AbstractModel;

class Ticket extends AbstractModel
{
    const STATUS_OPENED = 1;
    const STATUS_CLOSED = 2;

    const SEVERITY_LOW = 1;
    const SEVERITY_MEDIUM = 2;
    const SEVERITY_HIGH = 3;

    /**
     * @var array
     */
    protected static $statusesOptions = [
        self::STATUS_OPENED => 'Opened',
        self::STATUS_CLOSED => 'Closed',
    ];

    /**
     * @var array
     */
    protected static $severitiesOptions = [
        self::SEVERITY_LOW => 'Low',
        self::SEVERITY_MEDIUM => 'Medium',
        self::SEVERITY_HIGH => 'High',
    ];

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('Petryk\Helpdesk\Model\ResourceModel\Ticket');
    }

    /**
     * @return array
     */
    public static function getSeveritiesOptionArray()
    {
        return self::$severitiesOptions;
    }

    /**
     * @return mixed
     */
    public function getStatusAsLabel()
    {
        return self::$statusesOptions[$this->getStatus()];
    }

    /**
     * @return mixed
     */
    public function getSeverityAsLabel()
    {
        return self::$severitiesOptions[$this->getSeverity()];
    }
}
