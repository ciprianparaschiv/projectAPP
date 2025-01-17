{include file="inc/header.tpl"}
<body>
<div id="container">
<div id="header" style=''>

</div>
<div class="up_info">&nbsp;
	<h1>
	OBProject
	</h1>
	<div class="right_info">		
		
	</div>
</div>
<div style='padding:10px'>

<div class="content" style='margin:auto'>

<div class="loger">
	<div class="padder">
	<h1><img src="images/icons/user_big.gif" alt="" align="absmiddle" height="22" width="22">OBProject Login</h1>
	<p>&nbsp;</p>
	{if $message}<div class="solid-error">{$message}</div>{/if}
	<form id="frm" method="post">
	<p>
	<label>Email<br>
	<input gtbfieldid="1" name="email" class="texter2 required" type="text">
	</label>
	</p>
	<p>
	<label>Password <br>
	<input name="password" class="texter2 required" type="password">
	</label>
	</p>
	<p>	
	<input name="button" class="buttoner" id="button" value="Login" type="submit">
	</p>
	</form>
	</div>
</div>
</div>

{include file="inc/footer.tpl"}