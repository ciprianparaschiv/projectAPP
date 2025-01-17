<?php /* Smarty version 2.6.12, created on 2025-01-14 11:17:07
         compiled from usertypes.tpl */ ?>
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
users/" >User List</a>
</li>
<li>
<a title="User types" href="<?php echo @ROOT_HOST; ?>
users/types/" id="activer">User types</a>
</li>	
</ul>	
<h1 style="top:-25px;position:relative;float:left"><?php echo $this->_tpl_vars['subtitle']; ?>
</h1>
</div>
<div class="clear"> </div>
<br />
<div class="left form" style="width:300px">
<form id="frm" name="frm" action="users/types/" method="post">
<?php if ($this->_tpl_vars['usertype']): ?><input type="hidden" name="utid" value="<?php echo $this->_tpl_vars['usertype']['usertype_id']; ?>
"><?php endif; ?>
<table class="two_options">
<tr>
<td colspan="2" class="tH">
<h3><?php if ($this->_tpl_vars['usertype']): ?>Edit<?php else: ?>Add<?php endif; ?> Position</h3>
</td>
</tr>
<tr>
<td class="t1">
Position
</td>
<td class="t2">
<input type="text" id="name" class="required" name="name" value="<?php echo $this->_tpl_vars['usertype']['usertype_name']; ?>
" />
</td>
</tr>	
<tr>
<td colspan="2" class="t5" align="center">			
<input type="submit" value="<?php if ($this->_tpl_vars['usertype']): ?>Save<?php else: ?>Add<?php endif; ?>" class="buttoner"> <a href="<?php echo @ROOT_HOST; ?>
users/types/" class="buttoner">Cancel</a>
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
<?php $_from = $this->_tpl_vars['usertypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['types']['iteration']++;
?>
<tr>
<td><?php echo $this->_foreach['types']['iteration']; ?>
</td>
<td><?php echo $this->_tpl_vars['item']['usertype_name']; ?>
</td>
<td><a href="<?php echo @ROOT_HOST; ?>
users/types/edit/<?php echo $this->_tpl_vars['item']['usertype_id']; ?>
" class="editeaza">Edit</a> <?php if ($this->_tpl_vars['item']['cnt'] == 0): ?><a href="<?php echo @ROOT_HOST; ?>
users/types/delete/<?php echo $this->_tpl_vars['item']['usertype_id']; ?>
" class="sterge">Delete</a><?php endif; ?></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</tbody>
</table>
</div>	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>