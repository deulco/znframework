<?php namespace ZN\Database;

interface DBInterface
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
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$condition
    //
    //--------------------------------------------------------------------------------------------------------
    public function select(...$condition) : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Where
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $column
    // @param scalar $value
    // @param string $logical
    //
    //--------------------------------------------------------------------------------------------------------
    public function where($column, String $value = NULL, String $logical = NULL) : InternalDB;
    
    
    //--------------------------------------------------------------------------------------------------------
    // Having
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $column
    // @param scalar $value
    // @param string $logical
    //
    //--------------------------------------------------------------------------------------------------------
    public function having($column, String $value = NULL, String $logical = NULL) : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Where Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function whereGroup(...$args) : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Having Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function havingGroup(...$args) : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $condition
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function join(String $table, String $condition, String $type = NULL) : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Inner Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $otherColumn
    //
    //--------------------------------------------------------------------------------------------------------
    public function innerJoin(String $table, String $otherColumn, String $operator = '=') : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Outer Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $otherColumn
    //
    //--------------------------------------------------------------------------------------------------------
    public function outerJoin(String $table, String $otherColumn, String $operator = '=') : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Left Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $otherColumn
    //
    //--------------------------------------------------------------------------------------------------------
    public function leftJoin(String $table, String $otherColumn, String $operator = '=') : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Right Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $otherColumn
    //
    //--------------------------------------------------------------------------------------------------------
    public function rightJoin(String $table, String $otherColumn, String $operator = '=') : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Get
    //--------------------------------------------------------------------------------------------------------
    //
    // Sorguyu tamamlamak için kullanılır.
    //
    // @param  string $table  -> Tablo adı.
    // @return string $return -> Sorgunun dönüş türü. object, string
    //
    //--------------------------------------------------------------------------------------------------------
    public function get(String $table, String $return = 'object');

    //--------------------------------------------------------------------------------------------------------
    // Get String
    //--------------------------------------------------------------------------------------------------------
    //
    // Sorguyunun çalıştırılmadan metinsel çıktısını almak için kullanılır.
    //
    // @param  string $table -> Tablo adı.
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function getString(String $table) : String;
    
    //--------------------------------------------------------------------------------------------------------
    // Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $secure
    //
    //--------------------------------------------------------------------------------------------------------
    public function query(String $query, Array $secure = []) : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Exec Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $secure
    //
    //--------------------------------------------------------------------------------------------------------
    public function execQuery(String $query, Array $secure = []) : Bool;

    //--------------------------------------------------------------------------------------------------------
    // Multi Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $secure
    //
    //--------------------------------------------------------------------------------------------------------
    public function multiQuery(String $query, Array $secure = []) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Trans Start
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function transStart();
    
    //--------------------------------------------------------------------------------------------------------
    // Trans End
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function transEnd();
    
    //--------------------------------------------------------------------------------------------------------
    // Total Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $total
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalRows(Bool $total = false) : Int;
    
    //--------------------------------------------------------------------------------------------------------
    // Total Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalColumns() : Int;
    
    //--------------------------------------------------------------------------------------------------------
    // Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function columns() : Array;
    
    //--------------------------------------------------------------------------------------------------------
    // Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: object, 'json', 'array'
    //
    //--------------------------------------------------------------------------------------------------------
    public function result(String $type = 'object');
    
    //--------------------------------------------------------------------------------------------------------
    // Result Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function resultArray() : Array;
    
    //--------------------------------------------------------------------------------------------------------
    // Result Json
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function resultJson() : String;
    
    //--------------------------------------------------------------------------------------------------------
    // Fetch Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchArray() : Array;
    
    //--------------------------------------------------------------------------------------------------------
    // Fetch Assoc
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchAssoc();
    
    //--------------------------------------------------------------------------------------------------------
    // Fetch
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: assoc, array, row
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetch(String $type = 'assoc');
    
    //--------------------------------------------------------------------------------------------------------
    // Fetch Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param boolean $printable
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchRow(Bool $printable = false);
    
    //--------------------------------------------------------------------------------------------------------
    // Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $printable
    //
    //--------------------------------------------------------------------------------------------------------
    public function row($printable);
    
    //--------------------------------------------------------------------------------------------------------
    // Value
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function value() : String;
    
    //--------------------------------------------------------------------------------------------------------
    // Affected Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function affectedRows() : Int;
    
    //--------------------------------------------------------------------------------------------------------
    // Insert ID
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function insertID() : Int;
    
    //--------------------------------------------------------------------------------------------------------
    // Column Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function columnData(String $column);
    
    //--------------------------------------------------------------------------------------------------------
    // Table Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function tableName() : String;
    
    //--------------------------------------------------------------------------------------------------------
    // Pagination
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    // @param array  $settigs
    // @param bool   $output
    //
    //--------------------------------------------------------------------------------------------------------
    public function pagination(String $url = NULL, Array $settings = [], Bool $output = true);
    
    //--------------------------------------------------------------------------------------------------------
    // Group By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function groupBy(...$condition) : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Order By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $condition
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function orderBy($condition, String $type = NULL) : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Limit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $start
    // @param int $limit
    //
    //--------------------------------------------------------------------------------------------------------
    public function limit($start = NULL, Int $limit = 0) : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Status
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function status(String $table) : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Increment
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $table
    // @param mixed   $columns
    // @param numeric $increment
    //
    //--------------------------------------------------------------------------------------------------------
    public function increment(String $table = NULL, $columns = [], Int $increment = 1) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Decrement
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $table
    // @param mixed   $columns
    // @param numeric $decrement
    //
    //--------------------------------------------------------------------------------------------------------
    public function decrement(String $table = NULL, $columns = [], Int $decrement = 1) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $table
    // @param mixed $datas
    //
    //--------------------------------------------------------------------------------------------------------
    public function insert(String $table = NULL, Array $datas = []) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Updated
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $table
    // @param mixed $set
    //
    //--------------------------------------------------------------------------------------------------------
    public function update(String $table = NULL, Array $set = []) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $table = NULL) : Bool;
    
    //--------------------------------------------------------------------------------------------------------
    // Escape String
    //--------------------------------------------------------------------------------------------------------
    //
    // Tırnak işaretlerinin başına \ işareti ekler.
    //
    // @param  string $data
    // @return string 
    //
    //--------------------------------------------------------------------------------------------------------
    public function escapeString(String $data) : String;
    
    //--------------------------------------------------------------------------------------------------------
    // Real Escape String
    //--------------------------------------------------------------------------------------------------------
    //
    // Tırnak işaretlerinin başına \ işareti ekler.
    //
    // @param  string $data
    // @return string 
    //
    //--------------------------------------------------------------------------------------------------------
    public function realEscapeString(String $data) : String;

    //--------------------------------------------------------------------------------------------------------
    // Alias
    //--------------------------------------------------------------------------------------------------------
    //
    // Veriye takma ad vermek için kullanılır.
    //
    // @param  string $string   -> Metin.
    // @param  string $alias    -> Takma ad.
    // @param  bool   $brackets -> Parantezlerin olup olmayacağı.
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function alias(String $string, String $alias, Bool $brackets = false) : String;

    //--------------------------------------------------------------------------------------------------------
    // Brackets
    //--------------------------------------------------------------------------------------------------------
    //
    // Verinin başına ve sonuna parantez eklemek için kullanılır.
    //
    // @param  string $string   -> Metin.
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function brackets(String $string) : String;

    //--------------------------------------------------------------------------------------------------------
    // All
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function all() : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Distinct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function distinct() : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Max Statement Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function maxStatementTime(String $time) : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Distinct Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function distinctRow() : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Distinct Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function straightJoin() : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // High Priority
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function highPriority() : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Low Priority
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function lowPriority() : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Quick
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function quick() : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Delayed
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function delayed() : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Ignore
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function ignore() : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Partition
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function partition(...$args) : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Procedure
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function procedure(...$args) : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Out File
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function outFile(String $file) : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Dump File
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function dumpFile(String $file) : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Character Set
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function characterSet(String $set, Bool $return = false);

    //--------------------------------------------------------------------------------------------------------
    // Character Set
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $set
    //
    //--------------------------------------------------------------------------------------------------------
    public function cset(String $set) : String;

    //--------------------------------------------------------------------------------------------------------
    // Collate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $set
    //
    //--------------------------------------------------------------------------------------------------------
    public function collate(String $set) : String;

    //--------------------------------------------------------------------------------------------------------
    // Encoding
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $charset
    // @param string $collate
    //
    //--------------------------------------------------------------------------------------------------------
    public function encoding(String $charset = 'utf8', String $collate = 'utf8_general_ci') : String;

    //--------------------------------------------------------------------------------------------------------
    // Into
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $varname1
    // @param string $varname2
    //
    //--------------------------------------------------------------------------------------------------------
    public function into(String $varname1, String $varname2) : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // For Update
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function forUpdate() : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Lock In Share Mode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function lockInShareMode() : InternalDB;

    //--------------------------------------------------------------------------------------------------------
    // Small Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function smallResult() : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Big Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function bigResult() : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Buffer Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function bufferResult() : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Cache
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function cache() : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // No Cache
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function noCache() : InternalDB;
    
    //--------------------------------------------------------------------------------------------------------
    // Calc Found Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function calcFoundRows() : InternalDB;
}