{include file="inc/top.tpl"}
<div style='padding:10px'>
{assign var=base_url value=$smarty.const.ROOT_HOST|cat:"myprojects/"}
<script type="text/javascript">
	setTimeout("window.location.reload()",300000);
</script>
<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}pmyrojects/" id="activer" >Projects List</a>
		</li>
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
		
		<label for="filter_status">Status</label>
		<select name="filter[status]" id="filter_status">
						<option value="">Any</option>
						{foreach from=$project_phases item=item key=key}
							<option {if $filter.status==$key}selected{/if} value="{$key}">{$item}</option>
						{/foreach}
		</select>
	
		<label for="filter_paid">Priority</label>
		<select name="filter[priority]" id="filter_priority">
						<option value="">Any</option>
						{foreach from=$project_priorities item=item key=key}
							<option {if $filter.priority==$key}selected{/if} value="{$key}">{$item}</option>
						{/foreach}
		</select>
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
					Type
				</td>
				<td  align="center">
					<a href="{$base_url}?sort=project_status|{if $sort=='DESC'}ASC{else}DESC{/if}">
						Status
						{if $sort_name=='project_status'}<img src="images/icons/sort_{$sort}.gif">{/if}
					</a>
				</td>
				<td  align="center">
					<a href="{$base_url}?sort=project_priority|{if $sort=='DESC'}ASC{else}DESC{/if}">
						Priority 
						{if $sort_name=='project_priority'}<img src="images/icons/sort_{$sort}.gif">{/if}
					</a>
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
				
				<tr class="{if $item.project_status==3}complete{elseif $item.project_status==1}pending{else}{$project_priorities.$pttype|lower}{/if} "  data-href="{$smarty.const.ROOT_HOST}project/{$item.project_id}">    
    <td>{$smarty.foreach.types.iteration}</td>     
     {assign var=pttype value=$item.project_client}
     <td>{$clients.$pttype.client_name}</td>     
     <td><a href="{$smarty.const.ROOT_HOST}project/{$item.project_id}">{$item.project_name}</a></td>
     {assign var=pttype value=$item.project_type}
     <td>{$projecttypes.$pttype.ptype_name}</td>
     {assign var=pttype value=$item.project_status}
     <td align="center">{$project_phases.$pttype}</td>
     {assign var=pttype value=$item.project_priority}
     <td align="center">{$project_priorities.$pttype}</td>
     <td align="center"> {$item.project_date|date_format}</td>
     <td align="center"></td>
     
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