<?php

namespace Unit5\CustomerList\Controller\Repository;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;


class Customer extends Action
{
    private $customerRepository;
    private $searchCriteriaBuilder;
    private $filterGroupBuilder;
    private $filterBuilder;

    // this is the constructor
    public function __construct(
        Context $context,
        CustomerRepositoryInterface $customerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        FilterBuilder $filterBuilder
    ) {
        parent::__construct($context);
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->filterBuilder = $filterBuilder;
    }
    // this is the action method that is called
    //  when the customer controller is called
    public function execute()
    {
        // get the customer list from the customer repository
        $this->getResponse()->setHeader('content-type', 'text/plain');
        $this->addEmailFilter();
        $this->addNameFilter();
        $customers = $this->getCustomersFromRepository();
        if(!empty($customers)) {
            $this->getResponse()->appendBody(
                sprintf("List contains %s\n\n", get_class($customers[0]))
            );
            $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_RAW);
            $result->setContents('Hello World!');
        }
        
        foreach ($customers as $customer) {
            $this->outputCustomer($customer);
        }
    }
    // this is the method that adds the email filter
    private function addEmailFilter()
    {
        $emailFilter = $this->filterBuilder
            ->setField('email')
            ->setValue('%@example.com')
            ->setConditionType('like')
            ->create();
        $this->filterGroupBuilder->addFilter($emailFilter);
    }
    // this is the method that adds the name filter
    private function addNameFilter()
    {
        $nameFilter = $this->filterBuilder
            ->setField('firstname')
            ->setValue('Veronica')
            ->setConditionType('eq')
            ->create();
        $this->filterGroupBuilder->addFilter($nameFilter);

    // this is the method that gets the customer list from the customer repository
    private function getCustomersFromRepository()
    {
        $this->searchCriteriaBuilder->setFilterGroups(
            [$this->filterGroupBuilder->create()]
        );
        $criteria = $this->searchCriteriaBuilder->create();
        $customers = $this->customerRepository->getList($criteria);
        return $customers->getItems();
    }
    // this is the method that outputs the customer list to the screen.
    private function outputCustomer(
        \Magento\Customer\Api\Data\CustomerInterface $customer
    ) {
        $this->getResponse()->appendBody(sprintf(
            "\"%s %s\" <%s> (%s)\n",
            $customer->getFirstname(),
            $customer->getLastname(),
            $customer->getEmail(),
            $customer->getId()
        ));
    }
}