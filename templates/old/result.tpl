{assign var=title value=$competition.name|cat:" - "|cat:$day.name}
{include file="inc/top.tpl"}
{include file="inc/left.tpl"}
<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
	<li>
	<a title="Scores" href="{$smarty.const.ROOT_HOST}competitions/{$competition.slug}/{$day.slug}/" id="activer" >Scores</a>
	</li>
	<li>
	<a title="Lastest results" href="{$smarty.const.ROOT_HOST}competitions/{$competition.slug}/{$day.slug}/results/"  >Last online results</a>
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
	 <p><b>Opened between</b> {$day.date|date_format:"%d-%m-%Y"} and {$day.date_end|date_format:"%d-%m-%Y"} 
	 <b>Task type:</b> {if $day.aat_time>0}AAT {$day.saat_time|date_format:"%Hh%Mm"}{else}Racing Task{/if} 
	 <b>Distance:</b> {if $day.aat_time>0}{$day.fpl.o->dmin/1000|round}/{$day.fpl.o->dmax/1000|round}/{/if}{$day.fpl.o->distance/1000|round}km
	 <b>Dificulty:</b> {$dificulties[$day.dificulty]}
	 <b>Plane class:</b> {$day.fpl.o->Plane.Class}
	 
	</p>
	<table class="lister">
		<thead>
		<tr>
			<td align="center">
				<img src="fpl/{$day.fpl.hash}.jpg" />
			</td>
		</tr>
		</thead>
	</table>

	<table width="80%" class="score lister">
		{if !$scores}
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
			<td>RN (CN)</td>
			<td>Plane</td>
			<td>Time</td>
			<td>Distance</td>
			<td>Speed</td>
			<td>Penalty</td>
			<td>Score</td>
			<td>Tries</td>
		</tr>
		</thead>
		
		<tbody>
			{assign var=i value=0}
			{assign var=lastscore value=-1}
			{foreach name=n from=$scores item=item key=key}
				{if $item.Score!=$lastscore}
					{assign var=i value=$i+1}
					{assign var=lastscore value=$item.Score}
				{/if}
			<tr class="normal">
			<td>{$i}</td>
			<td>{$item.Player}</td>
			<td>{$item.Rn} ({$item.Cn})</td>
			<td>{$item.Plane}</td>
			<td>{$item.Time}</td>
			<td align="right">{$item.Dist} km</td>
			<td align="right" >{$item.Speed} km/h</td>
			<td align="right">{$item.Penalty} p</td>
			<td align="right">{if $item.Status>2}*{/if}{$item.Score|round}</td>
			<td>{$item.Tries}</td>			
			</tr>
			{/foreach}

		</tbody>
		{/if}
	</table>
{literal}
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({appId: '144089738945054', status: true, cookie: true,
             xfbml: true});
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
      '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
</script>
<fb:comments xid="{/literal}{$day.id}{literal}" width="730"></fb:comments>

{/literal}
	
</div>	

{include file="inc/footer.tpl"}