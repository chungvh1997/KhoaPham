<?php 
	require_once APPPATH.'libraries/class-array-config-writer.php';
 class config_write{
 	public function get_instance($file=null,$varriable_name='config')
 	{
 		if(!$file){
 			$file = APPPATH."config/config.php";
 		}
 		return new Array_Config_Writer($file,$varriable_name);
 	}
	public function get_language($file,$varriable_name='lang')
 	{
		$file = APPPATH."language/".$file."_lang.php";
 		return new Array_Config_Writer($file,$varriable_name);
 	}
 }