<?php namespace ZN\Database\Drivers;

use ZN\Database\DriverForge;

class ODBCForge extends DriverForge
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
    // Truncate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function truncate($table)
    { 
        return 'DELETE FROM '.$table; 
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Rename Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param mixed  $column
    //
    //--------------------------------------------------------------------------------------------------------
    public function renameColumn($table, $column)
    { 
        return 'ALTER TABLE '.$table.' RENAME COLUMN  '.rtrim($column, ',').';';
    }
}