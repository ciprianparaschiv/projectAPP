{include file="inc/top.tpl"}
<div style='padding:10px'>

<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}clients/" id="activer" >Clients</a>
		</li>
		<li>
			<a title="Subcontractors" href="{$smarty.const.ROOT_HOST}clients/contractors/" >Subcontractors</a>
		</li>	
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{$subtitle}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	<div class="left form" style="width:500px">
	<form id="frm" name="frm" action="clients/" method="post">
	 {if $client}<input type="hidden" name="cid" value="{$client.client_id}">{/if}
	 <table class="two_options">
		<tr>
			<td colspan="2" class="tH">
				<h3>{if $client}Edit{else}Add{/if} Client</h3>
			</td>
		</tr>
		<tr>
			<td class="t1">
				Contractor
			</td>
			<td class="t2">
				<select id="client_contractor" class="texter required" name="client_contractor">
					<option value="">Please Select</option>
					{foreach from=$contractors item=item key=key} 
						<option {if $client.client_contractor==$key}selected{/if} value="{$key}">{$item.contractor_name}</option>
					{/foreach}
				</select>
			</td>
		</tr>		
		 <tr>
			<td class="t1">
				Client Harvest
			</td>
			<td class="t2">
				<select id="client_harvest" class="texter " name="client_harvest">
					<option value="">Please Select</option>
						{foreach from=$clients_harvest item=item key=key}
							<option {if $client.client_harvest==$item.project_harvest_id}selected{/if} value="{$item.project_harvest_id}">{$item.project_harvest_name}</option>
						{/foreach}
				</select>
			</td>
		</tr>	
		<tr>
			<td class="t1">
				Name
			</td>
			<td class="t2">
				<input type="text" id="client_name" class="texter required" name="client_name" value="{$client.client_name}" />
			</td>
		</tr>	
		<tr>
			<td class="t1">
				Website
			</td>
			<td class="t2">
				<input type="text" id="client_url" class="texter url required" name="client_url" value="{$client.client_url}" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Reporting
			</td>
			<td class="t2">
				<input type="checkbox" id="client_reporting" class="texter" name="client_reporting"  {if $client.client_reporting==1}checked{/if}  value="1" />
			</td>
		</tr>
		<tr>
			<td colspan="2" class="t5" align="center">			
				<input type="submit" value="{if $client}Save{else}Add{/if}" class="buttoner"> <a href="{$smarty.const.ROOT_HOST}clients/" class="buttoner">Cancel</a>
			</td>
		</tr>
	 </table>
	 </form>
	</div>
	<table class="lister" style="width:600px">	
		<thead>
			<tr class="head">
				<td width="20px">#
				</td>
				<td>
					Client
				</td>
				<td>
					Client Harvest
				</td>
				<td>
					Website
				</td>
					<td>
					Reporting
				</td>
				<td width="100px">
					Action
				</td>
			</tr>
		</thead>
		<tbody>
		{assign var="lastcontractor" value=-1}
		{foreach name="types" from=$clients item=item key=key}
				{if $item.client_contractor!=$lastcontractor}
					{assign var="lastcontractor" value=$item.client_contractor}
					<tr>
						<td colspan="4">
							{$contractors.$lastcontractor.contractor_name}
						</td>
					</tr>
				
				{/if}
				<tr>
					<td>{$smarty.foreach.types.iteration}</td>
					<td>{$item.client_name}</td>


					{foreach  from=$clients_harvest item=items key=keys}
					{if $items.project_harvest_id==$item.client_harvest}
					<td>{$items.project_harvest_name} - {$items.client_harvest_name}</td>
					
					{/if}
					{/foreach}
					
					{if $item.client_harvest==0} <td>-</td>{/if}
					
					<td>{$item.client_url}</td>
					<td>{if $item.client_reporting==1  }Yes{else}No{/if}</td>
					<td><a href="{$smarty.const.ROOT_HOST}clients/edit/{$item.client_id}" class="editeaza">Edit</a> {if $item.cnt==0  }<a href="{$smarty.const.ROOT_HOST}clients/delete/{$item.client_id}" class="sterge">Delete</a>{/if}</td>
					
				</tr>
		{/foreach}
		</tbody>
	</table>

</div>	

{include file="inc/footer.tpl"}