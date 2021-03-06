<?php

namespace Unit5\Repository\Controller\Repository;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Unit5\Repository\Api\ExampleRepositoryInterface;

// this class is used to get the data from the database
class Example extends Action
{
    private $exampleRepository;
    private $searchCriteriaBuilder;
    private $filterBuilder;

    // constructor
    public function __construct(
        Context $context,
        ExampleRepositoryInterface $exampleRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder
    ) {
        $this->exampleRepository = $exampleRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        parent::__construct($context);
    }
    // this function is used to get the data from the database
    public function execute()
    {
        
        $this->getResponse()->setHeader('content-type', 'text/plain');
        $filters[] = array_map(function ($name) {
            return $this->filterBuilder
                ->setConditionType('eq')
                ->setField('name')
                ->setValue($name)
                ->create();
        }, ['Foo', 'Bar', 'Baz', 'Qux']);
        $this->searchCriteriaBuilder->addFilters($filters);
        $examples = $this->exampleRepository->getList(
            $this->searchCriteriaBuilder->create()
        )->getItems();
        foreach ($examples as $example) {
            $this->getResponse()->appendBody(sprintf(
                "%s (%d)\n",
                $example->getName(),
                $example->getId()
            ));
        }
    }
}