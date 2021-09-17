<?php

namespace Unit2\HelloWorldController\Controller\Action;

class Index extends \Magento\Framework\App\Action\Action{
    protected $_pageFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ){
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute(){
        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_RAW);
        $result->setContents("Hello World!");
        return $result;
    }
}