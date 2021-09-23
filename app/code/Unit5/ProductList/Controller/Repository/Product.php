<?php

//this file contains the product class
//it is used to store the product information
//and to perform operations on the product
//it is also used to validate the product

namespace Unit5\ProductList\Controller\Repository;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableProduct;


// This Class is used to get the list of products from the database
class Product extends Action{
    
    private $productRepository;
    private $searchCriteriaBuilder;
    private $sortOrderBuilder;
    private $filterBuilder;

    //this is a constructor
    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        FilterBuilder $filterBuilder) 
        {
            parent::__construct($context);
            $this->productRepository = $productRepository;
            $this->searchCriteriaBuilder = $searchCriteriaBuilder;
            $this->sortOrderBuilder = $sortOrderBuilder;
            $this->filterBuilder = $filterBuilder;
        }
    //this is the action method which is called when the controller is called and the action is called
    public function execute(){  
        $this->getRespose()->setHeader('Content-Type', 'text/plain');
        $products = $this->getProductFromRepository();
        foreach($products as $product){
            $this->outputProduct($product);
        }
    }    
    //get product from repository
    Private function getProductFromRepository(){
        $this->setProductTypeFilter();
        $this->setProductNameFilter();
        $this->setProductOrder();
        $this->setProductPaging();

        $criteria = $this->searchCriteriaBuilder->create();
        $product = $this->productRepository->getList($criteria);
        return $products->getItems();
    }
    
    //set product type filter
    private function setProductTypeFilter(){
        $configProductFilter = $this->filterBuilder
            ->setField('type_id')
            ->setValue(ConfigurableProduct::TYPE_CODE)
            ->setConditionType('eq')
            ->create();
        $this->searchCriteriaBuilder->addFilters([$configProductFilter]);
    }

    //set product name filter
    private function setProductNameFilter(){
        $nameFilter[] = $this->filterBuilder
            ->setField('name')
            ->setValue('M%')
            ->setConditionType('like')
            ->create();
        $this->searchCriteriaBuilder->addFilters($nameFilter);
    }

    //set product order
    private function setProductOrder()
    {
        $sortOrder = $this->sortOrderBuilder
            ->setField('entity_id')
            ->setDirection(SortOrder::SORT_ASC)
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
    }

    //set product paging
    private function setProductPaging()
    {
        $sortOrder = $this->sortOrderBuilder
            ->setField('entity_id')
            ->setDirection(SortOrder::SORT_ASC)
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
        $this->searchCriteriaBuilder->setPageSize(6);
        $this->searchCriteriaBuilder->setCurrentPage(1);
    }

    // Product Interface $product is the product object
    // this function is used to output the product
    private function outputProduct(ProductInterface $product)
    {
        $this->getResponse()->appendBody(sprintf(
                "%s - %s (%d)\n",
                $product->getName(),
                $product->getSku(),
                $product->getId())
        );
    }
}