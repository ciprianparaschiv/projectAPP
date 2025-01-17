
<div id="left" class="column">
	<ul id="submenu">
	{foreach from=$competitions item=item key=key}
	<li><a href="competitions/{$item.slug}/" title="{$item.name}" >{$item.name}</a>
		<ul class="submenu">
		{foreach from=$item.days item=ditem key=dkey}		
			<li><a href="competitions/{$item.slug}/{$ditem.slug}/" title="{$ditem.name}" {if ($ditem.date<$smarty.now) && ($ditem.date_end > $smarty.now)}class="active"{/if} >{$ditem.name}</a></li>	
		{/foreach}
		</ul> 
	</li>
	{/foreach}	
	<li><a href="" title="Archives" >Archives</a></li>
	</ul> 
</div>
<div id="center" class="column">
