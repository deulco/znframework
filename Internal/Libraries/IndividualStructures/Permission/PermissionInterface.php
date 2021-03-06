<?php namespace ZN\IndividualStructures;

interface PermissionInterface
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
    // start()
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $roleId : 0
    // @param string  $process: empty 
    //
    //--------------------------------------------------------------------------------------------------------
    public function start(Int $roleId = 0, String $process);
    
    //--------------------------------------------------------------------------------------------------------
    // end()
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function end();
    
    //--------------------------------------------------------------------------------------------------------
    // process()
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $roleId : 0
    // @param string  $process: empty 
    // @param string  $object : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function process(Int $roleId = 0, String $process = NULL, String $object = NULL) : String;
    
    //--------------------------------------------------------------------------------------------------------
    // page()
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $roleId : 0
    //
    //--------------------------------------------------------------------------------------------------------
    public function page(Int $roleId = 6) : Bool;   
}