<?php namespace ZN\Requirements\Models;

interface GrandModelInterface
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
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function insert(Array $data) : Bool;
    //--------------------------------------------------------------------------------------------------------
    // Insert ID
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function insertID() : Int;
    
    //--------------------------------------------------------------------------------------------------------
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $select: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function select(...$select) : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Update
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function update(Array $data, String $column, String $value) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column: empty
    // @param string $value : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $column, String $value) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function columns() : Array;
    
    //--------------------------------------------------------------------------------------------------------
    // Total Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalColumns() : Int;
    
    //--------------------------------------------------------------------------------------------------------
    // Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $printable: false
    //
    //--------------------------------------------------------------------------------------------------------
    public function row($printable);
    
    //--------------------------------------------------------------------------------------------------------
    // Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: object
    //
    //--------------------------------------------------------------------------------------------------------
    public function result(String $type = 'object');
    
    //--------------------------------------------------------------------------------------------------------
    // Increment
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $columns  : empty
    // @param int   $increment: 1
    //
    //--------------------------------------------------------------------------------------------------------
    public function increment($columns, Int $increment = 1) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Decrement
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $columns  : empty
    // @param int   $decrement: 1
    //
    //--------------------------------------------------------------------------------------------------------
    public function decrement($columns, Int $decrement = 1) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Status
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: row
    //
    //--------------------------------------------------------------------------------------------------------
    public function status(String $type = 'row');
    
    //--------------------------------------------------------------------------------------------------------
    // Total Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $status: false
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalRows(Bool $status = false) : Int;
    
    //--------------------------------------------------------------------------------------------------------
    // Where
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column : empty
    // @param string $value  : empty
    // @param string $logical: empty 
    //
    //--------------------------------------------------------------------------------------------------------
    public function where($column, String $value = NULL, String $logical = NULL) : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Having
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column : empty
    // @param string $value  : empty
    // @param string $logical: empty 
    //
    //--------------------------------------------------------------------------------------------------------
    public function having($column, String $value = NULL, String $logical = NULL) : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Where Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function whereGroup(...$args) : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Having Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function havingGroup(...$args) : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Inner Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table      : empty
    // @param string $otherColumn: empty
    // @param string $operator   : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function innerJoin(String $table, String $otherColumn, String $operator = '=') : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Outer Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table      : empty
    // @param string $otherColumn: empty
    // @param string $operator   : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function outerJoin(String $table, String $otherColumn, String $operator = '=') : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Left Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table      : empty
    // @param string $otherColumn: empty
    // @param string $operator   : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function leftJoin(String $table, String $otherColumn, String $operator = '=') : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Right Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table      : empty
    // @param string $otherColumn: empty
    // @param string $operator   : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function rightJoin(String $table, String $otherColumn, String $operator = '=') : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table    : empty
    // @param string $condition: empty
    // @param string $type     : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function join(String $table, String $condition, String $type = NULL) : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Duplicate Check
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function duplicateCheck(...$args) : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Order By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $condition: empty
    // @param string $type     : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function orderBy($condition, String $type = NULL) : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Group By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function groupBy() : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Limit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $start: 0
    // @param int   $limit: 0
    //
    //--------------------------------------------------------------------------------------------------------
    public function limit($start = 0, Int $limit = 0) : Grand;
    
    //--------------------------------------------------------------------------------------------------------
    // Pagination
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url     : empty
    // @param array  $settings: empty
    // @param bool   $output  : true
    //
    //--------------------------------------------------------------------------------------------------------
    public function pagination(String $url = NULL, Array $settings = [], Bool $output = true);
    
    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $data : empty
    // @param string $extra: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(Array $data, $extra = NULL) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Drop
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function drop() : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Truncate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function truncate() : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Rename
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $newName: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function rename(String $newName) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Add Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $column: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function addColumn(Array $column) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Drop Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $column: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function dropColumn($column) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Modify Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $column: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function modifyColumn(Array $column) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Rename Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $column: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function renameColumn(Array $column) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Optimize
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function optimize() : String;
    
    //--------------------------------------------------------------------------------------------------------
    // Repair
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function repair() : String;
    
    //--------------------------------------------------------------------------------------------------------
    // Backup
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $fileName: empty
    // @param string $path    : const STORAGE_DIR
    //
    //--------------------------------------------------------------------------------------------------------
    public function backup(String $fileName = NULL, String $path = STORAGE_DIR) : String;
    
    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function error();
}