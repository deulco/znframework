<?php	
namespace ZN\VariableTypes;

class InternalChars extends \CallController implements CharsInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Is Alnum                                                                   
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $string
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function isAlnum($string)
	{
		return ctype_alnum($string);		
	}
	
	//----------------------------------------------------------------------------------------------------
	// Is Alpha                                                                   
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $string
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function isAlpha($string)
	{
		return ctype_alpha($string);		
	}
	
	//----------------------------------------------------------------------------------------------------
	// Is Numeric                                                                   
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $string
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function isNumeric($string)
	{
		return ctype_digit($string);		
	}
	
	//----------------------------------------------------------------------------------------------------
	// Is Graph                                                                   
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $string
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function isGraph($string)
	{
		return ctype_graph($string);		
	}
	
	//----------------------------------------------------------------------------------------------------
	// Is Lower                                                                  
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $string
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function isLower($string)
	{
		return ctype_lower($string);		
	}
	
	//----------------------------------------------------------------------------------------------------
	// Is Upper                                                                  
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $string
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function isUpper($string)
	{
		return ctype_upper($string);		
	}
	
	//----------------------------------------------------------------------------------------------------
	// Is Print                                                                  
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $string
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function isPrint($string)
	{
		return ctype_print($string);		
	}
	
	//----------------------------------------------------------------------------------------------------
	// Is Non Alpha                                                                   
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $string
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function isNonAlnum($string)
	{
		return ctype_punct($string);		
	}
	
	//----------------------------------------------------------------------------------------------------
	// Is Space                                                                   
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $string
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function isSpace($string)
	{
		return ctype_space($string);		
	}
	
	//----------------------------------------------------------------------------------------------------
	// Is Hex                                                                   
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $string
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function isHex($string)
	{
		return ctype_xdigit($string);		
	}
	
	//----------------------------------------------------------------------------------------------------
	// Is Control                                                                   
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $string
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function isControl($string)
	{
		return ctype_cntrl($string);		
	}	
}