{include file="inc/top.tpl"}
<div style='padding:10px'>

<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}clients/" >Clients</a>
		</li>
		<li>
			<a title="Subcontractors" href="{$smarty.const.ROOT_HOST}clients/contractors/" id="activer">Subcontractors</a>
		</li>	
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{$subtitle}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	<div class="left form" style="width:300px">
			 <form id="frm" name="frm" action="clients/contractors/" method="post">
	 {if $contractor}<input type="hidden" name="cid" value="{$contractor.contractor_id}">{/if}
	 <table class="two_options">
		<tr>
			<td colspan="2" class="tH">
				<h3>{if $contractor}Edit{else}Add{/if} Subcontractor</h3>
			</td>
		</tr>
		<tr>
			<td class="t1">
				Name
			</td>
			<td class="t2">
				<input type="text" id="contractor_name" class="texter required" name="contractor_name" value="{$contractor.contractor_name}" />
			</td>
		</tr>	
		<tr>
			<td class="t1">
				Email
			</td>
			<td class="t2">
				<input type="text" id="contractor_email" class="texter email required" name="contractor_email" value="{$contractor.contractor_email}" />
			</td>
		</tr>		
		<tr>
			<td class="t1">
				Website
			</td>
			<td class="t2">
				<input type="text" id="contractor_url" class="texter url required" name="contractor_url" value="{$contractor.contractor_url}" />
			</td>
		</tr>		
		<tr>
			<td colspan="2" class="t5" align="center">			
				<input type="submit" value="{if $contractor}Save{else}Add{/if}" class="buttoner"> <a href="{$smarty.const.ROOT_HOST}clients/contractors/" class="buttoner">Cancel</a>
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
					Subcontractor
				</td>
				<td width="100px">
					Action
				</td>
			</tr>
		</thead>
		<tbody>
		{foreach name="types" from=$contractors item=item key=key}
				<tr>
					<td>{$smarty.foreach.types.iteration}</td>
					<td>{$item.contractor_name}</td>
					<td><a href="{$smarty.const.ROOT_HOST}clients/contractors/edit/{$item.contractor_id}" class="editeaza">Edit</a> {if $item.cnt==0  }<a href="{$smarty.const.ROOT_HOST}clients/contractors/delete/{$item.contractor_id}" class="sterge">Delete</a>{/if}</td>
					
				</tr>
		{/foreach}
		</tbody>
	</table>

</div>	

{include file="inc/footer.tpl"}