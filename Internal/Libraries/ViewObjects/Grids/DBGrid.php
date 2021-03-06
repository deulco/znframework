<?php namespace ZN\ViewObjects\Grids;

use DB, URI, Arrays, Exceptions, Exception, Method, Html, Form, Sheet, Style, Strings, Json;

class InternalDBGrid extends Abstracts\GridAbstract
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
    // Search
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $search = NULL;
    
    //--------------------------------------------------------------------------------------------------------
    // Limit
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var int
    //
    //--------------------------------------------------------------------------------------------------------
    protected $limit = NULL;

    //--------------------------------------------------------------------------------------------------------
    // Joins
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $joins = [];

    //--------------------------------------------------------------------------------------------------------
    // Join Columns
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $joinColumns = [];

    //--------------------------------------------------------------------------------------------------------
    // Join Tables
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $joinTables = [];

    //--------------------------------------------------------------------------------------------------------
    // Process Column   
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $processColumn = 'ID';

    //--------------------------------------------------------------------------------------------------------
    // Confirm   
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $confirm = NULL;
    
    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    // 
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        $this->config  = config('ViewObjects', 'datagrid');
        $this->lang    = lang('ViewObjects');

        $this->confirm = 'return confirm(\''.$this->lang['dbgrid:areYouSure'].'\');';
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Column
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $column
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function processColumn(String $column) : InternalDBGrid
    {
        $this->processColumn = $column;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Column
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param int $limit
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function limit(Int $limit) : InternalDBGrid
    {
        $this->limit = $limit;

        DB::limit((int) URI::get('page'), $limit);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Columns
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string variadic $select
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function columns(...$select) : InternalDBGrid
    {
        $this->select = $select;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Search
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string variadic $search
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function search(...$search) : InternalDBGrid
    {
        $this->search = $search;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Joins
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string variadic $joins
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function joins(...$joins) : InternalDBGrid
    { 
        foreach( $joins as $key => $join )
        {
            DB::{ isset($join[2]) ? $join[2].'Join' : 'leftJoin' }($join[0], $join[1]);

            $col1Ex = explode('.', $join[0]);
            $col2Ex = explode('.', $join[1]);

            $this->joinColumns[] = $col1Ex[1];
            $this->joinColumns[] = $col2Ex[1];

            $this->joins = Arrays::addLast($this->joins, [$join[0], $join[1]]);

            $this->joinTables[$col1Ex[0]] = $col1Ex[1];
            $this->joinTables[$col2Ex[0]] = $col2Ex[1];
        }

        $this->joins[1] = $this->joins[0];
        $this->joins[0] = $this->table.'.'.$this->processColumn;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Order By
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed  $orderBy
    // @param string $type = NULL
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function orderBy($orderBy, String $type = NULL) : InternalDBGrid
    {
        DB::orderBy($orderBy, $type);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Group By
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string variadic $search
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function groupBy(...$args) : InternalDBGrid
    {
        DB::groupBy(...$args);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Where
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $column
    // @param scalar $value
    // @param string $logical
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function where($column, String $value = NULL, String $logical = NULL) : InternalDBGrid
    {
        DB::where($column, $value, $logical);
        
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Where Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array variadic $args
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function whereGroup(...$args) : InternalDBGrid
    {
        DB::whereGroup(...$args);
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Table
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $table
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function table(String $table) : InternalDBGrid
    {
        $this->table = $table;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(String $table = NULL) : String
    {   
        if( $table !== NULL )
        {
            $this->table($table);
        }
        
        if( ! isset($this->table) )
        {
            return Exceptions::throws('ViewObjects', 'dbgrid:noTable');
        }

        $table = $this->_styleElement();

        //----------------------------------------------------------------------------------------------------
        // Search
        //----------------------------------------------------------------------------------------------------
        //
        // @search
        //
        //----------------------------------------------------------------------------------------------------
        if( $search = Method::post('search') )
        {
            $this->_search($search);
        }

        //----------------------------------------------------------------------------------------------------
        // Select
        //----------------------------------------------------------------------------------------------------
        //
        // @select
        //
        //----------------------------------------------------------------------------------------------------
        if( ! empty($this->select) )
        {
            $this->_select();
        }

        //----------------------------------------------------------------------------------------------------
        // Order By
        //----------------------------------------------------------------------------------------------------
        //
        // @orderby
        //
        //----------------------------------------------------------------------------------------------------
        if( $column = URI::get('order') )
        {
            $this->orderBy($column, URI::get('type'));
        }

        //----------------------------------------------------------------------------------------------------
        // Getting Data
        //----------------------------------------------------------------------------------------------------
        //
        // object $get
        // array  $columns
        // array  $result
        // int    $countColumns
        //
        //----------------------------------------------------------------------------------------------------
        $get          = DB::get($this->table);
        $columns      = $get->columns();
        $result       = $get->resultArray();
        $countColumns = count($columns);

        if( $error = DB::error() )
        {
            return Exceptions::throws($error);
        }

        //----------------------------------------------------------------------------------------------------
        // Pagination
        //----------------------------------------------------------------------------------------------------
        //
        // @pagination
        //
        //----------------------------------------------------------------------------------------------------
        if( ! empty($this->limit) )
        {
            $pagination = $get->pagination(CURRENT_CFPATH.'/page/', $this->config['pagination']);
        }
        else
        {
            $pagination = NULL;
        }

        //----------------------------------------------------------------------------------------------------
        // Save
        //----------------------------------------------------------------------------------------------------
        //
        // Ekleme ve düzenleme işlemleri için oluşturulan bölüm.
        //
        //----------------------------------------------------------------------------------------------------
        if( Method::post('saveButton') )
        {
            $this->_save();      
        }

        //----------------------------------------------------------------------------------------------------
        // Joins Data
        //----------------------------------------------------------------------------------------------------
        //
        // @joinsdata
        //
        //----------------------------------------------------------------------------------------------------
        $joinsData = [];

        if( ! empty($this->joins) ) foreach( $this->joins as $join )
        {    
            $joinEx        = explode('.', $join);
            $joinTable     = isset($joinEx[0]) ? $joinEx[0] : NULL;
            $processColumn = isset($joinEx[1]) ? $joinEx[1] : NULL;
            $joinsData[]   = ['table' => $joinTable, 'column' => $processColumn];   
        }

        //----------------------------------------------------------------------------------------------------
        // Add / Edit Menu
        //----------------------------------------------------------------------------------------------------
        //
        // Ekleme ve güncelleme tablosunun açılması için oluşturulan bölüm.
        //
        //----------------------------------------------------------------------------------------------------
        if( $uri = URI::get('process') === 'add' || URI::get('process') === 'edit' )
        {
            $table .= $this->_addEditTable($joinsData);
        }

        //----------------------------------------------------------------------------------------------------
        // Delete
        //----------------------------------------------------------------------------------------------------
        //
        // Silme işleminin yapıldığı bölüm.
        //
        //----------------------------------------------------------------------------------------------------
        if( Method::post('deleteButton') )
        {
           $this->_delete($join);
        }

        //----------------------------------------------------------------------------------------------------
        // Table
        //----------------------------------------------------------------------------------------------------
        //
        // Genel görünümün oluşturulduğu bölüm.
        //
        //----------------------------------------------------------------------------------------------------
        $table .= '<table id="DBGRID_TABLE"'.Html::attributes($this->config['attributes']['table']).'>'.EOL;
        $table .= $this->_thead($columns, $countColumns);
        $table .= $this->_tbody($result, $countColumns, $joinsData);
        $table .= $this->_pagination($pagination, $countColumns);
        $table .= '</table>'.EOL;
        
        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Style Element
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _styleElement()
    {
        if( ! empty($this->config['styleElement']) )
        { 
            $attributes = NULL;

            foreach( $this->config['styleElement'] as $selector => $attr )
            {
                $attributes .= Sheet::selector($selector)->attr($attr)->create();
            }

            return Style::open().$attributes.Style::close();
        }

        return NULL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Thead
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $columns
    // @param int   $countColumns
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _thead($columns, $countColumns)
    {
        $table  = '<thead>'.EOL;
        $table .= '<tr'.Html::attributes($this->config['attributes']['columns']).'>';
        $table .= '<td colspan="2">';
        $table .= Form::open('addForm').Form::placeholder($this->config['placeHolders']['search'])->id('datagridSearch')->attr($this->config['attributes']['search'])->text('search').Form::close(); 
        $table .= '</td><td colspan="'.($countColumns - 1).'"></td><td align="right" colspan="2">';
        $table .= Form::action(CURRENT_CFPATH.( URI::get('page') ? '/page/'.URI::get('page') : NULL).'/process/add')->open('addForm').Form::attr($this->config['attributes']['add'])->submit('addButton', $this->config['buttonNames']['add']).Form::close();  
        $table .= '</tr><tr'.Html::attributes($this->config['attributes']['columns']).'>';   
        $table .= '<td width="20">#</td>';

        //----------------------------------------------------------------------------------------------------
        // Head Columns
        //----------------------------------------------------------------------------------------------------
        //
        // Üst sütun bölümü.
        //
        //----------------------------------------------------------------------------------------------------
        if( isArray($columns) ) foreach( $columns as $column )
        {
            $table .= '<td>'.Html::anchor(CURRENT_CFPATH.'/order/'.$column.'/type/'.(URI::get('type') === 'asc' ? 'desc' : 'asc'), Html::strong($column), $this->config['attributes']['columns']).'</td>';
        }   
        
        $table .= '<td align="right" colspan="2"><span'.Html::attributes($this->config['attributes']['columns']).'>'.Html::strong($this->lang['dbgrid:processLabel']).'</span></td>';
        $table .= '</tr>'.EOL;
        $table .= '</thead>'.EOL;

        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected TBody
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $columns
    // @param int   $countColumns
    // @param array $joinsData
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _tbody($result, $countColumns, $joinsData)
    {
        $table = '<tbody>'.EOL;

        //----------------------------------------------------------------------------------------------------
        // Body Datas
        //----------------------------------------------------------------------------------------------------
        //
        // Orta verilerin yer aldığı bölüm.
        //
        //----------------------------------------------------------------------------------------------------
        $hiddenJoins = NULL;

        foreach( $result as $key => $value )
        {    
            $value = Arrays::casing($value, 'lower', 'key');

            $hiddenValue = $value[strtolower($this->processColumn)];

            $hiddenId = Form::hidden('id', $value[strtolower($this->processColumn)] );
          
            if( ! empty( $this->joins ) )
            {
                $hiddenJoins = Form::hidden('joinsId', $this->_encode($joinsData));
            }

            $table .= '<tr><td>'.($key + 1).'</td><td>'.
                    implode('</td><td>', $value).
                    '</td><td align="right">'.
                   
                    Form::action(CURRENT_CFPATH.( URI::get('page') ? '/page/'.URI::get('page') : NULL).'/column/'.$hiddenValue.'/process/edit')->open('editButtonForm').
                    $hiddenId.
                    $hiddenJoins.
                    Form::attr($this->config['attributes']['edit'])->submit('editButton', $this->config['buttonNames']['edit']).
                    Form::close().
                    '</td>'.
                    '<td width="60" align="right">'.
                    Form::onsubmit($this->confirm)->open('addButtonForm').
                    $hiddenId.
                    $hiddenJoins.
                    Form::attr($this->config['attributes']['delete'])->submit('deleteButton', $this->config['buttonNames']['delete']).
                    Form::close().
              
                    '</td></tr>'.
                    EOL;
        } 

        $table .= '</tbody>'.EOL;

        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Pagination
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pagination
    // @param int    $countColumns
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _pagination($pagination, $countColumns)
    {
        if( ! empty($pagination) )
        {
            return '<tr><td colspan="'.($countColumns + 2).'" align="right">'.$pagination.'</td></tr>';
        }
    
        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Add Edit Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $joinsData
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _addEditTable($joinsData)
    {
        $table  = Form::open('saveForm');

        $table .= '<table type="DBGRID_ADD_EDIT_TABLE"'.Html::attributes($this->config['attributes']['table']).'>'.EOL;
        $table .= '<tr>';

        $newGetRow = NULL;

        if( ! empty($this->joins) )
        {
            foreach( $joinsData as $join )
            {
                if( URI::get('process') === 'edit' )
                {
                    DB::where($this->joinTables[$join['table']], URI::get('column'));
                }

                $newGet = DB::get($join['table']);

                if( URI::get('process') === 'edit' )
                {
                    $newGetRow = $newGet->row();
                }

                $table .= '<td>'.$this->_editTable($newGet->columns(), $join['table'], $newGetRow).'</td>';
            }         
        }
        else
        {   
            if( URI::get('process') === 'edit' )
            {
                DB::where($this->processColumn, URI::get('column'));
            }

            $newGet = DB::get($this->table);

            if( URI::get('process') === 'edit' )
            {
                $newGetRow = $newGet->row();
            }

            $table .= '<td>'.$this->_editTable($newGet->columns(), $this->table, $newGetRow).'</td>';
        }

        $table .= '<tr><td colspan="'.count($joinsData).'">'.
                      Form::attr($this->config['attributes']['save'])->submit('saveButton', $this->config['buttonNames']['save']).
                      '</td></tr>';
        $table .= '</tr></table>';
        $table .= Form::close();

        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Edit Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $columns
    // @param string $tbl
    // @param array  $row
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _editTable($columns, $tbl, $row)
    {
        $table  = '<table'.Html::attributes($this->config['attributes']['editTables']).'>';
        $table .= '<tr><td width="100">'.Strings::upperCase($tbl).'</td></tr>';
        
        foreach( $columns as $column )
        {
            if( ! in_array($column, $this->joinColumns) && strtolower($column) !== strtolower($this->processColumn) )
            {
                $table .= '<tr><td>'.Strings::titleCase($column).'</td><td>'.
                          Form::placeholder($column)
                          ->attr($this->config['attributes']['inputs']['text'])
                          ->text($tbl.':'.$column, isset($row->$column) ? $row->$column : NULL).
                          '</td></tr>';
            }

        }

        $table .= '</tr></table>';

        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _select()
    {
        $select = $this->select;

        if( ! empty($this->joins) )
        {
            $select = Arrays::addFirst($this->select, $this->table.'.'.$this->processColumn.' as ID');
        }

        DB::select(...$select);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Search
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $search
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _search($search)
    {   
        if( is_array($this->search) ) 
        {
            foreach( $this->search as $column )
            {
                $whereGroup[] = [$column.' like ', DB::like($search, 'inside'), 'or'];
            }

            DB::whereGroup($whereGroup);
        }
        else
        {
            throw new Exception($this->lang['dbgrid:noSearch']);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _delete($join)
    {
        if( ! empty($this->joins) )
        {
            foreach( $this->_decode('joinsId') as $join )
            {
                DB::where($join['column'], Method::post('id'))->delete($join['table']);
            }
        }
        else
        {
            DB::where('id', Method::post('id'))->delete($this->table);
        }

       redirect(CURRENT_URL);
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Save Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _saveData()
    {
        $saveData = Method::post();

        unset($saveData['saveButton']);

        $newSaveData = [];

        foreach( $saveData as $key => $val )
        {
            $keyEx = explode(':', $key);

            $newSaveData[$keyEx[0]][$keyEx[1]] = $val;
        }

        return $newSaveData;
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Add
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $newSaveData
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _processAdd($newSaveData)
    {
        if( URI::get('process') === 'add' )
        {
            DB::insert($this->table, $newSaveData[$this->table]);

            if( ! empty($this->joins) )
            {
                $insertId = DB::insertID();

                unset($newSaveData[$this->table]);

                foreach( $newSaveData as $t => $d )
                {
                    $d[$this->joinTables[$t]] = $insertId;
                    DB::insert($t, $d);
                }
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Edit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $newSaveData
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _processEdit($newSaveData)
    {
        if( URI::get('process') === 'edit' )
        {
            DB::where($this->processColumn, URI::get('column'))->update($this->table, $newSaveData[$this->table]);

            if( ! empty($this->joins) )
            {
                unset($newSaveData[$this->table]);

                foreach( $newSaveData as $t => $d )
                {
                    DB::where($this->joinTables[$t], URI::get('column'))->update($t, $d);
                }
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Save
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _save()
    {
        $newSaveData = $this->_saveData();

        $this->_processAdd($newSaveData);

        $this->_processEdit($newSaveData);

        redirect(CURRENT_URL);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _decode($data)
    {
        return Json::decodeArray(str_replace("'", '"', $_POST[$data]));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _encode($data)
    {
        return str_replace('"', "'", Json::encode($data));
    }
}