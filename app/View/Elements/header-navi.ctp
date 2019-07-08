<style>
	#dt-login-form{
		margin:2px;
		border:1px solid #FFFAE4;
		border-radius: 3px 3px 3px 3px;
		background:#634E37;
		padding:2px 2px 5px 2px;
	}
	#dt-login-form div.input.text{
		margin:0px;
	}
	#dt-login-form input[type="text"],#dt-login-form input[type="password"]{
		padding: 3px 0px;
		font-size: 14px;
	}
	#dt-login-form [type="submit"]{
		padding: 2px 25px;
	}
/*	#dt-login-form a.form-anchor{
		font-family: arial;
		font-size: 14px;
	}*/
	#dt-control-inner ul li:hover{
		opacity: 1;
	}
	#dt-control-inner{
		width: 170px;
	}
	#dt-control-inner ul{
		padding:5px;
		width: 150px;
	}

     .top-login-pane{
        float:left;
        padding:20px 10px;
        margin:2px;
        border:solid 1px;
        text-align:center;
       /* margin: 5px 23px;*/
        }
        
    .top-login-pane input[type=text],.top-login-pane input[type=password]{
        padding:5px;
        height:20px;
        width:140px;
        margin:1px;
        
        }
    .top-login-detail-pane {
		float: left;
		padding: 20px 10px;
		margin: 2px;
		text-align: center;
		width: 400px;
	}
	.top-login-detail-pane b{
		margin-right: 20px;
	}
	.top-login-detail-pane a{
		font-size: 14px;
		text-decoration:underline;
		margin:0 5px;
	}
</style>
<div id="header" style="height:229px;">
	<div class="container">
    	<?php
    		echo $this->element('mainmenu');
    	?>
    	
    	<div class="headr" style="height:220px;">
			<div id="logo" style="width:24%;float:left;" >
	        	<a href="/" title="My Result Online">
	              <img src="/img/logo.png" style="height: 125px;">
	            </a>
	        </div>
	        <div style="width:49%;float:left;">
	       	 	<?php echo $this->element('userpane');?>
	       	</div>
	        <div style="width:27%;float:right;">
		        <form action="<?php echo $this->Html->url(array('controller'=>'home','action'=>'search'));?>" method="post" id="searchform">
					<fieldset>
						<input type="hidden" value="<?php //echo $value;?>" class="value" name='data[Search][controller]' >
					    <input id="s" name="data[Search][input]" type="text" value="Search our site" class="text_input" onblur="if(this.value==''){this.value='Search our site';}" onfocus="if(this.value =='Search our site') {this.value=''; }">
						<input name="submit" type="submit" class="button" value="">
				    </fieldset>
				</form>
			</div>
     	</div>
    </div>
</div>
<?php echo $this->element('sidebarleft');?>
<script>
	jQuery('#searchform').submit(function(){
		var search = jQuery('input#s').val();
		if(search == "Search our site"){
			return false;
		}
	});
</script>