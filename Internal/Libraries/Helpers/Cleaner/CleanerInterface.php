<?php namespace ZN\Helpers;

interface CleanerInterface
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
    // Data
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $searchData
    // @param mixed $cleanWord
    //
    //--------------------------------------------------------------------------------------------------------
    public function data($searchData, $cleanWord);
}