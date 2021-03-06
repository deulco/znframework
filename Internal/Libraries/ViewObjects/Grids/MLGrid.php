<?php namespace ZN\ViewObjects\Grids;

use ML;

class InternalMLGrid extends Abstracts\GridAbstract
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
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $app
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function create($app = NULL) : String
    {   
        return ML::table($app);
    }
}