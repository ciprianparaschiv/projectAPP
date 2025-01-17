<?php /* Smarty version 2.6.12, created on 2025-01-13 15:25:16
         compiled from contractors.tpl */ ?>
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
clients/" >Clients</a>
</li>
<li>
<a title="Subcontractors" href="<?php echo @ROOT_HOST; ?>
clients/contractors/" id="activer">Subcontractors</a>
</li>	
</ul>	
<h1 style="top:-25px;position:relative;float:left"><?php echo $this->_tpl_vars['subtitle']; ?>
</h1>
</div>
<div class="clear"> </div>
<br />
<div class="left form" style="width:300px">
<form id="frm" name="frm" action="clients/contractors/" method="post">
<?php if ($this->_tpl_vars['contractor']): ?><input type="hidden" name="cid" value="<?php echo $this->_tpl_vars['contractor']['contractor_id']; ?>
"><?php endif; ?>
<table class="two_options">
<tr>
<td colspan="2" class="tH">
<h3><?php if ($this->_tpl_vars['contractor']): ?>Edit<?php else: ?>Add<?php endif; ?> Subcontractor</h3>
</td>
</tr>
<tr>
<td class="t1">
Name
</td>
<td class="t2">
<input type="text" id="contractor_name" class="texter required" name="contractor_name" value="<?php echo $this->_tpl_vars['contractor']['contractor_name']; ?>
" />
</td>
</tr>	
<tr>
<td class="t1">
Email
</td>
<td class="t2">
<input type="text" id="contractor_email" class="texter email required" name="contractor_email" value="<?php echo $this->_tpl_vars['contractor']['contractor_email']; ?>
" />
</td>
</tr>		
<tr>
<td class="t1">
Website
</td>
<td class="t2">
<input type="text" id="contractor_url" class="texter url required" name="contractor_url" value="<?php echo $this->_tpl_vars['contractor']['contractor_url']; ?>
" />
</td>
</tr>		
<tr>
<td colspan="2" class="t5" align="center">			
<input type="submit" value="<?php if ($this->_tpl_vars['contractor']): ?>Save<?php else: ?>Add<?php endif; ?>" class="buttoner"> <a href="<?php echo @ROOT_HOST; ?>
clients/contractors/" class="buttoner">Cancel</a>
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
<?php $_from = $this->_tpl_vars['contractors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['types']['iteration']++;
?>
<tr>
<td><?php echo $this->_foreach['types']['iteration']; ?>
</td>
<td><?php echo $this->_tpl_vars['item']['contractor_name']; ?>
</td>
<td><a href="<?php echo @ROOT_HOST; ?>
clients/contractors/edit/<?php echo $this->_tpl_vars['item']['contractor_id']; ?>
" class="editeaza">Edit</a> <?php if ($this->_tpl_vars['item']['cnt'] == 0): ?><a href="<?php echo @ROOT_HOST; ?>
clients/contractors/delete/<?php echo $this->_tpl_vars['item']['contractor_id']; ?>
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