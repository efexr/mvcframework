<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of App
 *
 * @author VK
 */
namespace GF;
include_once 'Loader.php';
class App {
    private static $_instance=null;
    private $_config=null;
    
    /**
     *
     * @var \GF\FrontController
     */
    private $_frontController=null;
    
   
    private function __construct() {
        \GF\Loader::registerNamespace('GF', dirname(__FILE__.DIRECTORY_SEPARATOR));
        \GF\Loader::registerAutoLoad();
        $this->_config = \GF\Config::getInstance();
        //if($this->_config->getConfigFolder() == null){
           // $this->_config->setConfigFolder('../config');
        //}
    }
    
    /**
     * 
     * @return \GF\Config
     */    
    public function getConfig(){
        return $this->_config;
    }
    
    public function run() {
        if($this->_config->getConfigFolder() == null){
            $this->_config->setConfigFolder('../config');
        }
        $this->_frontController = \GF\FrontController::GetInstance();
        $this->_frontController->dispatch();
        echo 'kkk';
    }
    
    /**
     * 
     * @return type \GF\App
     */   
    public static function GetInstance(){
        if(self::$_instance==null){
            self::$_instance = new \GF\App();
        }
        
        return self::$_instance;
    }
}
