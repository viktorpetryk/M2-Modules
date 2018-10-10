<?php

namespace Petryk\DeleteLogger\Model\Log;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Petryk\DeleteLogger\Model\ResourceModel\Log\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var \Petryk\DeleteLogger\Model\ResourceModel\Log\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        DataPersistorInterface $dataPersistor,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        /** @var \Petryk\DeleteLogger\Model\Log $log */
        foreach ($items as $log) {
            $this->loadedData[$log->getId()] = $log->getData();
        }

        $data = $this->dataPersistor->get('petryk_deletelogger_log');

        if (!empty($data)) {
            $log = $this->collection->getNewEmptyItem();
            $log->setData($data);
            $this->loadedData[$log->getId()] = $log->getData();
            $this->dataPersistor->clear('petryk_deletelogger_log');
        }

        return $this->loadedData;
    }
}
