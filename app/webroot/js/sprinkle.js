var maintabs;
$(document).ready(function() {
	if($('#main-tab > ul').length)
		maintabs = $('#main-tab > ul').tabs({ fx: { /*height: 'toggle', opacity: 'toggle'*/ } });
	if($('#featuredvid > ul').length)
		$('#featuredvid > ul').tabs();
});

function setSelectedTab(tabid){
	maintabs.tabs("select",tabid);
	
}
