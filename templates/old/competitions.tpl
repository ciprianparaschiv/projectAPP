{assign var=title value="Competitions"}
{include file="inc/top.tpl"}
{include file="inc/left.tpl"}

<div class="content">
	{foreach from=$competitions item=item key=key}
	<div class="titler">	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">	
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{$item.name}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	 <p>
		{$item.description}
	</p>
	<br />
	 {/foreach}
</div>
{include file="inc/footer.tpl"}