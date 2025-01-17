{include file="inc/top.tpl"}
<div style='padding:10px'>
{assign var=base_url value=$smarty.const.ROOT_HOST|cat:"projects/"}
<div class="content">
	<div class="titler">

	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}projects/" id="activer" >Projects List</a>
		</li>

		<li>
			<a title="Add Project" href="{$smarty.const.ROOT_HOST}projects/add/">Add Project</a>
		</li>
		{if $auth.user_admin}
		<li>
			<a title="User types" href="{$smarty.const.ROOT_HOST}projects/types/" >Project types</a>
		</li>
		{/if}
	</ul>
	<h1 style="top:-25px;position:relative;float:left">{$subtitle}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	 <div class="filter">
		<form method="post">
		<fieldset>
			<legend>Filters</legend>

		<label for="filter_name">Name</label>
		<input name="filter[name]" id="filter_name" value="{$filter.name}"/>

		<label for="filter_client">Client</label>
		<select name="filter[client]" id="filter_client">
						<option value="">Any</option>
						{foreach from=$clients item=item key=key}
							<option {if $filter.client==$key}selected{/if} value="{$item.client_id}">{$item.client_name}</option>
						{/foreach}
		</select>
	   <label for="filter_status">Users</label>
		<select name="filter[projects_users]" id="filter_users">
						<option value="">Any</option>
						{foreach from=$users item=item key=key}
							<option {if $filter.projects_users==$key}selected{/if} value="{$key}">{$item.user_name}</option>
						{/foreach}
		</select>
		<label for="filter_status">Status</label>
		<select name="filter[status]" id="filter_status">
						<option value="">Any</option>
						{foreach from=$project_phases item=item key=key}
							<option {if $filter.status==$key}selected{/if} value="{$key}">{$item}</option>
						{/foreach}
		</select>
		{if $auth.user_admin}
		<label for="filter_paid">Paid</label>
		<select name="filter[paid]" id="filter_paid">
			<option {if !$filter.paid}selected{/if}value="">Any</option>
			<option {if $filter.paid=="0"}selected{/if} value="0">No</option>
			<option {if $filter.paid=="1"}selected{/if} value="1">YES</option>
		</select>
		{/if}
		<input type="submit" class="buttoner" name="submit" value="Filter"/>
		<input type="submit" class="buttoner" name="submit" value="Clear Filters" />
		</fieldset>
		</form>

	 </div>
		<table class="lister" style="">
		<thead>
			<tr class="head">
				<td width="20px">#
				</td>
				<td>
					Client
				</td>
				<td>
					Name
				</td>

				<td>
					Users
				</td>
				<td>
					Type
				</td>
				<td>
				Work Type
				</td>
				<td  align="center">
					Price
				</td>
				<td  align="center">
					<a href="{$base_url}?sort=project_status|{if $sort=='DESC'}ASC{else}DESC{/if}">
						Status
						{if $sort_name=='project_status'}<img src="images/icons/sort_{$sort}.gif">{/if}
					</a>
				</td>
				<td  align="center">
					Paid
				</td>
				<td align="center">
					<a href="{$base_url}?sort=project_date|{if $sort=='DESC'}ASC{else}DESC{/if}">Date
						{if $sort_name=='project_date'}<img src="images/icons/sort_{$sort}.gif">{/if}
					</a>
				</td>
				<td width="100px" align="center">
					Action
				</td>
			</tr>
		</thead>
		<tbody>
		{foreach name="types" from=$projects item=item key=key}
				{assign var=pttype value=$item.project_priority}
				<tr class="{if $item.project_status==3}complete{elseif $item.project_status==1}pending{else}{$project_priorities.$pttype|lower}{/if}"data-href="{$smarty.const.ROOT_HOST}project/{$item.project_id}">
					<td>{$smarty.foreach.types.iteration}</td>

					{assign var=pttype value=$item.project_client}
					<td>{$clients.$pttype.client_name}</td>
					<td><a href="{$smarty.const.ROOT_HOST}project/{$item.project_id}">{$item.project_name}{if $item.project_job} (Job: {$item.project_job}){/if}</a></td>
					<td>{$item.user.project_users|@join:"<br/>"}</td>
					{assign var=pttype value=$item.project_type}
					<td>{$projecttypes.$pttype.ptype_name}</td>
					<td>
					{if $item.ptype_wtype==1}
					SEO
					{/if}

					{if $item.ptype_wtype==2}
					WEB DESIGN
					{/if}

					{if $item.ptype_wtype==3}
					SOCIAL MEDIA
					{/if}

					{if $item.ptype_wtype==4}
					PPC
					{/if}

					{if $item.ptype_wtype==5}
					MARKETING
					{/if}

                                        {if $item.ptype_wtype==6}
					US
					{/if}



					{if $projecttypes.$pttype.ptype_wtype==1 && !$item.ptype_wtype}
					SEO
					{/if}

					{if $projecttypes.$pttype.ptype_wtype==2 && !$item.ptype_wtype}
					WEB DESIGN
					{/if}

					{if $projecttypes.$pttype.ptype_wtype==3 && !$item.ptype_wtype}
					SOCIAL MEDIA
					{/if}

					{if $projecttypes.$pttype.ptype_wtype==4 && !$item.ptype_wtype}
					PPC
					{/if}

					{if $projecttypes.$pttype.ptype_wtype==5 && !$item.ptype_wtype}
					MARKETING
					{/if}

                                        {if $projecttypes.$pttype.ptype_wtype==6 && !$item.ptype_wtype}
					US
					{/if}

					</td>
					<td>{if $auth.user_admin}{if $item.project_count>1}{$item.project_count}x{/if}{$item.project_price}${if $item.project_ishourly}/h{/if}{/if}</td>
					{assign var=pttype value=$item.project_status}
					<td align="center">{$project_phases.$pttype}</td>
					<td align="center">{if $auth.user_admin}{if $item.project_paid}Yes{else}No{/if}{/if}</td>
					<td align="center"> {$item.project_date|date_format}</td>
					<td align="center"><a href="{$smarty.const.ROOT_HOST}projects/edit/{$item.project_id}" class="editeaza">Edit</a>&nbsp; {if $auth.user_admin}<a href="{$smarty.const.ROOT_HOST}projects/delete/{$item.project_id}" class="sterge">Delete</a>{/if}</td>

				</tr>
		{/foreach}
		</tbody>
		<tfoot>
			<tr><td colspan="10">
			Page:
			{section name=pages start=1 loop=$page_count+1 step=1}
				{assign var=i value=$smarty.section.pages.index}
				<a {if $page==$i}class="cur" {/if} href="{$base_url}?page={$i}">{$i}</a>
			{/section}
			</td></tr>
		</tfoot>
	</table>

	</div>


{include file="inc/footer.tpl"}