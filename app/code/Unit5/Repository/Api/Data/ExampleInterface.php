<?php

namespace Unit5\Repository\Api\Data;

// this is the getter and setter for the property
// the getter is called when the property is accessed
// the setter is called when the property is assigned
interface ExampleInterface{
    public function setId($id);
    public function getId();
    public function getName();
    public function setName($name);
    public function getCreatedAt();
    public function setCreatedAt($createdAt);
    public function getModifiedAt();
    public function setModifiedAt($modifiedAt);
}