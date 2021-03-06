<?php namespace ZN\DataTypes;

use CallController;

class InternalSeparator extends CallController implements SeparatorInterface
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
    // Key
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $key = "+-?||?-+" ;
    
    //--------------------------------------------------------------------------------------------------------
    // Separator
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $separator = "|?-++-?|";
    
    //--------------------------------------------------------------------------------------------------------
    // Encode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param array  $data
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public function encode(Array $data, String $key = NULL, String $separator = NULL) : String
    {
        $word = '';
        
        // @key parametresi boş ise ön tanımlı ayracı kullan.
        if( empty($key) ) 
        {
            $key = $this->key;
        }
        
        // @seperator parametresi boş ise ön tanımlı ayracı kullan.
        if( empty($separator) ) 
        {
            $separator = $this->separator;
        }
        // -----------------------------------------------------------------------------
        
        // Özel veri tipine çevirme işlemini başlat.
        foreach( $data as $k => $v )
        {
            $word .= $this->_security($k).$key.$this->_security($v).$separator; 
        }
        
        return mb_substr($word, 0, -(mb_strlen($separator)));
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Decode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $word
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public function decode(String $word, String $key = NULL, String $separator = NULL) : \stdClass
    {
        if( empty($key) ) 
        {
            $key = $this->key;
        }
        
        if( empty($separator) ) 
        {
            $separator = $this->separator;
        }
        
        $keyval = explode($separator, $word);
        $splits = [];
        $object = [];
        
        if( is_array($keyval) ) foreach( $keyval as $v )
        {
             $splits = explode($key, $v);
             
             if( isset($splits[1]) )
             {
                $object[$splits[0]] = $splits[1];
             }
        }
        
        return (object) $object;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Decode Array
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $word
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public function decodeArray(String $word, String $key = NULL, String $separator = NULL) : Array
    {
        return (array) $this->decode($word, $key, $separator);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Security
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string  $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _security($data)
    {
        return str_replace([$this->key, $this->separator], '', $data);
    }
}