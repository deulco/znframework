<?php namespace ZN\Requirements\Models;

class Model
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

class_alias('ZN\Requirements\Models\Model', 'Model');