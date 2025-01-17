{include file="inc/top.tpl"}
<div style='padding:10px'>

<div class="content">
	<div class="titler">

	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
		{if $auth.user_admin>0 || $auth.user_subadmin>0}
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}"  id="activer">Dashboard</a>
		</li>
		<li>
			<a title="" href="{$smarty.const.ROOT_HOST}finished/">Finished projects</a>
		</li>
		{/if}
	</ul>
	<h1 style="top:-25px;position:relative;float:left">Dashboard</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	 <div class="project_dashboard">
	<fieldset>
		<legend>
			Your high priority projects:
		</legend>
		{foreach from=$projects item=item key=key}
			<div class="notice">

				<strong><a href="{$smarty.const.ROOT_HOST}/project/{$item.project_id}">{$item.project_name}</a> ({$item.ptype_name})</strong>

			</div>
		{/foreach}
	</fieldset>

	<fieldset>
		<legend>
			Latest messages concerning your projects
		</legend>
		{assign var='date' value=''}
		{foreach from=$messages item=item key=key}
			{assign var=newdate value=$item.message_time|date_format}
			{if $newdate!=$date}
				<span>{$newdate}</span>
				{assign var=date value=$newdate}
			{/if}
			<div class="notice {if $item.message_file}attachment{/if}">
				{if $item.message_type==1}
					{$item.message_time|date_format:"%H:%M"} &rarr; <strong>{$item.user_name}</strong> commented on <strong><a href="{$smarty.const.ROOT_HOST}project/{$item.project_id}">{$item.project_name}</a></strong>
				{else}
					{$item.message_time|date_format:"%H:%M"} &rarr; <strong>{$item.user_name}</strong> on <strong><a href="{$smarty.const.ROOT_HOST}project/{$item.project_id}">{$item.project_name}</a></strong>: {$item.message_text}
				{/if}
			</div>
		{/foreach}
	</fieldset>
	</div>

</div>

{include file="inc/footer.tpl"}
