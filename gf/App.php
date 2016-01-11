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
   
    private function __construct() {
        \GF\Loader::registerNamespace('GF', dirname(__FILE__.DIRECTORY_SEPARATOR));
        \GF\Loader::registerAutoLoad();
    }

    public function run() {
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
