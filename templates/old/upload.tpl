{assign var=title value=$competition.name|cat:" - "|cat:$day.name|cat:" - Upload FTR"}
{include file="inc/top.tpl"}
{include file="inc/left.tpl"}
{include file="inc/jquery.tpl"}
<div class="content">

	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
	<li>
	<a title="Scores" href="{$smarty.const.ROOT_HOST}competitions/{$competition.slug}/{$day.slug}/" >Scores</a>

	</li>
	<li>
	<a title="Lastest results" href="{$smarty.const.ROOT_HOST}competitions/{$competition.slug}/{$day.slug}/results/"   >Last online results</a>
	</li>
	{if ($day.date<$smarty.now) && ($day.date_end > $smarty.now)}
	<li>
	<a title="Lastest results" href="{$smarty.const.ROOT_HOST}competitions/{$competition.slug}/{$day.slug}/upload/"  id="activer">Upload FTR</a>
	</li>
	{/if}
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{$competition.name} - {$day.name}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	 <p>Use this for only if you got disconnected durring the race (or the task is AAT), the file will be accepted only after the race end</p>
	 <form id="frm" name="frm" action="competitions/{$competition.slug}/{$day.slug}/upload/" method="post"  enctype='multipart/form-data'>
	 {if $competition}<input type="hidden" name="cid" value="{$competition.id}">{/if}
	 {if $day}<input type="hidden" name="did" value="{$day.id}">{/if}
	 {if $message}<div class="solid-error">{$message}</div>{/if}
	 <table class="two_options" width="100%">
		<tr>
			<td class="t1">
				Upload FTR
			</td>
			<td class="t2">
				<input type="file" id="ftr" name="ftr" class="required" />
			</td>
		</tr>
		<tr>
			<td colspan=2>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" class="t5" align="center">			
				<input type="submit" value="Send" class="buttoner">
			</td>
		</tr>
	 </table>
	 </form>

</div>
{include file="inc/footer.tpl"}