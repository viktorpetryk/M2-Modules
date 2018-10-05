<?php

namespace Petryk\CustomerAttribute\Setup;

use Magento\Customer\Model\Customer;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\AttributeRepository;

class InstallData implements InstallDataInterface
{
    /**
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;

    /**
     * @var \Magento\Eav\Model\AttributeRepository
     */
    private $_attributeRepository;

    /**
     * InstallData constructor.
     * @param EavSetupFactory $eavSetupFactory
     * @param AttributeRepository $attributeRepository
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        AttributeRepository $attributeRepository
    ) {
        $this->_eavSetupFactory = $eavSetupFactory;
        $this->_attributeRepository = $attributeRepository;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            Customer::ENTITY,
            'test_attribute',
            [
                'type' => 'int',
                'label' => 'Sample Attribute',
                'input' => 'select',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'required' => true,
                'default' => '0',
                'sort_order' => '100',
                'system' => false,
                'position' => '100'
            ]
        );

        $attribute = $this->_attributeRepository->get('customer', 'test_attribute');

        $setup->getConnection()->insertOnDuplicate(
            $setup->getTable('customer_form_attribute'),
            [
                ['form_code' => 'adminhtml_customer_address', 'attribute_id' => $attribute->getId()],
                ['form_code' => 'customer_address_edit', 'attribute_id' => $attribute->getId()],
                ['form_code' => 'customer_register_edit', 'attribute_id' => $attribute->getId()],
            ]
        );
    }
}
