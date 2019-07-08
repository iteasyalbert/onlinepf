<?php 
class AppModel extends Model{
	
	public $dataSource;
	public $postType = array(
		'lyms'=>0,
		'posted'=>1
	);
	public $memberRole = array(
		'super admin'=>1,
		'owner'=>2,
		'administrator'=>3,
		'medtech'=>4,
		'physician'=>5,
		'patient'=>6
	);
	public $laboratoryClass = array(
		1 => 'Primary',
		2 => 'Secondary',
		3 => 'Tertiary'
	);
	public $userStatus = array(
		1 => 'Active',
		2 => 'Unconfirm',
		3 => 'Verified',
		4 => 'ProfileCompleted',
		5 => 'Registered',
		6 => 'Suspended',
		7 => 'Blocked',
		8 => 'Expired'
	);
	function unbindAllModel($exceptions = array(),$once = false){
    	$defaultAssocoations = array(
    		'belongsTo',
    		'hasOne',
    		'hasMany',
    		'hasAndBelongsToMany'
    	);
    	$currentModelAssociations;
    	foreach($defaultAssocoations as $association){
    		if(property_exists($this, $association)){
    			$currenModelAssociations[$association] = array();
    			foreach(array_keys($this->{$association}) as $associatedModel)
    				if(!in_array($associatedModel, $exceptions))
    					$currenModelAssociations[$association][] = $associatedModel;
    		}
    	}
    	
    	$this->unbindModel($currenModelAssociations,$once);
    }
	
    
    function begin(){
    	$this->dataSource = $this->getDataSource();
    }
	
    function commit(){
    	if(!is_null($this->dataSource))
    		return $this->dataSource->commit();
    	return false;
    }
    function rollback(){
    	if(!is_null($this->dataSource))
    		return $this->dataSource->rollback();
    	return false;
    }
}
?>