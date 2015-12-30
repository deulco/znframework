<?php	
interface ArraysInterface
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
	// Pos Change                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Herhangi bir dizi indeksini, istenilen başka bir dizi indeksine 		  
	// eklemeye yarar.  															              
	//																						  
	// Parametreler: 3 parametresi vardır.                                              		  
	// 1. array var @array => İşlem yapılıcak dizi.							  				  
	// 2. string/numeric var @poss => Yerleştirme işlemi yapılacak elemanın indeksi.		      
	// 3. string/numeric var @change_pos => Yerleştirme işlemi yapılacağı yeni indeks numarası.
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function posChange($array, $poss, $changePos);

	
	//----------------------------------------------------------------------------------------------------
	// Pos Reverse
	//----------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Dizi elementlarını kendi içlerinde yer değiştirmek için kullanılır. 	  
	//																						  
	// Parametreler: 3 parametresi vardır.                                              		  
	// 1. array var @array => İşlem yapılıcak dizi.							  				  
	// 2. string/numeric var @poss => Yerleştirme işlemi yapılacak elemanın indeksi.		      
	// 3. string/numeric var @change_pos => Yerleştirme işlemi yapılacağı yeni indeks numarası.
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function posReverse($array, $poss, $changePos);
	
	//----------------------------------------------------------------------------------------------------
	// Casing
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param string $type  : lower, upper, title
	// @param string $keyval: all, key, val	                          								  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function casing($array, $type, $keyval);
	
	//----------------------------------------------------------------------------------------------------
	// Remove Last
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $count							  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function removeLast($array, $count);
	
	//----------------------------------------------------------------------------------------------------
	// Remove First
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array		
	// @param numeric $count			  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function removeFirst($array, $count);
	
	//----------------------------------------------------------------------------------------------------
	// Add First
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $element						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function addFirst($array, $element);
	
	//----------------------------------------------------------------------------------------------------
	// Add Last
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $element						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function addLast($array, $element);
	
	//----------------------------------------------------------------------------------------------------
	// Delete Element
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $object						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function deleteElement($array, $object);
	
	//----------------------------------------------------------------------------------------------------
	// Multikey
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param string $keySplit:|						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function multikey($array, $keySplit);
	
	//----------------------------------------------------------------------------------------------------
	// Keyval
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param string $keyval: val/value, key, vals/values, keys						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function keyval($array, $keyval);
		
	//----------------------------------------------------------------------------------------------------
	// Get Last
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $count
	// @param bool	  $preserveKey						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function getLast($array, $count, $preserverKey);
	
	//----------------------------------------------------------------------------------------------------
	// Get First
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $count
	// @param bool	  $preserveKey						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function getFirst($array, $count, $preserverKey);
	
	//----------------------------------------------------------------------------------------------------
	// Order
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param string $type :desc, asc...
	// @param string $flags:regular						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function order($array, $type, $flags);
	
	//----------------------------------------------------------------------------------------------------
	// Object Data
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function objectData($data);
	
	//----------------------------------------------------------------------------------------------------
	// Length
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function length($data);
	
	//----------------------------------------------------------------------------------------------------
	// Apportion
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $portionCount
	// @param bool	  $preserveKeys						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function apportion($data, $portionCount, $preserveKeys);
	
	//----------------------------------------------------------------------------------------------------
	// Combine
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $keys
	// @param array $values					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function combine($keys, $values);
	
	//----------------------------------------------------------------------------------------------------
	// Count Same Values
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $key					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function countSameValues($array, $key);
	
	//----------------------------------------------------------------------------------------------------
	// Flip
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function flip($array);
	
	//----------------------------------------------------------------------------------------------------
	// Transform
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function transform($array);
	
	//----------------------------------------------------------------------------------------------------
	// Implement Callback
	//----------------------------------------------------------------------------------------------------
	//
	// @param ...args				  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function implementCallback();
	
	//----------------------------------------------------------------------------------------------------
	// Recursive Merge
	//----------------------------------------------------------------------------------------------------
	//
	// @param ...args				  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function recursiveMerge();
	
	//----------------------------------------------------------------------------------------------------
	// Merge
	//----------------------------------------------------------------------------------------------------
	//
	// @param ...args			  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function merge();
	
	//----------------------------------------------------------------------------------------------------
	// Reverse
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param bool	  $preserveKeys						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function reverse($array, $preserveKeys);
	
	//----------------------------------------------------------------------------------------------------
	// Product
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function product($array);
	
	//----------------------------------------------------------------------------------------------------
	// Sum
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function sum($array);
	
	//----------------------------------------------------------------------------------------------------
	// Random
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $countRequest					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function random($array, $countRequest);
	
	//----------------------------------------------------------------------------------------------------
	// Search
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $element
	// @param bool	$strict						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function search($array, $element, $strict);
	
	//----------------------------------------------------------------------------------------------------
	// Value Exists
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $element
	// @param bool	$strict						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function valueExists($array, $element, $strict);
	
	//----------------------------------------------------------------------------------------------------
	// Key Exists
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $key					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function keyExists($array, $key);
	
	//----------------------------------------------------------------------------------------------------
	// Section
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $start
	// @param numeric $length
	// @param bool	  $preserveKey						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function section($array, $start, $length, $preserveKeys);
	
	//----------------------------------------------------------------------------------------------------
	// Resection
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $start
	// @param numeric $length
	// @param mixed	  $newElement						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function resection($array, $start, $length, $newElement);
	
	//----------------------------------------------------------------------------------------------------
	// Delete Recurrent
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param string $flags					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function deleteRecurrent($array, $flags);
	
	//----------------------------------------------------------------------------------------------------
	// Series
	//----------------------------------------------------------------------------------------------------
	//
	// @param numeric $start
	// @param numeric $end
	// @param numeric $count						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function series($start, $end, $step);
}