{include file="inc/top.tpl"}
<div style='padding:10px'>
<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">Modify your account</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	 <div class="project_dashboard">
		<fieldset>
			<legend>Your info</legend>
			<form id="frm" name="frm" action="account/" method="post" enctype="multipart/form-data">
	 
	 <table class="two_options" style="width:400px">
						
		<tr>
			<td class="t1">
				Name
			</td>
			<td class="t2">
				<input type="text" id="user_name" class="texter required" name="user_name" value="{$auth.user_name}" />
			</td>
		</tr>		
		<tr>
			<td class="t1">
				Email
			</td>
			<td class="t2">
				<input type="text" id="user_email" class="texter required email" name="user_email" value="{$auth.user_email}" />
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
				Repeat Password
			</td>
			<td class="t2">
				<input type="password" id="user_password2" class="texter" name="user_password2" value="" />
			</td>
		</tr>		
		<tr>
			<td colspan="2" class="t5" align="center">			
				<input type="submit" value="Save" class="buttoner"> <a href="{$smarty.const.ROOT_HOST}" class="buttoner">Cancel</a>
			</td>
		</tr>
	 </table>
	 </form>
		</fieldset>
	</div>
	 
	
</div>

{include file="inc/footer.tpl"}