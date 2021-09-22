<?php

namespace Unit5\Repository\Model;

use Magento\Framework\Api\Search\FilterGroup; 
use Magento\Framework\Api\SearchCriteriaInterface; 
use Unit5\Repository\Api\Data\ExampleInterface;
use Unit5\Repository\Api\Data\ExampleInterfaceFactory as ExampleDataFactory;
use Unit5\Repository\Api\Data\ExampleSearchResultsInterface;
use Unit5\Repository\Api\Data\ExampleSearchResultsInterfaceFactory;
use Unit5\Repository\Api\ExampleRepositoryInterface;
use Unit5\Repository\Model\Example as ExampleModel;
use Unit5\Repository\Model\Resource\Example\Collection as ExampleCollection;
use Magento\Framework\Api\SortOrder;

class ExampleRepository implements ExampleRepositoryInterface
{

    private $searchResultsFactory; // this is the factory for the search results

    private $exampleFactory; // this is the factory for the example
  
    private $exampleDataFactory; // this is the factory for the example data

    // this is the constructor for the repository
    public function __construct(
        ExampleSearchResultsInterfaceFactory $searchResultsFactory,
        ExampleFactory $exampleFactory,
        ExampleDataFactory $exampleDataFactory
    ) {
        $this->searchResultsFactory = $searchResultsFactory;
        $this->exampleFactory = $exampleFactory;
        $this->exampleDataFactory = $exampleDataFactory;
    }

    // this is the method that will return the example
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        
        $collection = $this->exampleFactory->create()->getCollection();
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $this->applySearchCriteriaToCollection($searchCriteria, $collection);
        $examples = $this->convertCollectionToDataItemsArray($collection);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($examples);
        return $searchResults;
    }
    // here we are converting the collection to an array of data items
    private function addFilterGroupToCollection(
        FilterGroup $filterGroup,
        ExampleCollection $collection
    ) {
        $fields = [];
        $conditions = [];
        foreach ($filterGroup->getFilters() as $filters) {
            foreach ($filters as $filter){
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
        }
        if ($fields) {
            $collection->addFieldToFilter($fields, $conditions);
        }
    }
    // here we are applying the search criteria to the collection
    private function convertCollectionToDataItemsArray(
        ExampleCollection $collection
    ) {
        $examples = array_map(function (ExampleModel $example) {
            $dataObject = $this->exampleDataFactory->create();
            $dataObject->setId($example->getId());
            $dataObject->setName($example->getName());
            $dataObject->setCreatedAt($example->getCreatedAt());
            $dataObject->setModifiedAt($example->getModifiedAt());
            return $dataObject;
        }, $collection->getItems());
        return $examples;
    }
    // in this method we are applying the search criteria to the collection
    private function applySearchCriteriaToCollection(
        SearchCriteriaInterface $searchCriteria,
        ExampleCollection $collection
    ) {
        $this->applySearchCriteriaFiltersToCollection(
            $searchCriteria,
            $collection
        );
        $this->applySearchCriteriaSortOrdersToCollection(
            $searchCriteria,
            $collection
        );
        $this->applySearchCriteriaPagingToCollection(
            $searchCriteria,
            $collection
        );
    }
    // filters are applied here
    private function applySearchCriteriaFiltersToCollection(
        SearchCriteriaInterface $searchCriteria,
        ExampleCollection $collection
    ) {
        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }
    }
    // sort orders are applied here
    private function applySearchCriteriaSortOrdersToCollection(
        SearchCriteriaInterface $searchCriteria,
        ExampleCollection $collection
    ) {
        $sortOrders = $searchCriteria->getSortOrders();

        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                $isAscending = $sortOrder->getDirection() == SortOrder::SORT_ASC;
                $collection->addOrder(
                    $sortOrder->getField(),
                    $isAscending ? 'ASC' : 'DESC'
                );
            }
        }
    }
    // Pagination??
    private function applySearchCriteriaPagingToCollection(
        SearchCriteriaInterface $searchCriteria,
        ExampleCollection $collection
    ) {
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
    }
}
