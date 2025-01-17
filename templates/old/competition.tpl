{assign var=title value=$competition.name}
{include file="inc/top.tpl"}
{include file="inc/left.tpl"}

<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">	
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{$competition.name}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	 <p>
	 {$competition.description}
	 </p>
	 <br />
	 	<table width="80%" class="score lister">
		{if !$results}
		<thead>
			<tr class="head">
			<td align="center">
				No results
			</td>
			</tr>
		</thead>
		{else}
		<thead>
		<tr class="head">
			<td>#</td>
			<td>Name</td>
			<td  width="100">RN (CN)</td>			
			<td align="right"  width="50">Penalty</td>
			<td align="right"  width="50">Score</td>
			<td align="right" width="50">Races</td>
		</tr>
		</thead>
		
		<tbody>
					{assign var=i value=0}
					{assign var=lastscore value=-1}
			{foreach name=n from=$results item=item key=key}
				{if $item.Score!=$lastscore}
					{assign var=i value=$i+1}
					{assign var=lastscore value=$item.Score}
				{/if}
			<tr class="normal">
			<td>{$i}</td>
			<td>{$item.Player}</td>
			<td>{$item.Rn} ({$item.Cn})</td>			
			<td align="right">{$item.Penalty} p</td>
			<td align="right">{$item.Score|round} p</td>
			<td align="right">{if $total!=$numcount}{$item.num}/{$numcount}/{$total}{else}{$item.Races}/{$total}{/if}</td>			
			</tr>
			{/foreach}

		</tbody>
		{/if}
	</table>
	 
</div>
{include file="inc/footer.tpl"}