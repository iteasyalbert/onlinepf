<div class="menu-sidebar" style="position: absolute;">
<?php 
//debug($data);
	$letters = array();
	$initialLetter = '';
	if(!empty($data)){
		foreach($data as $key=>$lab){
			$letter = $lab['Laboratory']['name'][0];
			$lower = strtolower($letter);
			$upper = strtoupper($letter);
			if($initialLetter<>$lower && $initialLetter<>$upper){
				$finalLetter = $letter;
				$letters[] = $finalLetter;
				$initialLetter = $finalLetter;
			}		
		} 
	}
	if(!empty($physicians)){
		foreach($physicians as $key=>$lab){
			$letter = $lab['People']['lastname'][0];
			$lower = strtolower($letter);
			$upper = strtoupper($letter);
			if($initialLetter<>$lower && $initialLetter<>$upper){
				$finalLetter = $letter;
				$letters[] = $finalLetter;
				$initialLetter = $finalLetter;
			}		
		} 
	}
	
	$controller = $this->params['controller'];
	$action = $this->params['action'];
?>
 	<ul class="j-load-all">
 		<li><?php echo $this->Html->link('View in Tabular',array('controller'=>$controller,'action'=>$action),array('class'=>'smoothScroll'))?></li>
    	<li><a class="smoothScroll" href="#appetizers">View in Google Map</a></li>				
	</ul>
</div>