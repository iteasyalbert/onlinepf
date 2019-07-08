<?php $this->layout = 'error';?>
<script>
	jQuery('document').ready(function(){
	var prefix = <?php echo $this->Js->object($this->params['prefix']);?>;
	var role = <?php echo $this->Js->object($urole);?>;
	if(prefix){
		if(prefix == 'admin' && role == 1)
			window.location.href = "/admin";
		else if(prefix == 'sales' && role == 10)
			window.location.href = "/sales";
		else if(prefix == 'patient' && role == 9)
			window.location.href = "/patient";
		else if(prefix == 'physician' && role == 6)
			window.location.href = "/physician";
		else if(prefix == 'laboratory' && role == 3)
			window.location.href = "/laboratory";
		else
			if(role == 1)
				window.location.href = "/admin";
			else if(role == 10)
				window.location.href = "/sales";
			else if(role == 9)
				window.location.href = "/patient";
			else if(role == 6)
				window.location.href = "/physician";
			else if(role == 3)
				window.location.href = "/laboratory";

	}else{
		window.location.href = "/";
	}
	});
</script>