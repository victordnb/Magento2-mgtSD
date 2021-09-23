<?php

namespace Unit5\Reposotory\Model\Resource;

// this class is used to connect to the database and perform CRUD operations
class Example extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    //contructor
    protected function _construct()
    {   
        // table name and primary key of the table
        $this->_init('training_reposotory_example', 'example_id');
    }
    
}