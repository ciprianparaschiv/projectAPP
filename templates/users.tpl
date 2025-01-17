{include file="inc/top.tpl"}
<div style='padding:10px'>

<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}users/" id="activer" >User List</a>
		</li>
		{*<li>
			<a title="Add user" href="{$smarty.const.ROOT_HOST}users/add/">Add user</a>
		</li>	
		*}
		<li>
			<a title="User types" href="{$smarty.const.ROOT_HOST}users/types/">User types</a>
		</li>	
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{$subtitle}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	
	<div class="form left" style="width:300px">
	<form id="frm" name="frm" action="users/edit/" method="post">
	 {if $user}<input type="hidden" name="uid" value="{$user.user_id}">{/if}
	 <table class="two_options">
		<tr>
			<td colspan="2" class="tH">
				<h3>{if $user}Edit{else}Add{/if} User</h3>
			</td>
		</tr>
		<tr>
			<td class="t1">
				Name
			</td>
			<td class="t2">
				<input type="text" id="user_name" class="texter required" name="user_name" value="{$user.user_name}" />
			</td>
		</tr>	
		<tr>
			<td class="t1">
				Email
			</td>
			<td class="t2">
				<input type="text" id="user_email" class="texter required email" name="user_email" value="{$user.user_email}" />
			</td>
		</tr>	
		<tr>
			<td class="t1">
				Password
			</td>
			<td class="t2">
				<input type="password" id="user_password" class="texter" name="user_password" value="" />
			</td>
		</tr>	
		<tr>
			<td class="t1">
				Position
			</td>
			<td class="t2">
				<select class="texter required" name="user_type" id="user_type">
					<option value="">Select</option>
						{foreach from=$usertypes item=item key=key}
							<option {if $user.user_type==$key}selected{/if} value="{$item.usertype_id}">{$item.usertype_name}</option>
						{/foreach}
				</select>				
			</td>
		</tr>
		 <tr>
			<td class="t1">
				Procent Harvest
			</td>
			<td class="t2">
				<input type="text" id="procent_harvest" class="texter " name="procent_harvest" value="{$user.procent_harvest}" />			
			</td>
		</tr>
		<tr>
			<td class="t1">
				Is Admin
			</td>
			<td class="t2">
				<input type="checkbox" id="user_admin" class="texter" name="user_admin" value="1" {if $user.user_admin==1}checked="checked"{/if} />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Is SubAdmin
			</td>
			<td class="t2">
				<input type="checkbox" id="user_subadmin" class="texter" name="user_subadmin" value="1" {if $user.user_subadmin==1}checked="checked"{/if} />
			</td>
		</tr>			
		<tr>
			<td class="t1">
				Active
			</td>
			<td class="t2">
				<input type="checkbox" id="user_active" class="texter" name="user_active" value="1" {if $user.user_active==1}checked="checked"{/if} />
			</td>
		</tr>
		<tr>
			<td colspan="2" class="t5" align="center">			
				<input type="submit" value="{if $user}Save{else}Add{/if}" class="buttoner"> <a href="{$smarty.const.ROOT_HOST}users/" class="buttoner">Cancel</a>
			</td>
		</tr>
	 </table>
	 </form>
	</div>
	<div class="user-list">
	{foreach from=$users item=item key=key}
		<div class="user">
			<img src='images/icons/{if $item.user_admin}administrator{elseif $item.user_subadmin}subadmin{else}user{/if}.png' class="thumb" />
			
			<span class="name">{$item.user_name} ({$item.usertype_name})</span><br />
			<a href="mailto:{$item.user_email}">{$item.user_email}</a>
			<div class="buttons">
				<a href="{$smarty.const.ROOT_HOST}users/edit/{$item.user_id}"><img src="images/icons/editeaza.gif"></a> 
				<a href="{$smarty.const.ROOT_HOST}users/delete/{$item.user_id}"><img src="images/icons/sterge.gif"></a> 
				<a href="{$smarty.const.ROOT_HOST}users/switch/{$item.user_id}"><img src="images/icons/{if $item.user_active==1}activ{else}inactiv{/if}.gif"></a>
			</div>
		</div>
	{/foreach}
	</div>

</div>	

{include file="inc/footer.tpl"}