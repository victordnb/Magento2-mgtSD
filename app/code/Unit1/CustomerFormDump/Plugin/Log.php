<?php

namespace Unit1\CustomerFormDump\Plugin;

class Log
{
    protected $logger; // this variable will be used for save log messages.

//the constuctor
    public function __construct(\Psr\Log\LoggerInterface $logger){
        $this->logger = $logger;
    }

    // DataProviderWithDefaultAddresses is the name of the method that will be used for get the data.
    // to support the asynchronous management of customer addresses.
    public function afterGetData(\Magento\Customer\Model\Customer\DataProviderWithDefaultAddresses
     $subject, $result)
    {
        foreach($result as $customer){ // loop through the result array and save the data in the log.
            $this->logger->debug('data: ', $customer); // save the data in the log.
        return $result; //array returned
    }
}
