<?php

namespace Unit2\CatalogProductPreference\Controller\Product;

use \Magento\Framework\Controller\ResultFactory;

class View extends \Magento\Framework\App\Action\Action
{

    public function execute()
    {
        $rawResult = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $rawResult->setContents('Hello world');
        return $rawResult;
    }
}
