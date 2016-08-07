<?php
namespace ZN\Validation;

interface ValidationInterface
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
	// Identity
	//----------------------------------------------------------------------------------------------------
	//
	// @param int $no
	//
	//----------------------------------------------------------------------------------------------------
	public function identity(Int $no);
	
	//----------------------------------------------------------------------------------------------------
	// Email
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $no
	//
	//----------------------------------------------------------------------------------------------------
	public function email(String $data);
	
	//----------------------------------------------------------------------------------------------------
	// URL
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $data
	//
	//----------------------------------------------------------------------------------------------------
	public function url(String $data);
	
	//----------------------------------------------------------------------------------------------------
	// Special Char
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $data
	//
	//----------------------------------------------------------------------------------------------------
	public function specialChar(String $data);
	
	//----------------------------------------------------------------------------------------------------
	// Maxchar
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $data
	// @param int    $char
	//
	//----------------------------------------------------------------------------------------------------
	public function maxchar(String $data, Int $char);
	
	//----------------------------------------------------------------------------------------------------
	// Minchar
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $data
	// @param int    $char
	//
	//----------------------------------------------------------------------------------------------------
	public function minchar(String $data, Int $char);
	
	//----------------------------------------------------------------------------------------------------
	// method()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $method
	//
	//----------------------------------------------------------------------------------------------------
	public function method(String $method);
	
	//----------------------------------------------------------------------------------------------------
	// value()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $value
	//
	//----------------------------------------------------------------------------------------------------
	public function value(String $value);
	
	//----------------------------------------------------------------------------------------------------
	// required()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function required();
	
	//----------------------------------------------------------------------------------------------------
	// numeric()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function numeric();
	
	//----------------------------------------------------------------------------------------------------
	// alpha()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function alpha();
	
	//----------------------------------------------------------------------------------------------------
	// alnum()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function alnum();
	
	//----------------------------------------------------------------------------------------------------
	// match()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $match
	//
	//----------------------------------------------------------------------------------------------------
	public function match(String $match);
	
	//----------------------------------------------------------------------------------------------------
	// matchPassword()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $match
	//
	//----------------------------------------------------------------------------------------------------
	public function matchPassword(String $match);
	
	//----------------------------------------------------------------------------------------------------
	// oldPassword()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $oldPassword
	//
	//----------------------------------------------------------------------------------------------------
	public function oldPassword(String $oldPassword);
	
	//----------------------------------------------------------------------------------------------------
	// compare()
	//----------------------------------------------------------------------------------------------------
	//
	// @param numeric $min
	// @param numeric $max
	//
	//----------------------------------------------------------------------------------------------------
	public function compare(Int $min = NULL, Int $max = NULL);
	
	//----------------------------------------------------------------------------------------------------
	// validate()
	//----------------------------------------------------------------------------------------------------
	//
	// @param args
	//
	//----------------------------------------------------------------------------------------------------
	public function validate(...$args);
	
	//----------------------------------------------------------------------------------------------------
	// secure()
	//----------------------------------------------------------------------------------------------------
	//
	// @param args
	//
	//----------------------------------------------------------------------------------------------------
	public function secure(...$args);
	
	//----------------------------------------------------------------------------------------------------
	// pattern()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $pattern
	// @param string $char
	//
	//----------------------------------------------------------------------------------------------------
	public function pattern(String $pattern, String $char = NULL);

	//----------------------------------------------------------------------------------------------------
	// phone()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $design
	//
	//----------------------------------------------------------------------------------------------------
	public function phone(String $design = NULL);
	
	//----------------------------------------------------------------------------------------------------
	// captcha()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $captcha
	//
	//----------------------------------------------------------------------------------------------------
	public function captcha(String $captcha);
	
	//----------------------------------------------------------------------------------------------------
	// Rules
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $name
	// @param array  $config
	// @param string $viewName
	// @param string $met
	//
	//----------------------------------------------------------------------------------------------------
	public function rules(String $name, Array $config = [], String $viewName = NULL, String $met = 'post');
	
	//----------------------------------------------------------------------------------------------------
	// Nval
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $name
	//
	//----------------------------------------------------------------------------------------------------
	public function nval(String $name);
	
	//----------------------------------------------------------------------------------------------------
	// Error
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $name
	//
	//----------------------------------------------------------------------------------------------------
	public function error(String $name = 'array');
	
	//----------------------------------------------------------------------------------------------------
	// Error
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $name
	// @param string $met
	//
	//----------------------------------------------------------------------------------------------------
	public function postBack(String $name, String $met = 'post');
}