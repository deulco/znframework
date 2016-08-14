<?php namespace ZN\DataTypes;

class InternalStack implements StackInterface
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
    // Protected Data
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $data = NULL;

    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        $this->data = \Strings::$method($this->data, ...$parameters);

        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Data
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function data(String $data) : InternalStack
    {
        $this->data = $data;
        
        return $this;
    }   

    //--------------------------------------------------------------------------------------------------------
    // Get
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  void
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function get()
    {
        $data = $this->data;
        
        $this->data = NULL;
        
        return $data;
    }
}