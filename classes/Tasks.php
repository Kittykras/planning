<?php

class Tasks{
    
    protected $id = null;
    protected $customer = null;
    protected $title = null;
    protected $description = null;
    protected $state = null;
    protected $assigned = null;
    protected $timespent = null;
    protected $fromweek = null;
    protected $toweek = null;
    
    function getId() {
        return $this->id;
    }

    function getCustomer() {
        return $this->customer;
    }

    function getTitle() {
        return $this->title;
    }

    function getDescription() {
        return $this->description;
    }

    function getState() {
        return $this->state;
    }

    function getAssigned() {
        return $this->assigned;
    }

    function getTimespent() {
        return $this->timespent;
    }

    function getFromweek() {
        return $this->fromweek;
    }

    function getToweek() {
        return $this->toweek;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCustomer($customer) {
        $this->customer = $customer;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setState($state) {
        $this->state = $state;
    }

    function setAssigned($assigned) {
        $this->assigned = $assigned;
    }

    function setTimespent($timespent) {
        $this->timespent = $timespent;
    }

    function setFromweek($fromweek) {
        $this->fromweek = $fromweek;
    }

    function setToweek($toweek) {
        $this->toweek = $toweek;
    }


    
}

