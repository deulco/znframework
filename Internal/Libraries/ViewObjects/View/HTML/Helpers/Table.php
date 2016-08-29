<?php namespace ZN\ViewObjects\View\HTML\Helpers;

use ZN\ViewObjects\View\Abstracts\HTMLHelpersAbstract;
use Html;

class Table extends HTMLHelpersAbstract
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
    // Attr
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $attr = [];
    

    //--------------------------------------------------------------------------------------------------------
    // Attr
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param array $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function attr(Array $attributes) : Table
    {
        foreach( $attributes as $att => $val )
        {
            $this->attr[$att] = $val; 
        }

        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Align
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $align
    //
    //--------------------------------------------------------------------------------------------------------
    public function align(String $align) : Table
    {
        $this->attr['align'] = $align;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Cell
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $spacing
    // @param numeric $padding
    //
    //--------------------------------------------------------------------------------------------------------
    public function cell(Int $spacing, Int $padding) : Table
    {
        $this->attr['cellspacing'] = $spacing;
        $this->attr['cellpadding'] = $padding;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Cell Spacing
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $spacing
    //
    //--------------------------------------------------------------------------------------------------------
    public function cellSpacing(Int $spacing) : Table
    {
        $this->attr['cellspacing'] = $spacing;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Cell Padding
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $padding
    //
    //--------------------------------------------------------------------------------------------------------
    public function cellPadding(Int $padding) : Table
    {
        $this->attr['cellpadding'] = $padding;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Border
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $border
    // @param string  $color
    //
    //--------------------------------------------------------------------------------------------------------
    public function border(Int $border, String $color = NULL) : Table
    {
        $this->attr['border'] = $border;

        if( ! empty($color) )
        {
            $this->attr['bordercolor'] = $color;
        }

        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Border Size
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $border
    //
    //--------------------------------------------------------------------------------------------------------
    public function borderSize(Int $border) : Table
    {
        $this->attr['border'] = $border;
    
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Border Color
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $color
    //
    //--------------------------------------------------------------------------------------------------------
    public function borderColor(String $color) : Table
    {
        $this->attr['bordercolor'] = $color;
    
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Width
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $width
    //
    //--------------------------------------------------------------------------------------------------------
    public function width(Int $width) : Table
    {
        $this->attr['width'] = $width;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Height
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $height
    //
    //--------------------------------------------------------------------------------------------------------
    public function height(Int $height) : Table
    {
        $this->attr['height'] = $height;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Size
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $width
    // @param numeric $height
    //
    //--------------------------------------------------------------------------------------------------------
    public function size(Int $width, Int $height) : Table
    {
        $this->attr['width']  = $width;
        $this->attr['height'] = $height;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Css
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $css
    //
    //--------------------------------------------------------------------------------------------------------
    public function css(String $css) : Table
    {
        $this->attr['class'] = $css;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Style
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param array $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function style(Array $attributes) : Table
    {
        $attribute = '';
    
        foreach( $attributes as $key => $values )
        {
            if( is_numeric($key) )
            {
                $key = $values;
            }
            
            $attribute .= ' '.$key.':'.$values.';';
        }
        
        $this->attr['style'] = $attribute;
        
        return $this;   
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Background
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $background
    //
    //--------------------------------------------------------------------------------------------------------
    public function background(String $background) : Table
    {
        $this->attr['background'] = $background;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Bg Color
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $bgColor
    //
    //--------------------------------------------------------------------------------------------------------
    public function bgColor(String $bgColor) : Table
    {
        $this->attr['bgcolor'] = $bgColor;
        
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param variadic $elements
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(...$elements) : String
    {
        $table  = '<table'.Html::attributes($this->attr).'>';
        $table .= $this->_content(...$elements);
        $table .= '</table>';
        
        if( ! empty($this->table)) $this->table = NULL;
        if( ! empty($this->attr))  $this->attr = [];
        
        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Content
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param variadic $elements
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _content(...$elements)
    {   
        $colNo = 1;
        $rowNo = 1;
        $table = '';
        $eol   = EOL;
        
        if( isset($elements[0][0]) && is_array($elements[0][0]))
        {
            $elements = $elements[0];   
        }
  
        foreach( $elements as $key => $element )
        {
            $table .= $eol."\t".'<tr>'.$eol;
            
            if(is_array($element))foreach($element as $k => $v)
            {
                $val = $v;
                $attr = "";
                
                if(is_array($v))
                {
                    $attr = Html::attributes($v);
                    $val  = $k;
                }
                
                if( strpos($val, 'th:') === 0 )
                {
                    $rowType = 'th';
                    $val = substr($val, 3);
                }
                else
                {
                    $rowType = 'td';
                }
                
                $table .= "\t\t".'<'.$rowType.$attr.'>'.$val.'</'.$rowType.'>'.$eol;    
                $colNo++;
            }
        
            $table .= "\t".'</tr>'.$eol;
            $rowNo++;
        }
        
        return $table;
    }
}