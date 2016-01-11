<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GF;

/**
 * Description of Config
 *
 * @author NKE1
 */
class Config {
    private static $_instance = null;
    private $_configArray = array();
    private $_configFolder = null;
    
    private function __construct() {
        
    }
    
    
    
    public function setConfigFolder($configFolder){
        if(!$configFolder){
          throw new \Exception('Empty config folder path!');
        }
        
        $_configFolder = realpath($configFolder);
        if(($_configFolder != FALSE) && is_dir($_configFolder) && is_readable($_configFolder)){
          //clear old config data
          $this->_configArray = array();
          $this->_configFolder = $_configFolder . DIRECTORY_SEPARATOR;
          
        }
        else{
            throw  new \Exception('Config directory read error: '.$configFolder);
        }
    }
    
    public function __get ($name){
        if(!$this->_configArray[$name]){
            $this->includeConfigFile($this->_configFolder.$name.'.php');
        }
        if(array_key_exists($name,$this->_configArray)){
            return $this->_configArray[$name];
        }
        return null;
    }
    
    /**
     * 
     * @return \GF\Config
     */
    public static function getInstance(){
       if(self::$_instance == NULL){
           self::$_instance = new \GF\Config();
       }
       
       return self::$_instance;
    }
    
}
