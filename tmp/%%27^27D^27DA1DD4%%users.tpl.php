<?php /* Smarty version 2.6.12, created on 2023-03-01 09:02:25
         compiled from users.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='padding:10px'>
<div class="content">
<div class="titler">
<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
users/" id="activer" >User List</a>
</li>
<li>
<a title="User types" href="<?php echo @ROOT_HOST; ?>
users/types/">User types</a>
</li>	
</ul>	
<h1 style="top:-25px;position:relative;float:left"><?php echo $this->_tpl_vars['subtitle']; ?>
</h1>
</div>
<div class="clear"> </div>
<br />
<div class="form left" style="width:300px">
<form id="frm" name="frm" action="users/edit/" method="post">
<?php if ($this->_tpl_vars['user']): ?><input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['user']['user_id']; ?>
"><?php endif; ?>
<table class="two_options">
<tr>
<td colspan="2" class="tH">
<h3><?php if ($this->_tpl_vars['user']): ?>Edit<?php else: ?>Add<?php endif; ?> User</h3>
</td>
</tr>
<tr>
<td class="t1">
Name
</td>
<td class="t2">
<input type="text" id="user_name" class="texter required" name="user_name" value="<?php echo $this->_tpl_vars['user']['user_name']; ?>
" />
</td>
</tr>	
<tr>
<td class="t1">
Email
</td>
<td class="t2">
<input type="text" id="user_email" class="texter required email" name="user_email" value="<?php echo $this->_tpl_vars['user']['user_email']; ?>
" />
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
<?php $_from = $this->_tpl_vars['usertypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['user']['user_type'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['usertype_id']; ?>
"><?php echo $this->_tpl_vars['item']['usertype_name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>				
</td>
</tr>
<tr>
<td class="t1">
Procent Harvest
</td>
<td class="t2">
<input type="text" id="procent_harvest" class="texter " name="procent_harvest" value="<?php echo $this->_tpl_vars['user']['procent_harvest']; ?>
" />			
</td>
</tr>
<tr>
<td class="t1">
Is Admin
</td>
<td class="t2">
<input type="checkbox" id="user_admin" class="texter" name="user_admin" value="1" <?php if ($this->_tpl_vars['user']['user_admin'] == 1): ?>checked="checked"<?php endif; ?> />
</td>
</tr>
<tr>
<td class="t1">
Is SubAdmin
</td>
<td class="t2">
<input type="checkbox" id="user_subadmin" class="texter" name="user_subadmin" value="1" <?php if ($this->_tpl_vars['user']['user_subadmin'] == 1): ?>checked="checked"<?php endif; ?> />
</td>
</tr>			
<tr>
<td class="t1">
Active
</td>
<td class="t2">
<input type="checkbox" id="user_active" class="texter" name="user_active" value="1" <?php if ($this->_tpl_vars['user']['user_active'] == 1): ?>checked="checked"<?php endif; ?> />
</td>
</tr>
<tr>
<td colspan="2" class="t5" align="center">			
<input type="submit" value="<?php if ($this->_tpl_vars['user']): ?>Save<?php else: ?>Add<?php endif; ?>" class="buttoner"> <a href="<?php echo @ROOT_HOST; ?>
users/" class="buttoner">Cancel</a>
</td>
</tr>
</table>
</form>
</div>
<div class="user-list">
<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<div class="user">
<img src='images/icons/<?php if ($this->_tpl_vars['item']['user_admin']): ?>administrator<?php elseif ($this->_tpl_vars['item']['user_subadmin']): ?>subadmin<?php else: ?>user<?php endif; ?>.png' class="thumb" />
<span class="name"><?php echo $this->_tpl_vars['item']['user_name']; ?>
 (<?php echo $this->_tpl_vars['item']['usertype_name']; ?>
)</span><br />
<a href="mailto:<?php echo $this->_tpl_vars['item']['user_email']; ?>
"><?php echo $this->_tpl_vars['item']['user_email']; ?>
</a>
<div class="buttons">
<a href="<?php echo @ROOT_HOST; ?>
users/edit/<?php echo $this->_tpl_vars['item']['user_id']; ?>
"><img src="images/icons/editeaza.gif"></a> 
<a href="<?php echo @ROOT_HOST; ?>
users/delete/<?php echo $this->_tpl_vars['item']['user_id']; ?>
"><img src="images/icons/sterge.gif"></a> 
<a href="<?php echo @ROOT_HOST; ?>
users/switch/<?php echo $this->_tpl_vars['item']['user_id']; ?>
"><img src="images/icons/<?php if ($this->_tpl_vars['item']['user_active'] == 1): ?>activ<?php else: ?>inactiv<?php endif; ?>.gif"></a>
</div>
</div>
<?php endforeach; endif; unset($_from); ?>
</div>
</div>	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>