<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\ComputerGames\Model\ResourceModel\Game;
use Unit6\ComputerGames\Model\Game as Model;
use Unit6\ComputerGames\Model\ResourceModel\Game as ResourceModel;
use Magento\Framework\Api\Search\SearchResultInterface;

/**
 * Class Collection
 * @package Unit6\ComputerGames\Model\ResourceModel\Game
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
    implements SearchResultInterface
{
    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }

    /**
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * @param AggregationInterface $aggregations
     * @return $this
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /**
     * Get search criteria.
     *
     * @return \Magento\Framework\Api\SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    /**
     * Set search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return $this
     */
    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null)
    {
        $this->searchCriteria = $searchCriteria;
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     * @return $this
     */
    public function setTotalCount($totalCount)
    {
        $this->setSize($totalCount);
        return $this;
    }

    /**
     * Set items list.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     * @return $this
     */
    public function setItems(array $items = null)
    {
        return $this;
    }

}