{assign var=title value=$competition.name|cat:" - "|cat:$day.name|cat:" - Last results"}
{include file="inc/top.tpl"}
{include file="inc/left.tpl"}
<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
	<li>
	<a title="Scores" href="{$smarty.const.ROOT_HOST}competitions/{$competition.slug}/{$day.slug}/" >Scores</a>

	</li>
	<li>
	<a title="Lastest results" href="{$smarty.const.ROOT_HOST}competitions/{$competition.slug}/{$day.slug}/results/" id="activer"  >Last online results</a>
	</li>
	{if ($day.date<$smarty.now) && ($day.date_end > $smarty.now)}
	<li>
	<a title="Lastest results" href="{$smarty.const.ROOT_HOST}competitions/{$competition.slug}/{$day.slug}/upload/"  >Upload FTR</a>
	</li>
	{/if}
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{$competition.name} - {$day.name}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />

	 {if !$results}
		<table width="80%" class="score lister">
		<thead>
			<tr class="head">
			<td align="center">
				No results
			</td>
			</tr>
		</thead>
		</table>
		{else}
	{assign var=lastrace value=-1}
	{foreach from=$results item=item key=key} 
	{if $item.race_id !=$lastrace}
		{assign var=lastrace value=$item.race_id}
		{if $lastrace!=-1}
					</tbody>		
			</table>
		{/if}
			{assign var=i value=0}
			<table width="80%" class="score lister">		
				
				<thead>		
				<tr class="head">
					<td colspan="10" style="width:200px">
					Date: {$item.date|date_format:"%d-%m-%Y"}
					</td>
				</tr>
				<tr class="head">
					<td>#</td>
					<td>Name</td>
					<td>RN (CN)</td>
					<td>Plane</td>
					<td>Time</td>
					<td>Distance</td>
					<td>Speed</td>
					<td>Penalty</td>
					<td>Score</td>	
					<td>Status</td>						
				</tr>
				</thead>		
				<tbody>
	{/if}

			
			{assign var=i value=$i+1}
			<tr class="normal">
			<td>{$i}</td>
			<td width="150">{$item.Player}</td>
			<td width="90">{$item.Rn} ({$item.Cn})</td>
			<td width="80">{$item.Plane}</td>
			<td>{$item.Time}</td>
			<td align="right">{$item.Dist} km</td>
			<td align="right" >{$item.Speed} km/h</td>
			<td align="right">{$item.Penalty} p</td>
			<td align="right">{$item.Score|round}</td>
			<td align="right">{if $item.ftrhash}<a target="top" href="iftr/{$item.ftrhash}.jpg">{/if}{$statuses[$item.Status]}{if $item.ftrhash}</a>{/if}</td>			
			</tr>			
	{/foreach}
	</tbody>		
	</table>
	{/if}
</div>	

{include file="inc/footer.tpl"}