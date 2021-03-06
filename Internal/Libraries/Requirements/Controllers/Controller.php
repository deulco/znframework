<?php namespace ZN\Requirements\Controllers;

class Controller
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        \ZN::$use =& $this;
    }
        
    //--------------------------------------------------------------------------------------------------------
    // Get 
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $class
    //
    //--------------------------------------------------------------------------------------------------------  
    public function __get($class)
    {
        if( ! isset($this->$class) )
        {
            return $this->$class = uselib($class);  
        }
    }
}

class_alias('ZN\Requirements\Controllers\Controller', 'Controller');