<?php

namespace Unit1\LogPathInfo;

class Log implements \Magento\Framework\Event\ObserverInterface{
    private $_logger;
    private $_request;

    public function __construct(\Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\RequestInterface $request){
            $this->_logger = $logger;
            $this->_request = $request;
        }
        public function execute(\Magento\Framework\Event\Observer $observer){
            $this->_logger->critical('Resquest URI: ' . $this->_request->getPathInfo());
    }
}