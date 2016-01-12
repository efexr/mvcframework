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
          $ns = $this->app['namespaces'];
          if(is_array($ns)){
              \GF\Loader::registerNamespace($ns);
          }
        }
        else{
            throw  new \Exception('Config directory read error: '.$configFolder);
        }
    }
    
    public function getConfigFolder(){
        return $this->_configFolder;
    }
    
    public function includeConfigFile($path){
        if(!$path){
            throw new Exception();
        }
        $_file = realpath($path);
        if(($_file != FALSE) && is_file($_file) && is_readable($_file)){            
            $_basename = explode('.php',  basename($_file))[0];
            $this->_configArray[$_basename] = include $_file;
        }
        else{
           throw new Exception('Config file read error: '.$path); 
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
