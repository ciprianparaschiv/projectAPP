{include file="inc/top.tpl"}
<div style='padding:10px'>

<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}projects/" >Projects List</a>
		</li>
		
		<li>
			<a title="Add Project" href="{$smarty.const.ROOT_HOST}projects/add/">Add Project</a>
		</li>	
		
		<li>
			<a title="User types" href="{$smarty.const.ROOT_HOST}projects/types/" id="activer">Project types</a>
		</li>	
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{$subtitle}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	<div class="left form" style="width:300px">
			 <form id="frm" name="frm" action="projects/types/" method="post">
	 {if $projecttype}<input type="hidden" name="ptid" value="{$projecttype.ptype_id}">{/if}
	 <table class="two_options">
		<tr>
			<td colspan="2" class="tH">
				<h3>{if $projecttype}Edit{else}Add{/if} Type</h3>
			</td>
		</tr>
		<tr>
			<td class="t1">
				Name
			</td>
			<td class="t2">
				<input type="text" id="ptype_name" class="texter required" name="ptype_name" value="{$projecttype.ptype_name}" />
			</td>
		</tr>	
		<tr>
			<td class="t1">
				Type
			</td>
			<td class="t2">
				<select id="ptype_rtype" name="ptype_rtype" class="texter required">
						<option value="">Please select</option>
						{foreach from=$PROJECT_TYPES item=item key=key}
							<option {if $projecttype.ptype_rtype==$key}selected{/if} value="{$key}">{$item.name}</option>
						{/foreach}
				</select>
				
			</td>
		</tr>
		<tr>
			<td class="t1">
				Work Type
			</td>
			<td class="t2">
				<select id="ptype_wtype" name="ptype_wtype" class="texter required">
						<option value="">Please select</option>
						{foreach from=$PROJECT_WTYPES item=item key=key}
							<option {if $projecttype.ptype_wtype==$key}selected{/if} value="{$key}">{$item}</option>
						{/foreach}
				</select>
				
			</td>
		</tr>		
		<tr>
			<td class="t1">
				Price
			</td>
			<td class="t2">
				<input type="text" id="ptype_price" class="required number texter" name="ptype_price" value="{$projecttype.ptype_price+0}" />
			</td>
		</tr>
		<tr>
			<td colspan="2" class="t5" align="center">			
				<input type="submit" value="{if $projecttype}Save{else}Add{/if}" class="buttoner"> <a href="{$smarty.const.ROOT_HOST}projects/types/" class="buttoner">Cancel</a>
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
					Name
				</td>
				<td>
					Type
				</td>
				<td>
					Work Type
				</td>
				<td>
					Price
				</td>
				<td width="100px">
					Action
				</td>
			</tr>
		</thead>
		<tbody>
		{foreach name="types" from=$projecttypes item=item key=key}
				<tr>
					<td>{$smarty.foreach.types.iteration}</td>
					<td>{$item.ptype_name}</td>
					{assign var=pttype value=$item.ptype_rtype}
					<td>{$PROJECT_TYPES.$pttype.name}</td>
					{assign var=pttype value=$item.ptype_wtype}
					<td>{$PROJECT_WTYPES.$pttype}</td>
					<td>{$item.ptype_price} $</td>
					<td><a href="{$smarty.const.ROOT_HOST}projects/types/edit/{$item.ptype_id}" class="editeaza">Edit</a> {if $item.cnt==0  }<a href="{$smarty.const.ROOT_HOST}projects/types/delete/{$item.ptype_id}" class="sterge">Delete</a>{/if}</td>
					
				</tr>
		{/foreach}
		</tbody>
	</table>

</div>	

{include file="inc/footer.tpl"}