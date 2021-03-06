<?php namespace ZN\ViewObjects;

interface CalendarInterface
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
    // Url
    //--------------------------------------------------------------------------------------------------------
    // 
    // Takvimin bağlantı kurucağı url adresi.
    // 
    // @param  string $url
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function url(String $url) : InternalCalendar;

    //--------------------------------------------------------------------------------------------------------
    // Name Type
    //--------------------------------------------------------------------------------------------------------
    // 
    // Ay ve günler için normal isimlerini mi yoksa kısaltılmış isimlerin mi    
    // kullanılacağını belirlemek için kullanılır.
    // 
    // @param  string $day
    // @param  string $month
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function nameType(String $day, String $month) : InternalCalendar;
    
    //--------------------------------------------------------------------------------------------------------
    // Css
    //--------------------------------------------------------------------------------------------------------
    // 
    // Takvime css sınıfları uygulamak için kullanılır.
    // 
    // @param  array $css
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function css(Array $css) : InternalCalendar;
    
    //--------------------------------------------------------------------------------------------------------
    // Style
    //--------------------------------------------------------------------------------------------------------
    // 
    // Takvime stiller uygulamak için kullanılır.
    // 
    // @param  array $style
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function style(Array $style) : InternalCalendar;
    
    //--------------------------------------------------------------------------------------------------------
    // Type
    //--------------------------------------------------------------------------------------------------------
    // 
    // Takvimin kullanım türünü belirlemek içindir.
    // 
    // @param  string $type
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function type(String $type) : InternalCalendar;
    
    //--------------------------------------------------------------------------------------------------------
    // Link Names
    //--------------------------------------------------------------------------------------------------------
    // 
    // Takvimde yer alan iler ve geri butonu linklerinin isimlerini          
    // değiştirmek için kulanılır.
    // 
    // @param  string $prev
    // @param  string $next
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function linkNames(String $prev, String $next) : InternalCalendar;

    //--------------------------------------------------------------------------------------------------------
    // Settings
    //--------------------------------------------------------------------------------------------------------
    // 
    // Takvim ayalarını yapılandırmak için kullanılır.
    // 
    // @param  array $settings
    // @return object
    //
    //--------------------------------------------------------------------------------------------------------
    public function settings(Array $settings) : InternalCalendar;
    
    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    // 
    // Takvimin oluşturulması için kullanılan son yöntemdir.
    // 
    // @param  numeric $year
    // @param  numeric $month
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(Int $year = NULL, Int $month = NULL) : String;
}