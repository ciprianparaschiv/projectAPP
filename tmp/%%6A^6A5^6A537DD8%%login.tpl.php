<?php /* Smarty version 2.6.12, created on 2023-02-20 10:38:28
         compiled from login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
<?php if ($this->_tpl_vars['message']): ?><div class="solid-error"><?php echo $this->_tpl_vars['message']; ?>
</div><?php endif; ?>
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>