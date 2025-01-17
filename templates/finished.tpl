{include file="inc/top.tpl"}
<div style='padding:10px'>

<div class="content">
	<div class="titler">

	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
		{if $auth.user_admin>0}
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}" >Dashboard</a>
		</li>
		<li>
			<a title="" href="{$smarty.const.ROOT_HOST}finished/"  id="activer" >Finished projects</a>
		</li>
		{/if}
	</ul>
	<h1 style="top:-25px;position:relative;float:left">Finished projects</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	 <div class="project_dashboard">

	<fieldset>
		<legend>

		</legend>
		{assign var='date' value=''}
		{foreach from=$messages item=item key=key}
			{assign var=newdate value=$item.project_cdate|date_format}
			{if $newdate!=$date}
				<span>{$newdate}</span>
				{assign var=date value=$newdate}
			{/if}
{if $item.project_users_responsable!=0}
{if $item.project_sent==1}
			<div class="notice" style="background-color: #e7ecd9;">
					{$item.project_cdate|date_format:"%H:%M"} &rarr; <strong><a href="{$smarty.const.ROOT_HOST}project/{$item.project_id}">{$item.client_name} &rarr; {$item.project_name}     &rarr;      <span id="messages_finished">{$item.user_name}  sent it to the client</span></a></strong>
			</div>
{else}
			<div class="notice"   style="background-color: {$item.colour};">
					{$item.project_cdate|date_format:"%H:%M"} &rarr; <strong><a href="{$smarty.const.ROOT_HOST}project/{$item.project_id}">{$item.client_name} &rarr; {$item.project_name}     &rarr;      <span id="messages_finished">{$item.user_name} is responsible of this project</span></a></strong>
			</div>
{/if}
{else}
{if $item.project_sent==1}
			<div class="notice" >
					{$item.project_cdate|date_format:"%H:%M"} &rarr; <strong><a href="{$smarty.const.ROOT_HOST}project/{$item.project_id}">{$item.client_name} &rarr; {$item.project_name}     </a></strong>
			</div>
{else}
			<div class="notice"  >
					{$item.project_cdate|date_format:"%H:%M"} &rarr; <strong><a href="{$smarty.const.ROOT_HOST}project/{$item.project_id}">{$item.client_name} &rarr; {$item.project_name}    </a></strong>
			</div>
{/if}
{/if}



		{/foreach}
	</fieldset>
	</div>

</div>

{include file="inc/footer.tpl"}
