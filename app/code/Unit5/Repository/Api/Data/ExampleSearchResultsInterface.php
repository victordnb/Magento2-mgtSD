<?php

namespace Unit5\Repository\Api\Data;

// this is just a dummy class to test the interface
interface ExampleSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{   
    public function getItems(); 
    public function setItems(array $items = null);
    
}