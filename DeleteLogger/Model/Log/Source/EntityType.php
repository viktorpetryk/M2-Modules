<?php

namespace Petryk\DeleteLogger\Model\Log\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Petryk\DeleteLogger\Model\Log;

class EntityType implements OptionSourceInterface
{
    /**
     * @var Log
     */
    protected $log;

    /**
     * EntityType constructor.
     * @param Log $log
     */
    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function toOptionArray()
    {
        $availableOptions = $this->log->getEntityTypes();
        $options = [];

        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }

        return $options;
    }
}
