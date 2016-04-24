<?php

class Tasks{
    
    protected $id = null;
    protected $customer = null;
    protected $title = null;
    protected $description = null;
    protected $state = null;
    protected $assigned = null;
    protected $hour = null;
    protected $min = null;
    protected $commentTime = null;
    
    function getHour() {
        return $this->hour;
    }

    function getMin() {
        return $this->min;
    }

    function getCommentTime() {
        return $this->commentTime;
    }

    function setHour($hour) {
        $this->hour = $hour;
    }

    function setMin($min) {
        $this->min = $min;
    }

    function setCommentTime($commentTime) {
        $this->commentTime = $commentTime;
    }

    
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
}

