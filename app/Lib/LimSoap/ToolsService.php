<?php
class ToolsService {
	
	public static function registerServices($server, $baseendpoint)
	{
		$server->register(
				'ToolsService.ping',					//function
				array(),								//parameters
				array('return' => 'xsd:int'), 		//return
				null,
				$baseendpoint.'/ping' 	//endpoint
		);		
	}
	
	public static function registerComplexTypes($server, $servicepath)
	{

	}	
	
	function ping()
	{
		return 1;
	}
}
