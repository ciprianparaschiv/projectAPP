{include file="inc/top.tpl"}
{include file="inc/left.tpl"}
{include file="inc/jquery.tpl"}
<div class="content">

	<div class="titler">	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">	
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{if $competition}Edit{else}Add{/if} competition</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	 <form id="frm" name="frm" action="competitions/{if $competition}{$competition.slug}/edit/{else}add/{/if}" method="post">
	 {if $competition}<input type="hidden" name="cid" value="{$competition.id}">{/if}
	 <table class="two_options">
		<tr>
			<td class="t1">
				Name
			</td>
			<td class="t2">
				<input type="text" id="name" class="required" name="name" value="{$competition.name}" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Date Start
			</td>
			<td class="t2">
				<input type="text" id="start_date" class="required date-pick" name="start_date" value="{$competition.start_date|date_format:"%d-%m-%Y"}" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Active
			</td>
			<td class="t2">
				<input type="checkbox" id="active" name="active" {if $competition.active==1}checked{/if} value="1" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Description
			</td>
			<td class="t2">
				<textarea name="description" cols="80" rows="20">{$competition.description}</textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="t5" align="center">			
				<input type="submit" value="Save" class="buttoner">
			</td>
		</tr>
	 </table>
	 </form>

</div>
{include file="inc/footer.tpl"}