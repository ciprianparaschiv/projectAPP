{include file="inc/top.tpl"}
{include file="inc/left.tpl"}
{include file="inc/jquery.tpl"}
<div class="content">

	<div class="titler">	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">	
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{if $day}Edit{else}Add{/if} day</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	 <form id="frm" name="frm" action="competitions/{$competition.slug}/{if $day}{$day.slug}/edit/{else}add/{/if}" method="post"  enctype='multipart/form-data'>
	 {if $competition}<input type="hidden" name="cid" value="{$competition.id}">{/if}
	 {if $day}<input type="hidden" name="did" value="{$day.id}">{/if}
	 <table class="two_options">
		<tr>
			<td class="t1">
				Name
			</td>
			<td class="t2">
				<input type="text" id="name" class="required" name="name" value="{$day.name}" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Date Start
			</td>
			<td class="t2">
				<input type="text" id="date" class="required date-pick" name="date" value="{$day.date|date_format:"%d-%m-%Y"}" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Date Start
			</td>
			<td class="t2">
				<input type="text" id="date_end" class="required date-pick" name="date_end" value="{$day.date_end|date_format:"%d-%m-%Y"}" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Score result
			</td>
			<td class="t2">
				<input type="checkbox" id="score_result" name="score_result" {if $day.score_result==1}checked{/if} value="1" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Don't Need ftr
			</td>
			<td class="t2">
				<input type="checkbox" id="count_score" name="count_score" {if $day.count_score==1}checked{/if} value="1" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Upload FPL
			</td>
			<td class="t2">
				<input type="file" id="fpl" name="fpl" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Dificulty
			</td>
			<td class="t2">
				<select name="dificulty">
					{foreach from=$dificulties item=item key=key}
						<option value='{$key}' {if $day.dificulty==$key}selected="selected"{/if}>{$item}</option>
					{/foreach}
				</select>
				
			</td>
		</tr>		
		<tr>
			<td class="t1">
				AAT time (let empty/0 if racing task)
			</td>
			<td class="t2">
				<input type="text" id="aat_time" name="aat_time" value="{$day.aat_time}" class="number"/>
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