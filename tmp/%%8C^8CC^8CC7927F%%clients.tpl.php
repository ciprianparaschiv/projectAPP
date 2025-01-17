<?php /* Smarty version 2.6.12, created on 2023-03-01 09:49:37
         compiled from clients.tpl */ ?>
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
clients/" id="activer" >Clients</a>
</li>
<li>
<a title="Subcontractors" href="<?php echo @ROOT_HOST; ?>
clients/contractors/" >Subcontractors</a>
</li>	
</ul>	
<h1 style="top:-25px;position:relative;float:left"><?php echo $this->_tpl_vars['subtitle']; ?>
</h1>
</div>
<div class="clear"> </div>
<br />
<div class="left form" style="width:500px">
<form id="frm" name="frm" action="clients/" method="post">
<?php if ($this->_tpl_vars['client']): ?><input type="hidden" name="cid" value="<?php echo $this->_tpl_vars['client']['client_id']; ?>
"><?php endif; ?>
<table class="two_options">
<tr>
<td colspan="2" class="tH">
<h3><?php if ($this->_tpl_vars['client']): ?>Edit<?php else: ?>Add<?php endif; ?> Client</h3>
</td>
</tr>
<tr>
<td class="t1">
Contractor
</td>
<td class="t2">
<select id="client_contractor" class="texter required" name="client_contractor">
<option value="">Please Select</option>
<?php $_from = $this->_tpl_vars['contractors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?> 
<option <?php if ($this->_tpl_vars['client']['client_contractor'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']['contractor_name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>		
<tr>
<td class="t1">
Client Harvest
</td>
<td class="t2">
<select id="client_harvest" class="texter " name="client_harvest">
<option value="">Please Select</option>
<?php $_from = $this->_tpl_vars['clients_harvest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['client']['client_harvest'] == $this->_tpl_vars['item']['project_harvest_id']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['project_harvest_id']; ?>
"><?php echo $this->_tpl_vars['item']['project_harvest_name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>	
<tr>
<td class="t1">
Name
</td>
<td class="t2">
<input type="text" id="client_name" class="texter required" name="client_name" value="<?php echo $this->_tpl_vars['client']['client_name']; ?>
" />
</td>
</tr>	
<tr>
<td class="t1">
Website
</td>
<td class="t2">
<input type="text" id="client_url" class="texter url required" name="client_url" value="<?php echo $this->_tpl_vars['client']['client_url']; ?>
" />
</td>
</tr>
<tr>
<td class="t1">
Reporting
</td>
<td class="t2">
<input type="checkbox" id="client_reporting" class="texter" name="client_reporting"  <?php if ($this->_tpl_vars['client']['client_reporting'] == 1): ?>checked<?php endif; ?>  value="1" />
</td>
</tr>
<tr>
<td colspan="2" class="t5" align="center">			
<input type="submit" value="<?php if ($this->_tpl_vars['client']): ?>Save<?php else: ?>Add<?php endif; ?>" class="buttoner"> <a href="<?php echo @ROOT_HOST; ?>
clients/" class="buttoner">Cancel</a>
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
Client
</td>
<td>
Client Harvest
</td>
<td>
Website
</td>
<td>
Reporting
</td>
<td width="100px">
Action
</td>
</tr>
</thead>
<tbody>
<?php $this->assign('lastcontractor', -1); ?>
<?php $_from = $this->_tpl_vars['clients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['types']['iteration']++;
?>
<?php if ($this->_tpl_vars['item']['client_contractor'] != $this->_tpl_vars['lastcontractor']): ?>
<?php $this->assign('lastcontractor', $this->_tpl_vars['item']['client_contractor']); ?>
<tr>
<td colspan="4">
<?php echo $this->_tpl_vars['contractors'][$this->_tpl_vars['lastcontractor']]['contractor_name']; ?>

</td>
</tr>
<?php endif; ?>
<tr>
<td><?php echo $this->_foreach['types']['iteration']; ?>
</td>
<td><?php echo $this->_tpl_vars['item']['client_name']; ?>
</td>
<?php $_from = $this->_tpl_vars['clients_harvest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['keys'] => $this->_tpl_vars['items']):
?>
<?php if ($this->_tpl_vars['items']['project_harvest_id'] == $this->_tpl_vars['item']['client_harvest']): ?>
<td><?php echo $this->_tpl_vars['items']['project_harvest_name']; ?>
 - <?php echo $this->_tpl_vars['items']['client_harvest_name']; ?>
</td>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['item']['client_harvest'] == 0): ?> <td>-</td><?php endif; ?>
<td><?php echo $this->_tpl_vars['item']['client_url']; ?>
</td>
<td><?php if ($this->_tpl_vars['item']['client_reporting'] == 1): ?>Yes<?php else: ?>No<?php endif; ?></td>
<td><a href="<?php echo @ROOT_HOST; ?>
clients/edit/<?php echo $this->_tpl_vars['item']['client_id']; ?>
" class="editeaza">Edit</a> <?php if ($this->_tpl_vars['item']['cnt'] == 0): ?><a href="<?php echo @ROOT_HOST; ?>
clients/delete/<?php echo $this->_tpl_vars['item']['client_id']; ?>
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