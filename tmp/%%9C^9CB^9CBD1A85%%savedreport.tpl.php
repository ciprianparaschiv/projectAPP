<?php /* Smarty version 2.6.12, created on 2023-05-02 11:31:16
         compiled from savedreport.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'savedreport.tpl', 3, false),array('modifier', 'count', 'savedreport.tpl', 72, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='padding:10px'>
<?php $this->assign('base_url', ((is_array($_tmp=@ROOT_HOST)) ? $this->_run_mod_handler('cat', true, $_tmp, "reports/client/saved/") : smarty_modifier_cat($_tmp, "reports/client/saved/"))); ?>
<div class="content">
<div class="titler">
<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
reports/users/">User Reports</a>
</li>
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
reports/client/">Client Reports</a>
</li>
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
reports/client/saved/"  id="activer">Saved Reports</a>
</li>
</ul>	
<h1 style="top:-25px;position:relative;float:left"><?php echo $this->_tpl_vars['report']['report_title']; ?>
</h1>
</div>
<div class="clear"> </div>
<br />
<div class="left form">
<form id="frm" name="frm" action="<?php echo $this->_tpl_vars['base_url'];  echo $this->_tpl_vars['report']['report_id']; ?>
" method="post">
<table class="two_options">
<tr>
<td colspan="2" class="tH">
<h3>Mark paid?</h3>
</td>
</tr>
<tr>
<td class="t1">
</td>
</tr>					
<tr>
<td colspan="2" class="t5" align="center">			
<input name="btn" type="submit" value="Mark Paid" class="buttoner"> <a href="<?php echo $this->_tpl_vars['base_url']; ?>
" class="buttoner">Cancel</a>
</td>
</tr>
</table>
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
<?php $this->assign('client', "");  $_from = $this->_tpl_vars['report']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['types']['iteration']++;
 if (count($this->_tpl_vars['item']) == 1): ?>
<tr>
<td colspan="10" align="left">
<b><?php echo $this->_tpl_vars['item'][0]; ?>
</b>
</td>
</tr>
<?php else: ?>
<tr>
<td><?php echo $this->_tpl_vars['item'][0]; ?>
</td>
<td><?php echo $this->_tpl_vars['item'][1]; ?>
</a></td>	
<td><?php echo $this->_tpl_vars['item'][2]; ?>
</td>
<td><?php echo $this->_tpl_vars['item'][3]; ?>
</td>
<td><?php echo $this->_tpl_vars['item'][4]; ?>
</td>	
<td><?php echo $this->_tpl_vars['item'][5]; ?>
</td>					
<td><?php echo $this->_tpl_vars['item'][7]; ?>
</td>		
<?php $this->assign('pid', $this->_tpl_vars['item'][8]); ?>
<td><?php if ($this->_tpl_vars['report']['projects'][$this->_tpl_vars['pid']]['project_paid']): ?>Yes<?php else: ?>No<?php endif; ?></td>
</tr>
<?php endif;  endforeach; endif; unset($_from); ?>
</tbody>
<tfoot>
<tr><td colspan="10" align="right">
Total: <?php echo $this->_tpl_vars['report']['report_price']; ?>
$
</td></tr>
</tfoot>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>