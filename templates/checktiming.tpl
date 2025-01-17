{include file="inc/top.tpl"}
<div style='padding:10px'>

<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">	
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">Check your timing</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	 <div class="filter">


	<fieldset>
		<legend>
			<b>Since last update your '{$tworking.project_name}' project had timed ({$tworking.delta|date_format:"%H:%M"}) what do you want to do?</b>
		</legend>
		<form method="post">
			<br />
			<input type="submit" name="efective" class="buttoner" value="close project with last saved time ({$tworking.efective|date_format:"%H:%M"})" />
			<input type="submit" name="full" class="buttoner" value="close with current time ({$tworking.full|date_format:"%H:%M"})" />
			<input type="submit" name="continue" class="buttoner" value=" continue " />
			<br />
			<br />
		 </form>
	</fieldset>
	</div>

</div>	

{include file="inc/footer.tpl"}