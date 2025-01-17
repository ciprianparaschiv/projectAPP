<?php /* Smarty version 2.6.12, created on 2023-02-24 10:23:45
         compiled from userreports.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'userreports.tpl', 3, false),array('modifier', 'date_format', 'userreports.tpl', 80, false),array('modifier', 'time_format', 'userreports.tpl', 82, false),)), $this); ?>
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
reports/users/" id="activer">User Reports</a>
</li>
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
reports/client/">Client Reports</a>
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
<label for="report_user">User</label>
<select name="report[user]" id="report_user">
<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['report']['user'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['user_id']; ?>
"><?php echo $this->_tpl_vars['item']['user_name']; ?>
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
<label for="report_price">Show Price</label>
<select name="report[price]" id="report_price">
<option <?php if ($this->_tpl_vars['report']['price'] == '0'): ?>selected<?php endif; ?> value="0">No</option>
<option <?php if ($this->_tpl_vars['report']['price'] == '1'): ?>selected<?php endif; ?> value="1">YES</option>
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
Client
</td>
<td>
Project name
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
<?php if ($this->_tpl_vars['report']['price']): ?>
<td  align="center">
Price
</td>
<?php endif; ?>
</tr>
</thead>
<tbody>
<?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['types']['iteration']++;
?>
<tr>
<td><?php echo $this->_foreach['types']['iteration']; ?>
</td>
<td><?php echo $this->_tpl_vars['item']['client']; ?>
</td>
<td><?php echo $this->_tpl_vars['item']['project_name']; ?>
</a></td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['project_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['project_cdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
<td><?php if ($this->_tpl_vars['item']['project_ishourly']):  echo ((is_array($_tmp=$this->_tpl_vars['item']['project_worked'])) ? $this->_run_mod_handler('time_format', true, $_tmp, "%Hh %Mm") : smarty_modifier_time_format($_tmp, "%Hh %Mm"));  else: ?>-<?php endif; ?></td>
<?php if ($this->_tpl_vars['report']['price']): ?>
<td><?php echo $this->_tpl_vars['item']['price']; ?>
$</td>
<?php endif; ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</tbody>
<tfoot>
<tr><td colspan="10" align="right">
<?php if ($this->_tpl_vars['report']['price']): ?>Total: <?php echo $this->_tpl_vars['total']; ?>
$<?php endif; ?>  Hours:<?php echo ((is_array($_tmp=$this->_tpl_vars['hour_number'])) ? $this->_run_mod_handler('time_format', true, $_tmp, "%Hh %Mm") : smarty_modifier_time_format($_tmp, "%Hh %Mm")); ?>

</td></tr>
</tfoot>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>