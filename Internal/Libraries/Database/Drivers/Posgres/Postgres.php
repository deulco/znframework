<?php namespace ZN\Database\Drivers;

use ZN\Database\Abstracts\DriverConnectionMappingAbstract;

class PostgresDriver extends DriverConnectionMappingAbstract
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
    // Operators
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $operators =
    [
        'like' => '%'
    ];
    
    //--------------------------------------------------------------------------------------------------------
    // Statements
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $statements =
    [
        'autoIncrement' => 'BIGSERIAL',
        'primaryKey'    => 'PRIMARY KEY',
        'foreignKey'    => 'FOREIGN KEY',
        'unique'        => 'UNIQUE',
        'null'          => 'NULL',
        'notNull'       => 'NOT NULL',
        'exists'        => 'EXISTS',
        'notExists'     => 'NOT EXISTS',
        'constraint'    => 'CONSTRAINT',
        'default'       => 'DEFAULT'
    ];
    
    //--------------------------------------------------------------------------------------------------------
    // Variable Types
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $variableTypes =
    [
        'int'           => 'INTEGER',
        'smallInt'      => 'SMALLINT',
        'tinyInt'       => 'SMALLINT',
        'mediumInt'     => 'INTEGER',
        'bigInt'        => 'BIGINT',
        'decimal'       => 'DECIMAL',
        'double'        => 'DOUBLE PRECISION',
        'float'         => 'NUMERIC',
        'char'          => 'CHARACTER',
        'varChar'       => 'CHARACTER VARYING',
        'tinyText'      => 'CHARACTER VARYING(255)',
        'text'          => 'TEXT',
        'mediumText'    => 'TEXT',
        'longText'      => 'TEXT',
        'date'          => 'DATE',
        'dateTime'      => 'TIMESTAMP',
        'time'          => 'TIME',
        'timeStamp'     => 'TIMESTAMP'
    ];
    
    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        \Support::func('pg_connect', 'Postgres');
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Connect
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $config
    //
    //--------------------------------------------------------------------------------------------------------
    public function connect($config = [])
    {
        $this->config = $config;
        
        $dsn = 'host='.$this->config['host'].' ';
        
        if( ! empty($this->config['port']) )        $dsn .= 'port='.$this->config['port'].' ';
        if( ! empty($this->config['database']) )    $dsn .= 'dbname='.$this->config['database'].' ';
        if( ! empty($this->config['user']) )        $dsn .= 'user='.$this->config['user'].' ';
        if( ! empty($this->config['password']) )    $dsn .= 'password='.$this->config['password'].' ';
        
        if( ! empty($this->config['dsn']) )
        {
            $dsn = $this->config['dsn'];    
        }
        
        $dsn = rtrim($dsn);
        
        $this->connect = ( $this->config['pconnect'] === true )
                         ? @pg_pconnect($dsn)
                         : @pg_connect($dsn);
        
        if( empty($this->connect) ) 
        {
            die(getErrorMessage('Database', 'mysqlConnectError'));
        }
        
        if( ! empty($this->config['charset']) ) 
        {
            pg_set_client_encoding($this->connect, $this->config['charset']);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Exec
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $security
    //
    //--------------------------------------------------------------------------------------------------------
    public function exec($query, $security = NULL)
    {
        if( empty($query) )
        {
            return false;
        }
        
        return pg_query($this->connect, $query);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Multi Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $security
    //
    //--------------------------------------------------------------------------------------------------------
    public function multiQuery($query, $security = NULL)
    {
        return $this->query($query, $security);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $security
    //
    //--------------------------------------------------------------------------------------------------------
    public function query($query, $security = [])
    {
        return $this->query = $this->exec($query);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Trans Start
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function transStart()
    {
        return (bool) pg_query($this->connect, 'BEGIN');
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Trans Roll Back
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function transRollback()
    {
        return (bool) pg_query($this->connect, 'ROLLBACK');  
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Trans Commit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function transCommit()
    {
        return (bool) pg_query($this->connect, 'COMMIT');
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Insert ID
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function insertID()
    {
        if( empty($this->query) ) 
        {
            return false;
        }
        
        return pg_last_oid($this->query);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Column Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column
    //
    //--------------------------------------------------------------------------------------------------------
    public function columnData($col = '')
    {
        if( empty($this->query) ) 
        {
            return false;
        }
        
        $columns = [];
        $count   = $this->numFields();

        for( $i = 0; $i < $count; $i++ )
        {
            $fieldName = pg_field_name($this->query, $i);
            
            $columns[$fieldName]                = new \stdClass();
            $columns[$fieldName]->name          = $fieldName;
            $columns[$fieldName]->type          = pg_field_type($this->query, $i);
            $columns[$fieldName]->maxLength     = pg_field_size($this->query, $i);
            $columns[$fieldName]->primaryKey    = NULL;
            $columns[$fieldName]->default       = NULL;
        }
        
        if( isset($columns[$col]) )
        {
            return $columns[$col];
        }
        
        return $columns;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Num Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function numRows()
    {
        if( ! empty($this->query) )
        {
            return pg_num_rows($this->query);
        }
        else
        {
            return 0;   
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function columns()
    {
        if( empty($this->query) ) 
        {
            return false;
        }
        
        $columns = [];
        $num_fields = $this->numFields();
        
        for($i=0; $i < $num_fields; $i++)
        {       
            $columns[] = pg_field_name($this->query, $i);
        }
        
        return $columns;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Num Fields
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function numFields()
    {
        if( ! empty($this->query) )
        {
            return pg_num_fields($this->query);
        }
        else
        {
            return 0;   
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Real Escape String
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function realEscapeString($data = '')
    {
        return pg_escape_string($this->connect, $data);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function error()
    {
        if( ! empty($this->connect) )
        {
            return pg_last_error($this->connect);
        }
        else
        {
            return false;
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Fetch Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchArray()
    {
        if( ! empty($this->query) )
        {
            return pg_fetch_array($this->query);
        }
        else
        {
            return false;   
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Fetch Assoc
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchAssoc()
    {
        if( ! empty($this->query) )
        {
            return pg_fetch_assoc($this->query);
        }
        else
        {
            return false;   
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Fetch Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchRow()
    {
        if( ! empty($this->query) )
        {
            return pg_affected_rows($this->query);
        }
        else
        {
            return 0;   
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Affected Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function affectedRows()
    {
        if( ! empty($this->connect) )
        {
            return pg_affected_rows($this->connect);
        }
        else
        {
            return false;   
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Close
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function close()
    {
        if( ! empty($this->connect) ) 
        {
            @pg_close($this->connect);
        }
        else 
        {
            return false;
        }
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Version
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function version()
    {
        // Ön tanımlı sorgu kullanıyor.
        if( ! empty($this->connect) ) 
        {
            return pg_version($this->connect);
        }
    }
}