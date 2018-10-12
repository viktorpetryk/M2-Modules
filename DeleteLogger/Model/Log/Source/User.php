<?php

namespace Petryk\DeleteLogger\Model\Log\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\User\Model\UserFactory;

class User implements OptionSourceInterface
{
    protected $userFactory;

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }

    public function toOptionArray()
    {
        $userCollection = $this->userFactory->create()->getCollection();
        $usersData = $userCollection->load()->getData();

        $options = [];

        foreach ($usersData as $user) {
            $options[] = [
                'label' => $user['firstname'] . ' ' . $user['lastname'],
                'value' => $user['user_id'],
            ];
        }

        return $options;
    }
}
