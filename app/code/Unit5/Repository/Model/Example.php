<?php

namespace Unit5\Repository\Model;

use Magento\Framework\Model\AbstractModel;
use Unit5\Repository\Api\Data\ExampleInterface;

// this is the class that will be used to interact with the database
// it will be used to create, update, and delete.
class Example extends AbstractModel implements ExampleInterface{

    // this is the constructor
    protected function _construct()
    {
        $this->_init(Resource\Example::class);
    }

    // this is the method that will be used to set the data
    // public function setData($key, $value = null)
    public function setName($name){
        $this->setData('name', $name);
    }

    // this is the method that will be used to get the data
    // public function getData($key = null)
    public function getName(){
        return $this->_getData('name');
    }

    // this is the method that will be used to get the data
    // public function getData($key, $value = null)
    // created_at and updated_at are automatically created by the system
    // created_at is the date the record was created
    public function getCreatedAt()
    {
        return $this->_getData('created_at');
    }
    
    // this is the method that will be used to set the data
    // public function setData($key, $value = null)
    // atribute is the name of the column in the database
    // created_at mains date of creation
    public function setCreatedAt($createdAt)
    {
        $this->setData('modified_at', $createdAt);
    }

    // this is the method that will be used to get the data
    // atribute is the name of the column in the database
    // modified_at mains date of the modification
    public function getModifiedAt()
    {
        return $this->_getData('modified_at');
    }

    // this is the method that will be used to set the data
    public function setModifiedAt($modifiedAt)
    {
        $this->setData('modified_at', $modifiedAt);
    }
        

}