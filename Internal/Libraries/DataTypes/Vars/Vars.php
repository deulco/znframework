<?php namespace ZN\DataTypes;

class InternalVars extends \CallController implements VarsInterface
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
    // Bool
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function bool($var) : Bool
    {
        return boolval($var);       
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Boolean
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function boolean($var) : Bool
    {
        return boolval($var);       
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Float
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function float($var) : Float
    {
        return floatval($var);      
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Double
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function double($var) : Float
    {
        return floatval($var);      
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Int
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function int($var) : Int
    {
        return intval($var);        
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Integer
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function integer($var) : Int
    {
        return intval($var);        
    }
    
    //--------------------------------------------------------------------------------------------------------
    // String
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function string($var) : String
    {
        return strval($var);        
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Type
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function type($var) : String
    {
        return gettype($var);       
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Resource Type
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $resource
    //
    //--------------------------------------------------------------------------------------------------------
    public function resourceType($resource) : String
    {
        if( ! is_resource($resource) )
        {
            return \Exceptions::throws('Error', 'resourceParameter', '1.(resource)');   
        }
        
        return get_resource_type($resource);        
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Serial
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //-------------------------------------------------------------------------------------------------------
    public function serial($var) : String
    {
        return serialize($var);     
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Unserial
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //-------------------------------------------------------------------------------------------------------
    public function unserial(String $var)
    {
        return unserialize($var);       
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Remove
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //-------------------------------------------------------------------------------------------------------
    public function remove($var)
    {
        unset($var);        
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //-------------------------------------------------------------------------------------------------------
    public function delete($var)
    {
        unset($var);        
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Type
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $var
    //
    //-------------------------------------------------------------------------------------------------------
    public function toType($var, String $type = 'integer')
    {
        settype($var, $type);
        
        return $var;        
    }
}