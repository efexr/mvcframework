<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GF;

/**
 * Description of Loader
 *
 * @author VK
 */
class Loader {
    private static $namespaces= array();
    
    private function __construct() {
        
    }
    
    public static function registerAutoLoad() {
        spl_autoload_register(array("\GF\Loader",'autoload'));
    }
    
    public static function autoload($class) {
        //echo $class;
        self::loadClass($class);
    }
    
    public static function loadClass($class){
        foreach(self::$namespaces as $k => $v){
            if(strpos($class,$k) === 0){
                //$file = realpath(substr_replace(str_replace('\\', DIRECTORY_SEPARATOR,$class)
                        //, $v, 0, strlen($k)).'.php');
                $filename = substr_replace(str_replace('\\', DIRECTORY_SEPARATOR,$class)
                        , $v, 0, strlen($k)).'.php';
                $file = realpath($filename);                                
                if($file && is_readable($file)){
                    include $file;
                }
                else{                    
                    throw new \Exception('File cannot be included: '.$filename);
                }
                break;
            }
        }
    }
    
    public static function registerNamespace($namespace,$path){
        $namespace = trim($namespace);
        if(strlen($namespace) > 0){
            if(!$path){
                throw new \Exception('Invalid path: '.$path);
            }
            $_path = realpath($path);
            if($_path && is_dir($_path) && is_readable($_path)){
                self::$namespaces[$namespace.'\\'] = $_path . DIRECTORY_SEPARATOR;
            }
            else{
                throw new \Exception('Namespace directory read error: '.$path);
            }
        }
        else {
            throw new \Exception('Invalid namespace: '.$namespace);
        }
    }
    
    public static function getNamespace(){        
        return self::$namespaces;        
    }
    
    public static function removeNamespace($namespace){
        unset(self::$namespaces[$namespace]);
    }
    
   public static function clearNamespace($namespace){
        self::$namespaces = array();
    }
}
