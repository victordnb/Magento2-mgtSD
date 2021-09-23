<?php

namespace Unit5\Repository\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface; 
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framwork\Setup\ModuleDataSetupInterface;

class AddTableData implements DataPatchInterface
{
    private $moduleDataSetup;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $setup = $this->moduleDataSetup;

        $setup->getConnection()->insertMultiple(
            $setup->getTable('training_repository_example'),
            [
                ['name' => 'Foo'],
                ['name' => 'Bar'],
                ['name' => 'Baz'],
                ['name' => 'Qux'],
            ]
        );
    }

    public function getAliases()
    {
        return [];
    }

    public static function getDependencies()
    {
        return [];
    }
}