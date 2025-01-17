{include file="inc/top.tpl"}
<div style='padding:10px'>

<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">	
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">Condor Soaring Romania</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
	{literal}
		function slupdate () {
			$("#sl").load("sl");
		}
		setInterval("slupdate()",10000);
	{/literal}
	</script>
	<div id="sl">
		{include file='inc/serverlist.tpl'}
	</div>

</div>	

{include file="inc/footer.tpl"}