{include file="inc/top.tpl"}
<div style='padding:10px'>

<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}users/" >User List</a>
		</li>
		{*
		<li>
			<a title="Add user" href="{$smarty.const.ROOT_HOST}users/add/">Add user</a>
		</li>	
		*}
		<li>
			<a title="User types" href="{$smarty.const.ROOT_HOST}users/types/" id="activer">User types</a>
		</li>	
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{$subtitle}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	<div class="left form" style="width:300px">
			 <form id="frm" name="frm" action="users/types/" method="post">
	 {if $usertype}<input type="hidden" name="utid" value="{$usertype.usertype_id}">{/if}
	 <table class="two_options">
		<tr>
			<td colspan="2" class="tH">
				<h3>{if $usertype}Edit{else}Add{/if} Position</h3>
			</td>
		</tr>
		<tr>
			<td class="t1">
				Position
			</td>
			<td class="t2">
				<input type="text" id="name" class="required" name="name" value="{$usertype.usertype_name}" />
			</td>
		</tr>	
		<tr>
			<td colspan="2" class="t5" align="center">			
				<input type="submit" value="{if $usertype}Save{else}Add{/if}" class="buttoner"> <a href="{$smarty.const.ROOT_HOST}users/types/" class="buttoner">Cancel</a>
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
					Position
				</td>
				<td width="100px">
					Action
				</td>
			</tr>
		</thead>
		<tbody>
		{foreach name="types" from=$usertypes item=item key=key}
				<tr>
					<td>{$smarty.foreach.types.iteration}</td>
					<td>{$item.usertype_name}</td>
					<td><a href="{$smarty.const.ROOT_HOST}users/types/edit/{$item.usertype_id}" class="editeaza">Edit</a> {if $item.cnt==0  }<a href="{$smarty.const.ROOT_HOST}users/types/delete/{$item.usertype_id}" class="sterge">Delete</a>{/if}</td>
					
				</tr>
		{/foreach}
		</tbody>
	</table>

</div>	

{include file="inc/footer.tpl"}