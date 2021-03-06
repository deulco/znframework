<?php namespace ZN\IndividualStructures;

use Support, Requirements;

class InternalCache extends Requirements implements CacheInterface
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
    // Drivers
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $drivers =
    [
        'file',
        'apc',
        'memcache',
        'redis',
        'wincache'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Protected Cache
    //--------------------------------------------------------------------------------------------------------
    //
    // Sürücü bilgisi 
    //
    // @var  string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $cache;
    
    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $driver
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct(String $driver = NULL)
    {   
        $this->config = config('IndividualStructures', 'cache');

        nullCoalesce($driver, $this->config['driver']);

        Support::driver($this->drivers, $driver);

        $this->cache = $this->_drvlib($driver);
    }

    //--------------------------------------------------------------------------------------------------------
    // Select
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $key
    // @param  mixed $expressed
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function select(String $key, $compressed = false)
    { 
        return $this->cache->select($key, $compressed);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $key
    // @param  variable $var
    // @param  numeric $time
    // @param  mixed $expressed
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function insert(String $key, $var, Int $time = 60, $compressed = false) : Bool
    {
        return $this->cache->insert($key, $var, $time, $compressed);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $key
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $key) : Bool
    {
        return $this->cache->delete($key);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Increment
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string  $key
    // @param  numeric $increment
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function increment(String $key, Int $increment = 1) : Int
    {
        return $this->cache->increment($key, $increment);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Deccrement
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string  $key
    // @param  numeric $decrement
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function decrement(String $key, Int $decrement = 1) : Int
    {
        return $this->cache->decrement($key, $decrement);
    }

    //--------------------------------------------------------------------------------------------------------
    // Clean
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  void
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function clean() : Bool
    {
        return $this->cache->clean();
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  mixed  $info
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function info($type = NULL) : Array
    {
        return $this->cache->info($type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Get Meta Data
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string  $key
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function getMetaData(String $key) : Array
    {
        return $this->cache->getMetaData($key);
    }   

    //--------------------------------------------------------------------------------------------------------
    // Driver                                                                       
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $driver
    // @return object                                    
    //                                                                                           
    //--------------------------------------------------------------------------------------------------------
    public function driver(String $driver) : InternalCache
    {
        return new self($driver);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Drvlib                                                                       
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $driver
    // @return object                                    
    //                                                                                           
    //--------------------------------------------------------------------------------------------------------
    protected function _drvlib($driver)
    {
        return uselib('ZN\IndividualStructures\Cache\Drivers\\'.$driver.'Driver');
    }
}