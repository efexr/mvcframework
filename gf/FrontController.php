<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GF;

/**
 * Description of FrontController
 *
 * @author NKE1
 */
class FrontController {
    
    private static $_instance=null;
    
   
    private function __construct() {
        
    }
    
    public function dispatch() {
        
    }
    
    
    /**
     * 
     * @return type \GF\App
     */   
    public static function GetInstance(){
        if(self::$_instance==null){
            self::$_instance = new \GF\FrontController();
        }
        
        return self::$_instance;
    }
}
