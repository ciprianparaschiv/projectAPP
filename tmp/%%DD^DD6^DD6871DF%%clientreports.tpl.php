<?php /* Smarty version 2.6.12, created on 2023-05-02 12:15:34
         compiled from clientreports.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'clientreports.tpl', 3, false),array('modifier', 'date_format', 'clientreports.tpl', 117, false),array('modifier', 'time_format', 'clientreports.tpl', 119, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='padding:10px'>
<?php $this->assign('base_url', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=@ROOT_HOST)) ? $this->_run_mod_handler('cat', true, $_tmp, "project/") : smarty_modifier_cat($_tmp, "project/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['project']['project_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['project']['project_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/"))); ?>
<div class="content">
<div class="titler">
<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
reports/special/">Special Reports</a>
</li>		
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
reports/users/">User Reports</a>
</li>
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
reports/client/"  id="activer">Client Reports</a>
</li>
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
reports/client/saved/">Saved Reports</a>
</li>
</ul>	
<h1 style="top:-25px;position:relative;float:left">&nbsp;</h1>
</div>
<div class="clear"> </div>
<br />
<div class="filter">
<form method="post">
<fieldset>
<legend>Filters</legend>
<label for="report_user">Client</label>
<select name="report[client]" id="report_client">
<?php $this->assign('curcont', '0');  $_from = $this->_tpl_vars['clients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
 if ($this->_tpl_vars['item']['contractor_id'] != $this->_tpl_vars['curcont']): ?>
<option <?php if ($this->_tpl_vars['report']['client'] == $this->_tpl_vars['item']['contractor_id']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['contractor_id']; ?>
"><?php echo $this->_tpl_vars['item']['contractor_name']; ?>
</option>
<?php $this->assign('curcont', $this->_tpl_vars['item']['contractor_id']);  endif;  $this->assign('cur_cli', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curcont'])) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['key']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['key']))); ?>
<option <?php if ($this->_tpl_vars['report']['client'] == $this->_tpl_vars['cur_cli']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['cur_cli']; ?>
">&nbsp;&nbsp;<?php echo $this->_tpl_vars['item']['client_name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<span class="separator">  | </span>
<label for="report_start">Start date</label>
<input name="report[start]" id="report_start" value="<?php echo $this->_tpl_vars['report']['start']; ?>
" size=10 class="date-pick" />
<label for="report_stop">Stop date</label>
<input name="report[stop]" id="report_stop" value="<?php echo $this->_tpl_vars['report']['stop']; ?>
" size=10 class="date-pick" />
<span class="separator">  | </span>
<label for="report_type">Type</label>
<select name="report[type]" id="report_type">	
<option value="">Any</option>
<?php $_from = $this->_tpl_vars['PROJECT_WTYPES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['report']['type'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<span class="separator">  | </span>
<label for="project_type">Project Type</label>
<select name="report[ptype]" id="project_type">	
<option value="">Any</option>
<?php $_from = $this->_tpl_vars['project_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>					
<option <?php if ($this->_tpl_vars['report']['ptype'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']['ptype_name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<span class="separator">  | </span>
<label for="report_paid">Paid</label>
<select name="report[paid]" id="report_paid">	
<option value="">Any</option>
<option <?php if ($this->_tpl_vars['report']['paid'] == '0'): ?>selected<?php endif; ?> value="0">No</option>
<option <?php if ($this->_tpl_vars['report']['paid'] == '1'): ?>selected<?php endif; ?> value="1">YES</option>
</select>
<input type="submit" class="buttoner" name="submit" value="Generate"/>		
<input type="submit" class="buttoner" name="submit" value="PDF"/>		
</fieldset>
</form>
</div>	
<table class="lister" style="">	
<thead>
<tr class="head">
<td width="20px">#
</td>
<td>
Project name
</td>
<td>
Type
</td>
<td>
Project date
</td>
<td>
Project completed
</td>
<td  align="center">
Hours worked
</td>
<td  align="center">
Price
</td>				
<td  align="center">
Paid
</td>				
</tr>
</thead>
<tbody>
<?php $this->assign('client', "");  $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['types']['iteration']++;
?>	
<?php if ($this->_tpl_vars['client'] != $this->_tpl_vars['item']['client']): ?>
<tr>
<td colspan="10" align="left">
<b><?php echo $this->_tpl_vars['item']['client']; ?>
</b>
</td>
</tr>
<?php $this->assign('client', $this->_tpl_vars['item']['client']);  endif; ?>
<tr>
<td><?php echo $this->_foreach['types']['iteration']; ?>
</td>
<td><?php echo $this->_tpl_vars['item']['project_name']; ?>
</a></td>	
<?php $this->assign('pttype', $this->_tpl_vars['item']['project_type']); ?>
<td><?php echo $this->_tpl_vars['project_types'][$this->_tpl_vars['pttype']]['ptype_name']; ?>
</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['project_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['project_cdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>	
<td><?php if ($this->_tpl_vars['item']['project_ishourly']):  echo ((is_array($_tmp=$this->_tpl_vars['item']['project_worked'])) ? $this->_run_mod_handler('time_format', true, $_tmp, "%Hh %Mm") : smarty_modifier_time_format($_tmp, "%Hh %Mm"));  else: ?>-<?php endif; ?></td>					
<td><?php echo $this->_tpl_vars['item']['price']; ?>
$</td>										
<td><?php if ($this->_tpl_vars['item']['project_paid']): ?>Yes<?php else: ?>No<?php endif; ?></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</tbody>
<tfoot>
<tr><td colspan="10" align="right">
Total: <?php echo $this->_tpl_vars['total']; ?>
$
</td></tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td style="text-align: left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['hour'])) ? $this->_run_mod_handler('time_format', true, $_tmp, "%Hh %Mm") : smarty_modifier_time_format($_tmp, "%Hh %Mm")); ?>
</td>
</tr>
</tfoot>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>