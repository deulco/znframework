<?php
/************************************************************/
/*                  PAGINATION COMPONENT                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class ComponentPag
{
	protected $url			= NULL;
	protected $limit		= NULL;
	protected $start		= NULL;
	protected $total_rows	= NULL;
	protected $count_links	= 10;
	protected $attr			= array();
	protected $css			= array();
	protected $style		= array();
	protected $first_tag 	= '[prev]';
	protected $last_tag 	= '[next]';
	protected $firstest_tag = '[first]';
	protected $lastest_tag 	= '[last]';
	
	public function url($url = '')
	{
		if( ! is_url($url))
		{
			$url = site_url($url);	
		}
		
		$this->url = $url;
		
		return $this;
	}
	
	public function start($start = 0)
	{
		if( ! is_numeric($start))
		{
			return $this;
		}
		
		$this->start = $start;
		
		return $this;
	}
	
	public function limit($limit = 10)
	{
		if( ! is_numeric($limit))
		{
			return $this;
		}
		
		$this->limit = $limit;
		
		return $this;
	}
	
	public function total_rows($total_rows = 0)
	{
		if( ! is_numeric($total_rows))
		{
			return $this;
		}
		
		$this->total_rows = $total_rows;
		
		return $this;
	}
	
	public function count_links($count_links = 10)
	{
		if( ! is_numeric($count_links))
		{
			return $this;
		}
		
		$this->count_links = $count_links;
		
		return $this;
	}
	
	public function attr($attr = array())
	{
		if( ! is_array($attr))
		{
			return $this;	
		}
		
		if(isset($attr['url']))			$this->url 			= $attr['url'];
		if(isset($attr['start']))		$this->start 		= $attr['start'];
		if(isset($attr['limit']))		$this->limit 		= $attr['limit'];
		if(isset($attr['total_rows']))	$this->total_rows 	= $attr['total_rows'];
		if(isset($attr['count_links']))	$this->count_links 	= $attr['count_links'];
		if(isset($attr['prev_name']))	$this->first_tag 	= $attr['prev_name'];
		if(isset($attr['next_name']))	$this->last_tag 	= $attr['next_name'];
		if(isset($attr['first_name']))	$this->firstest_tag = $attr['first_name'];
		if(isset($attr['last_name']))	$this->lastest_tag 	= $attr['last_name'];
		
		$this->attr = $attr;
		
		return $this;	
	}
	
	public function css($css = '')
	{
		if( ! is_array($css))
		{
			return $this;	
		}
		
		$this->css = $css;
		
		return $this;
	}
	
	public function style($style = array())
	{
		if( ! is_array($style))
		{
			return $this;	
		}
		
		$this->style = $style;
		
		return $this;
	}
	
	public function create($start = NULL, $limit = NULL, $total_rows = NULL, $url = NULL)
	{
		$start = 		($start !== NULL) 
				 		? $start
				 		: $this->start;
				 
		$total_rows = 	($total_rows !== NULL) 
				      	? $total_rows
				      	: $this->total_rows;
		
		$limit = 		($limit !== NULL) 
				 		? $limit
				 		: $this->limit;
				 
		if($url !== NULL)
		{
			$this->url($url);
		}
		
		$url = suffix($this->url);
								 	
		$page  = "";
		$links = "";
		
		if($start === NULL) 
		{
			import::library('Uri');
			
			if( ! is_numeric(uri::segment(-1))) 
				$start_page = 0; 
			else 
				$start_page = uri::segment(-1);
		}
		else 
		{
			if( ! is_numeric($start)) $start = 0;
			$start_page = $start;
		}
		$per_page = @ceil($total_rows / $limit);
		
		if($this->count_links > $per_page)
		{
		
			for($i = 1; $i <= $per_page; $i++)
			{
				$page = ($i - 1) * $limit;
				
				if($i - 1 == $start_page / $limit)
				{
					$current_link = (isset($this->css['current'])) ? 'class="'.$this->css['current'].'"' : "";
					$current_link_style =  (isset($this->style['current'])) ? 'style="'.$this->style['current'].'"' : "";
				}
				else
				{
					$current_link = '';	
					$current_link_style = '';	
				}
				
				$class_links = (isset($this->css['links'])) ? 'class="'.$this->css['links'].'"' : "";
				$style_links = (isset($this->style['links'])) ? 'style="'.$this->style['links'].'"' : "";
				$links .= '<a href="'.$url.$page.'" '.$class_links.' '.$style_links.'><span '.$current_link.' '.$current_link_style.'> '.$i.'</span></a>';
			}
			
			if($start_page != 0)
			{

				if(isset($this->css['prev']))
				{
					$class_prev = 'class="'.$this->css['prev'].'"';
				}
				elseif(isset($this->css['links']))
				{
					$class_prev = 'class="'.$this->css['links'].'"';
				}
				else
				{
					$class_prev = '';	
				}
				
				if(isset($this->style['prev']))
				{
					$style_prev = 'style="'.$this->style['prev'].'"';
				}
				elseif(isset($this->style['links']))
				{
					$style_prev = 'style="'.$this->style['links'].'"';
				}
				else
				{
					$style_prev = '';	
				}
				
				$first = '<a href="'.$url.($start_page - $limit ).'" '.$class_prev .' '.$style_prev.'>'.$this->first_tag.'</a>';
			}
			else
			{
				$first = '';	
			}
			
			if($start_page != $page)
			{
				if(isset($this->css['next']))
				{
					$class_next = 'class="'.$this->css['next'].'"';
				}
				elseif(isset($this->css['links']))
				{
					$class_next = 'class="'.$this->css['links'].'"';
				}
				else
				{
					$class_next = '';	
				}
				
				if(isset($this->style['next']))
				{
					$style_next = 'style="'.$this->style['next'].'"';
				}
				elseif(isset($this->style['links']))
				{
					$style_next = 'style="'.$this->style['links'].'"';
				}
				else
				{
					$style_next = '';	
				}
				
				$last = '<a href="'.$url.($start_page + $limit).'" '.$class_next.' '.$style_next.'>'.$this->last_tag.'</a>';
			}
			else
			{
				$last = '';	
			}
		
			if($total_rows > $limit) return $first.' '.$links.' '.$last;
		}
		else
		{
			
			$per_page = $this->count_links;
			
			if(isset($this->css['last'])) $lastest_tag_class =  ' class="'.$this->css['last'].'" '; else $lastest_tag_class = '';
			if(isset($this->css['first'])) $firstest_tag_class =  ' class="'.$this->css['first'].'" '; else $firstest_tag_class = '';
			if(isset($this->css['next'])) $last_tag_class =  ' class="'.$this->css['next'].'" '; else $last_tag_class = '';
			if(isset($this->css['current'])) $current_link_class =  ' class="'.$this->css['current'].'" '; else $current_link_class = '';
			if(isset($this->css['links'])) $links_class =  ' class="'.$this->css['links'].'" '; else $links_class = '';
			if(isset($this->css['prev'])) $first_tag_class =  ' class="'.$this->css['prev'].'" '; else $first_tag_class = '';
			
			if(isset($this->style['last'])) $lastest_tag_style =  ' style="'.$this->style['last'].'" '; else $lastest_tag_style = '';
			if(isset($this->style['first'])) $firstest_tag_style =  ' style="'.$this->style['first'].'" '; else $firstest_tag_style = '';
			if(isset($this->style['next'])) $last_tag_style =  ' style="'.$this->style['next'].'" '; else $last_tag_style = '';
			if(isset($this->style['current'])) $current_link_style =  ' style="'.$this->style['current'].'" '; else $current_link_style = '';
			if(isset($this->style['links'])) $links_style =  ' style="'.$this->style['links'].'" '; else $links_style = '';
			if(isset($this->style['prev'])) $first_tag_style =  ' style="'.$this->style['prev'].'" '; else $first_tag_style = '';
			
			
			$lastest_tag = '<a href="'.$url.($total_rows - ($total_rows % $limit) - 1).'"'.$lastest_tag_class.$lastest_tag_style.'>'.$this->lastest_tag.'</a>';
			$firstest_tag = '<a href="'.$url.'0"'.$firstest_tag_class.$firstest_tag_style.'>'.$this->firstest_tag.'</a>';
			
		
			if($start_page > 0)
			{
				$first = '<a href="'.$url.($start_page - $limit ).'"'.$first_tag_class.$first_tag_style.'>'.$this->first_tag.'</a>';
				
			}
			else
			{
				$first = '';	
			}
			
			
			
			if(($start_page / $limit) == 0) $pag_index = 1; else $pag_index = @ceil( $start_page / $limit + 1);
			
			if($start_page < $total_rows - $limit)
			{
				$last = '<a href="'.$url.($start_page + $limit).'"'.$last_tag_class.$last_tag_style.'>'.$this->last_tag.'</a>';	
				
			}
			else
			{
				$last = '';
				$lastest_tag = '';
				$pag_index = @ceil($total_rows / $limit) - $this->count_links + 1;
			}
			
			if($pag_index < 1 || $start_page == 0) $firstest_tag = '';
		
			$n_per_page = $per_page + $pag_index - 1;
			
			if($n_per_page >= @ceil($total_rows / $limit)) 
			{
				$n_per_page = @ceil($total_rows / $limit);
				$lastest_tag = '';
				$last = '';
			}
			
			$links = '';
			
			for($i = $pag_index; $i <= $n_per_page; $i++)
			{
				$page = ($i - 1) * $limit;
				
				if($i - 1 == $start_page / $limit)
				{
					$current_link = $current_link_class;
				}
				else
				{
					$current_link = '';	
				}
				
				$links .= '<a href="'.$url.$page.'"'.$links_class.$links_style.'><span '.$current_link.'> '.$i.'</span></a>';
			}
	
			if($total_rows > $limit) return $firstest_tag.' '.$first.' '.$links.' '.$last.' '.$lastest_tag;
		}
	}
}