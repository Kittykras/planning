<?php

class Customer{
    
    protected $acronym = null;
    protected $name = null;
    protected $branch = null;
    protected $conperson = null;
    protected $connumber = null;
    protected $assigned = null;

    
    function getAcronym() {
        return $this->acronym;
    }

    function getName() {
        return $this->name;
    }

    function getBranch() {
        return $this->branch;
    }

    function getConperson() {
        return $this->conperson;
    }

    function getConnumber() {
        return $this->connumber;
    }

    function getAssigned() {
        return $this->assigned;
    }

    function setAcronym($acronym) {
        $this->acronym = $acronym;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setBranch($branch) {
        $this->branch = $branch;
    }

    function setConperson($conperson) {
        $this->conperson = $conperson;
    }

    function setConnumber($connumber) {
        $this->connumber = $connumber;
    }

    function setAssigned($assigned) {
        $this->assigned = $assigned;
    }


    
}

