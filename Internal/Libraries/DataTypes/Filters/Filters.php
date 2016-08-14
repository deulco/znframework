<?php namespace ZN\DataTypes;

class InternalFilters extends \CallController implements FiltersInterface
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
    // Get Var                                                                   
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $varName
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function getVar(String $varName) : Bool
    {
        return $this->_var($varName, INPUT_GET);
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Post Var                                                                   
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $varName
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function postVar(String $varName) : Bool
    {
        return $this->_var($varName, INPUT_POST);
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Cookie Var                                                                   
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $varName
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function cookieVar(String $varName) : Bool
    {
        return $this->_var($varName, INPUT_COOKIE);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Env Var                                                                   
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $varName
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function envVar(String $varName) : Bool
    {
        return $this->_var($varName, INPUT_ENV);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Server Var                                                                   
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $varName
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function serverVar(String $varName) : Bool
    {
        return $this->_var($varName, INPUT_SERVER);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // ID                                                                  
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $filterName
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function id(String $filterName) : Int
    {
        return filter_id($filterName);  
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Get List                                                                
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function getList() : Array
    {
        return filter_list();   
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Input Array                                                                   
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    // @param mixed  $definition
    // @param bool   $addEmpty
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function inputArray(String $type = 'post', $definition = NULL, Bool $addEmpty = true)
    {       
        return filter_input_array($this->_inputConstant($type), $definition, $addEmpty);    
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Var Array                                                                   
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $data
    // @param mixed  $definition
    // @param bool   $addEmpty
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function varArray(Array $data, $definition = NULL, Bool $addEmpty = true)
    {       
        return filter_var_array($data, $definition, $addEmpty); 
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Input                                                                  
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $var
    // @param string $type
    // @param string $filter
    // @param mixed  $options
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function input(String $var, String $type = 'post', String $filter = 'default' , $options = NULL)
    {
        return filter_input($this->_inputConstant($type), $var, $this->_filterConstant($filter), $options); 
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Vars                                                                  
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $var
    // @param string $filter
    // @param mixed  $options
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function vars($var, String $filter = 'default', $options = NULL)
    {
        return filter_var($var, $this->_filterConstant($filter), $options); 
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Sanitize
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $const;
    //
    //--------------------------------------------------------------------------------------------------------
    public function sanitize(String $const)
    {
        return $this->_validate($const, __FUNCTION__);  
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Validate
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $const;
    //
    //--------------------------------------------------------------------------------------------------------
    public function validate(String $const)
    {
        return $this->_validate($const, __FUNCTION__);      
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Force
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $const;
    //
    //--------------------------------------------------------------------------------------------------------
    public function force(String $const)
    {
        return $this->_validate($const, __FUNCTION__);      
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Flag
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $const;
    //
    //--------------------------------------------------------------------------------------------------------
    public function flag(String $const)
    {
        return $this->_validate($const, __FUNCTION__);      
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Required
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $const;
    //
    //--------------------------------------------------------------------------------------------------------
    public function required(String $const)
    {
        return $this->_validate($const, 'require');         
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Protected Var
    //--------------------------------------------------------------------------------------------------------
    protected function _var($varName = '', $type)
    {
        return filter_has_var($this->_inputConstant($type), $varName);  
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Protected Input Constant
    //--------------------------------------------------------------------------------------------------------
    protected function _inputConstant($const)
    {
        return \Converter::toConstant($const, 'INPUT_');
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Protected Filter Constant
    //--------------------------------------------------------------------------------------------------------
    protected function _filterConstant($const)
    {
        return \Converter::toConstant($const, 'FILTER_');
    }   

    //--------------------------------------------------------------------------------------------------------
    // Protected Validate
    //--------------------------------------------------------------------------------------------------------
    protected function _validate($const, $type)
    {
        return constant('FILTER_'.strtoupper($type).'_'.strtoupper($const));    
    }
}