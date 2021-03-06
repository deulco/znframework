<?php namespace ZN\IndividualStructures;

use Requirements;

class InternalPermission extends Requirements implements PermissionInterface
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
    // Permission
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $permission = [];
    
    //--------------------------------------------------------------------------------------------------------
    // Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $result;
    
    //--------------------------------------------------------------------------------------------------------
    // Content
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $content;

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  void
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        $this->config = (array) config('IndividualStructures', 'permission');
    }
    
    //--------------------------------------------------------------------------------------------------------
    // start()
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $roleId : 0
    // @param string  $process: empty 
    //
    //--------------------------------------------------------------------------------------------------------
    public function start(Int $roleId = 0, String $process = NULL)
    {
        $this->content = $this->process($roleId, $process, 'object');
    
        ob_start();
    }
    
    //--------------------------------------------------------------------------------------------------------
    // end()
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function end()
    {
        if( ! empty($this->content) )
        {
            $content = ob_get_contents();
        }
        else
        {
            $content = '';  
        }
        
        ob_end_clean();
        
        $this->content = NULL;
        
        echo $content;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // process()
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $roleId : 0
    // @param string  $process: empty 
    // @param string  $object : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function process(Int $roleId = 0, String $process = NULL, String $object = NULL) : String
    {   
        $this->permission = $this->config['process'];
        
        if( isset($this->permission[$roleId]) ) 
        {
            $rules = $this->permission[$roleId]; 
        }
        else
        {
            return false;
        }
        
        $currentUrl = $process;
        
        switch( $rules )
        {
            case 'all' : 
                return $object;  
            break;
            
            case 'any' : 
                return false; 
            break;  
        }
        
        if( is_array($rules) ) // Birden fazla yetki var ise..........
        {       
            $pages = current($rules);
            $type  = key($rules);
        
            foreach( $pages as $page )
            {
                $page = trim($page);
                
                if( stripos($page[0], '!') === 0 ) 
                {
                    $rule = substr(trim($page), 1); 
                }
                else 
                {
                    $rule = trim($page);
                }
                
                if( $type === "perm" )
                {
                    if( strpos($currentUrl, $rule) > -1 )
                    {
                         return $object;
                    }
                    else
                    {
                         $this->result = false;
                    }
                }
                else
                {
                    
                    if( strpos($currentUrl, $rule) > -1 )
                    {                   
                         return false;
                    }
                    else
                    {
                         $this->result = $object;
                    }
                }
            }
            
            return $this->result;
        }
        else
        {   
            // tek bir yetki varsa
                
            if( $rules[0] === "!" ) 
            {
                $page = substr(trim($rules), 1); 
            }
            else 
            {
                $page = trim($rules);
            }
            
            if( strpos($currentUrl, $page) > -1 )
            {
                if( $rules[0] !== "!" ) 
                {
                    return $object; 
                }
                else 
                {
                    return false;           
                }
            }
            else
            {
                return $object; 
            }
        }

    }
    
    //--------------------------------------------------------------------------------------------------------
    // page()
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $roleId : 0
    //
    //--------------------------------------------------------------------------------------------------------
    public function page(Int $roleId = 6) : Bool
    {
        $this->permission = $this->config['page'];
        
        if( isset($this->permission[$roleId]) )
        { 
            $rules = $this->permission[$roleId]; 
        }
        else
        {
            return false;
        }
        
        $currentUrl = server('currentPath');
        
        switch( $rules )
        {
            case 'all' : 
                return true;  
            break;
            
            case 'any' : 
                return false; 
            break;  
        }
        
        if( is_array($rules) ) // Birden fazla sayfa var ise..........
        {
            $pages = current($rules);
            $type  = key($rules);
        
            foreach($pages as $page)
            {
                $page = trim($page);
            
                if( stripos($page[0], '!') === 0 ) 
                {
                    $rule = substr(trim($page), 1); 
                }
                else 
                {
                    $rule = trim($page);
                }
                
                if( $type === "perm" )
                {
                    if( strpos($currentUrl, $rule) > -1 )
                    {
                         return true;
                    }
                    else
                    {
                         $this->result = false;
                    }
                }
                else
                {
                    
                    if( strpos($currentUrl, $rule) > -1 )
                    {                   
                         return false;
                    }
                    else
                    {
                         $this->result = true;
                    }
                }
            }
            
            return $this->result;
        }
        else
        {       
            if( $rules[0] === "!" ) 
            {
                $page = substr(trim($rules),1); 
            }
            else 
            {
                $page = trim($rules);
            }
            
            if( strpos($currentUrl, $page) > -1 )
            {
                if( $rules[0] !== "!" ) 
                {
                    return true; 
                }
                else 
                {
                    return false;           
                }
            }
            else
            {
                return true;    
            }
        }
    }   
}