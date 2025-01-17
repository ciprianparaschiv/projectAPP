{include file="inc/header.tpl"}
<body>
<div id="container">
<div id="header" style=''>

</div>
<div class="up_info">&nbsp;
	<h1>
	OfficialBranding Project Management
	</h1>
	
	<div id="working" {if !$working} style='display:none'{/if}>
			{include file="inc/working.tpl"}
	</div>
	
	
	<div class="right_info">
		<span class="time_today">Time worked today: {$time_today} </span>
		<a href="{$smarty.const.ROOT_HOST}account/">My Account</a> <a href="{$smarty.const.ROOT_HOST}logout/">Logout</a>
		
	</div>
</div>
<ul id="nav">
<li><a href="{$smarty.const.ROOT_HOST}" {if !$active}id="active"{/if} title="Dashboard" >Dashboard</a></li>
<li><a href="{$smarty.const.ROOT_HOST}myprojects/" title="My Projects" {if $active=='myprojects'}id="active"{/if}>My Projects</a></li>
{if $smarty.session.auth.user_admin || $smarty.session.auth.user_subadmin}
<li><a href="{$smarty.const.ROOT_HOST}projects/" title="Projects" {if $active=='projects'}id="active"{/if}>Projects</a></li>
<li><a href="{$smarty.const.ROOT_HOST}clients/" title="Clients" {if $active=='clients'}id="active"{/if}>Clients</a></li>
{/if}
{if $smarty.session.auth.user_admin}
<li><a href="{$smarty.const.ROOT_HOST}users/" title="Users" {if $active=='users'}id="active"{/if}>Users</a></li>
<li><a href="{$smarty.const.ROOT_HOST}reports/" title="Reports" {if $active=='reports'}id="active"{/if}>Reports</a></li>
{/if}
</ul>
<div class="clear"></div>