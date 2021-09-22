<?php

namespace Unit5\Repository\Model\Resource\Example;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
   implements \Magento\Framework\Api\Search\SearchResultInterface
{
    protected $aggregations; // aggreagations is a variable that holds the aggregations

    // this is the constructor
    protected function _construct()
    {
        $this->_init('Unit5\Repository\Model\Example', 
        'Unit5\Repository\Model\Resource\Example');    
    }

    // this is the method that will return the aggregations
    public function getAggregations()
    {
        return $this->aggregations;
    }

    // this is the method that will set the aggregations
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface 
    $searchCriteria = null)
    {
        return $this;
    }
    
    //this method get the total count 
    public function getTotalCount()
    {
        return $this->getSize(); // this method will return the size
    }

    // this method will set the total count 
    public function setTotalCount($totalCount)
    {
        return $this;
    }

}

