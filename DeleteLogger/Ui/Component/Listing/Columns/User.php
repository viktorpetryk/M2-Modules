<?php

namespace Petryk\DeleteLogger\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\User\Model\UserFactory;

class User extends Column
{
    /**
     * @var UserFactory
     */
    protected $userFactory;

    /**
     * User constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UserFactory $userFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UserFactory $userFactory,
        array $components = [],
        array $data = []
    ) {
        $this->userFactory = $userFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);

        if (empty($dataSource['data']['items'])) {
            return $dataSource;
        }

        $fieldName = $this->getData('name');

        foreach ($dataSource['data']['items'] as &$item) {
            if (!empty($item[$fieldName])) {
                $item[$fieldName] = $this->renderFullName($item[$fieldName]);
            }
        }

        return $dataSource;
    }

    /**
     * @param $userId
     * @return string
     */
    protected function renderFullName($userId)
    {
        $user = $this->userFactory->create();
        $user->load($userId);

        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();

        return $firstName . ' ' . $lastName;
    }
}
