<?php /* Smarty version 2.6.12, created on 2023-07-26 11:16:02
         compiled from projecttypes.tpl */ ?>
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
projects/" >Projects List</a>
</li>
<li>
<a title="Add Project" href="<?php echo @ROOT_HOST; ?>
projects/add/">Add Project</a>
</li>	
<li>
<a title="User types" href="<?php echo @ROOT_HOST; ?>
projects/types/" id="activer">Project types</a>
</li>	
</ul>	
<h1 style="top:-25px;position:relative;float:left"><?php echo $this->_tpl_vars['subtitle']; ?>
</h1>
</div>
<div class="clear"> </div>
<br />
<div class="left form" style="width:300px">
<form id="frm" name="frm" action="projects/types/" method="post">
<?php if ($this->_tpl_vars['projecttype']): ?><input type="hidden" name="ptid" value="<?php echo $this->_tpl_vars['projecttype']['ptype_id']; ?>
"><?php endif; ?>
<table class="two_options">
<tr>
<td colspan="2" class="tH">
<h3><?php if ($this->_tpl_vars['projecttype']): ?>Edit<?php else: ?>Add<?php endif; ?> Type</h3>
</td>
</tr>
<tr>
<td class="t1">
Name
</td>
<td class="t2">
<input type="text" id="ptype_name" class="texter required" name="ptype_name" value="<?php echo $this->_tpl_vars['projecttype']['ptype_name']; ?>
" />
</td>
</tr>	
<tr>
<td class="t1">
Type
</td>
<td class="t2">
<select id="ptype_rtype" name="ptype_rtype" class="texter required">
<option value="">Please select</option>
<?php $_from = $this->_tpl_vars['PROJECT_TYPES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['projecttype']['ptype_rtype'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
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
<?php $_from = $this->_tpl_vars['PROJECT_WTYPES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['projecttype']['ptype_wtype'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>		
<tr>
<td class="t1">
Price
</td>
<td class="t2">
<input type="text" id="ptype_price" class="required number texter" name="ptype_price" value="<?php echo $this->_tpl_vars['projecttype']['ptype_price']+0; ?>
" />
</td>
</tr>
<tr>
<td colspan="2" class="t5" align="center">			
<input type="submit" value="<?php if ($this->_tpl_vars['projecttype']): ?>Save<?php else: ?>Add<?php endif; ?>" class="buttoner"> <a href="<?php echo @ROOT_HOST; ?>
projects/types/" class="buttoner">Cancel</a>
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
<?php $_from = $this->_tpl_vars['projecttypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['types']['iteration']++;
?>
<tr>
<td><?php echo $this->_foreach['types']['iteration']; ?>
</td>
<td><?php echo $this->_tpl_vars['item']['ptype_name']; ?>
</td>
<?php $this->assign('pttype', $this->_tpl_vars['item']['ptype_rtype']); ?>
<td><?php echo $this->_tpl_vars['PROJECT_TYPES'][$this->_tpl_vars['pttype']]['name']; ?>
</td>
<?php $this->assign('pttype', $this->_tpl_vars['item']['ptype_wtype']); ?>
<td><?php echo $this->_tpl_vars['PROJECT_WTYPES'][$this->_tpl_vars['pttype']]; ?>
</td>
<td><?php echo $this->_tpl_vars['item']['ptype_price']; ?>
 $</td>
<td><a href="<?php echo @ROOT_HOST; ?>
projects/types/edit/<?php echo $this->_tpl_vars['item']['ptype_id']; ?>
" class="editeaza">Edit</a> <?php if ($this->_tpl_vars['item']['cnt'] == 0): ?><a href="<?php echo @ROOT_HOST; ?>
projects/types/delete/<?php echo $this->_tpl_vars['item']['ptype_id']; ?>
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