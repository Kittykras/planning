<?php

class User {
    
    protected $username = null;
    protected $name = null;
    protected $privileges = null;
    
    
    function getUsername() {
        return $this->username;
    }
    
    function getName() {
        return $this->name;
    }
    
    function getPrivileges() {
        return $this->privileges;
    }
    
    
    
    
    
}