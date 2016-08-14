<?php namespace ZN\DataTypes;

class InternalSerial extends \CallController implements SerialInterface
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
    // Encode                                                                
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $data
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function encode($data) : String
    {
        return serialize($data);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Decode                                                                
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param bool   $array
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function decode(String $data, Bool $array = false)
    {
        if( $array === false )
        {
            return (object) unserialize($data);
        }
        else
        {
            return (array) unserialize($data);
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Decode Object                                                                
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function decodeObject(String $data) : \stdClass
    {
        return (object) unserialize($data);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Decode Array                                                                
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function decodeArray(String $data) : Array
    {
        return (array) unserialize($data);
    }
}