<?php namespace ZN\DataTypes;

use Exceptions, CallController;

class InternalFunctions extends CallController implements FunctionsInterface
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
    // Call Array                                                                   
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $callback
    // @param array    $params
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function callArray($callback, Array $params = [])
    {
        if( ! is_callable($callback) )
        {
            return Exceptions::throws('Error', 'callableParameter', '1.(callback)');   
        }
        
        return call_user_func_array($callback, $params);        
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Call                                                                 
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $args
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function call(...$args)
    {
        return call_user_func(...$args);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Static Call Array                                                                   
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $callback
    // @param array    $params
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function staticCallArray($callback, Array $params = [])
    {
        if( ! is_callable($callback) )
        {
            return Exceptions::throws('Error', 'callableParameter', '1.(callback)');   
        }
        
        return forward_static_call_array($callback, $params);       
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Static Call                                                                 
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $args
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function staticCall(...$args)
    {
        return forward_static_call(...$args);   
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Shutdown                                                                 
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $args
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function shutdown(...$args)
    {
        return register_shutdown_function(...$args);    
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Tick                                                                 
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $args
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function tick(...$args)
    {
        return register_tick_function(...$args);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Untick                                                                 
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $args
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function untick(...$args)
    {
        return unregister_tick_function(...$args);
    }

    //--------------------------------------------------------------------------------------------------------
    // Defined                                                                 
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //                                                                                        
    //--------------------------------------------------------------------------------------------------------
    public function defined() : Array
    {
        return get_defined_functions();
    }   
}