<?php
header('Content-Type: text/html; charset=UTF-8');

define( 'obse_PATH'    , dirname(__FILE__)     . DIRECTORY_SEPARATOR );
define( 'obse_PLUGINS' , obse_PATH . 'plugins' . DIRECTORY_SEPARATOR );
define( 'obse_LAYOUT'  , obse_PATH . 'layout'  . DIRECTORY_SEPARATOR );
define( 'obse_DATA'    , obse_PATH . 'data'    . DIRECTORY_SEPARATOR );

function include_file($included_filename, array $obse_query = array()) {
	if (!is_string($included_filename)) {
		trigger_error('Argument 1 passed to include_file() must be an instance of string, '. gettype($included_filename) .' given ', E_USER_ERROR);
	}
	
	unset($included_filename);
	
	if (!empty($obse_query)) {
		if (array_key_exists('obse_query', $obse_query)) {
			trigger_error('Argument 2 passed to include_filename() must not contain array key "obse_query" ', E_USER_WARNING);
		}
		extract($obse_query, EXTR_SKIP);
	}
	include func_get_arg(0);
}

function plugin($plugin_filename, array $obse_query = array() ) {
	include_file(obse_PLUGINS . $plugin_filename . '.php', $obse_query);
}

function layout($layout_filename, array $obse_query = array()) {
	if (!empty($obse_query)) {
		if(is_array(reset($obse_query))) {
			foreach ($obse_query as $query) {
				include_file(obse_LAYOUT . $layout_filename . '.php', $query);
			}
		} else {
				include_file(obse_LAYOUT . $layout_filename . '.php', $obse_query);
		}
	}
}


function get_var_from_file($var_filename, $var_name = 'obse_query', $var_params = array()) {
	if (!empty($var_params)) {
		extract($var_params, EXTR_PREFIX_INVALID, 'var');
	}
	include $var_filename;
	if (isset($$var_name)) {
		return $$var_name;
	} else {
		return false;
	}
}


function getdata($data_filename, $data_var = 'obse_query', $data_params = array()) {
	if (is_array($data_var)) {
		return get_var_from_file(obse_DATA.$data_filename.'.php', 'obse_query', $data_var);
	} else {
		$data_var = (!empty($data_var))? $data_var:'obse_query';
		return get_var_from_file(obse_DATA.$data_filename.'.php', $data_var, $data_params);
	}
}
?>
