<?php
function asset_url(){
	return base_url().'assets/';
}

if(!function_exists('paginate')){
	function paginate($param = array()){

			$CI =& get_instance();

			$CI->load->library('pagination');

			if(!empty($param['base_url'])){
				$config['base_url'] = $param['base_url'];
			}

			if(!empty($param['rows'])){
				$config['total_rows'] = $param['rows'];
			}
			
			
			$config['per_page'] = 1;

			if(!empty($param['uri_segment'])){
				$config['uri_segment'] = $param['uri_segment'];
			}
			$config['use_page_numbers'] = TRUE;

			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';


			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';

			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			$config['next_link'] = "&gt;";

			$config['next_tag_open'] = "<li>";
			$config['next_tag_close'] = "</li>";


			$config['prev_link'] = "&lt;";
			
			$config['prev_tag_open'] = "<li>";
			$config['prev_tag_close'] = "</li>";

			$config['cur_tag_open'] = "<li class='active'><a href='#'>";
			$config['cur_tag_close'] = '</a></li>';


			$config['num_tag_open'] = "<li>";
			$config['num_tag_close'] = "</li>";

			$config['num_links'] = 1;
			
			$CI->pagination->initialize($config);

			$model  = $param['model'];
			$method = $param['method'];
			
			if($CI->uri->segment($param['uri_segment']) == ''){
				$param = array('limit' => $config['per_page']) + $param;
				$pageData['products']    = $CI->$model->$method($param);
			}else{

				$offset = (int)$CI->uri->segment($param['uri_segment']);
				$param = array('limit' => $config['per_page'], 'offset' => $offset) + $param;

				$pageData['products']    = $CI->$model->$method($param);
			}

			return $pageData['products'];
	}
}

if ( !function_exists('sessionRead'))
{
	function sessionRead($var)
	{
		if (isset($_SESSION[$var]))
		{
			return $_SESSION[$var];
		}
		else
		{
			return false;
		}
	}
}

if ( !function_exists('sessionWrite'))
{
	function sessionWrite($var, $val)
	{
		$_SESSION[$var]=$val;
	}
}

if ( !function_exists('startsWith'))
	{
	function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
}



if ( !function_exists('monthArray'))
{
	function monthArray() {
		$monthOptions = array(
			1 => 'Jan', 2 => 'Feb',3 => 'Mar', 4 => 'Apr',5 => 'May', 6 => 'Jun',7 => 'Jul', 8 => 'Aug',9 => 'Sep', 10 => 'Oct',11 => 'Nov', 12 => 'Dec'
				
		);
		return $monthOptions;
	}
}

?>