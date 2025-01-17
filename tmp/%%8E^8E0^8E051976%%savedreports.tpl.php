<?php /* Smarty version 2.6.12, created on 2023-04-20 13:14:22
         compiled from savedreports.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'savedreports.tpl', 3, false),array('modifier', 'date_format', 'savedreports.tpl', 49, false),)), $this); ?>
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
reports/special/">Special Reports</a>
</li>		
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
<h1 style="top:-25px;position:relative;float:left">&nbsp;</h1>
</div>
<div class="clear"> </div>
<br />
<table class="lister" style="">	
<thead>
<tr class="head">
<td width="20px">#
</td>
<td>
Title
</td>
<td>
Date
</td>
<td>
Price
</td>
<td>
Paid
</td>
<td>&nbsp;</td>
</tr>
</thead>
<tbody>
<?php $_from = $this->_tpl_vars['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['types']['iteration']++;
?>
<tr>
<td><?php echo $this->_tpl_vars['key']; ?>
</td>										
<td><a href="<?php echo $this->_tpl_vars['base_url'];  echo $this->_tpl_vars['item']['report_id']; ?>
"><?php echo $this->_tpl_vars['item']['report_title']; ?>
</a></td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['report_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</a></td>
<td><?php echo $this->_tpl_vars['item']['report_price']; ?>
 $</td>
<td><?php if ($this->_tpl_vars['item']['report_paid']): ?>Yes<?php else: ?>No<?php endif; ?></td>
<td><a href="freports/<?php echo $this->_tpl_vars['item']['report_id']; ?>
.pdf"><img src="images/icons/attachment.gif" /></a> 
<a href="<?php echo $this->_tpl_vars['base_url'];  echo $this->_tpl_vars['item']['report_id']; ?>
/getexcel"><img src="images/icons/excel.gif" /></a> 
<a class="delete" href="<?php echo $this->_tpl_vars['base_url'];  echo $this->_tpl_vars['item']['report_id']; ?>
/delete">Delete</a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</tbody>
<tfoot>
<tr><td colspan="10" align="right">
Page: 
<?php unset($this->_sections['pages']);
$this->_sections['pages']['name'] = 'pages';
$this->_sections['pages']['start'] = (int)1;
$this->_sections['pages']['loop'] = is_array($_loop=$this->_tpl_vars['page_count']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pages']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['pages']['show'] = true;
$this->_sections['pages']['max'] = $this->_sections['pages']['loop'];
if ($this->_sections['pages']['start'] < 0)
    $this->_sections['pages']['start'] = max($this->_sections['pages']['step'] > 0 ? 0 : -1, $this->_sections['pages']['loop'] + $this->_sections['pages']['start']);
else
    $this->_sections['pages']['start'] = min($this->_sections['pages']['start'], $this->_sections['pages']['step'] > 0 ? $this->_sections['pages']['loop'] : $this->_sections['pages']['loop']-1);
if ($this->_sections['pages']['show']) {
    $this->_sections['pages']['total'] = min(ceil(($this->_sections['pages']['step'] > 0 ? $this->_sections['pages']['loop'] - $this->_sections['pages']['start'] : $this->_sections['pages']['start']+1)/abs($this->_sections['pages']['step'])), $this->_sections['pages']['max']);
    if ($this->_sections['pages']['total'] == 0)
        $this->_sections['pages']['show'] = false;
} else
    $this->_sections['pages']['total'] = 0;
if ($this->_sections['pages']['show']):

            for ($this->_sections['pages']['index'] = $this->_sections['pages']['start'], $this->_sections['pages']['iteration'] = 1;
                 $this->_sections['pages']['iteration'] <= $this->_sections['pages']['total'];
                 $this->_sections['pages']['index'] += $this->_sections['pages']['step'], $this->_sections['pages']['iteration']++):
$this->_sections['pages']['rownum'] = $this->_sections['pages']['iteration'];
$this->_sections['pages']['index_prev'] = $this->_sections['pages']['index'] - $this->_sections['pages']['step'];
$this->_sections['pages']['index_next'] = $this->_sections['pages']['index'] + $this->_sections['pages']['step'];
$this->_sections['pages']['first']      = ($this->_sections['pages']['iteration'] == 1);
$this->_sections['pages']['last']       = ($this->_sections['pages']['iteration'] == $this->_sections['pages']['total']);
 $this->assign('i', $this->_sections['pages']['index']); ?>
<a <?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['i']): ?>class="cur" <?php endif; ?> href="<?php echo $this->_tpl_vars['base_url']; ?>
?page=<?php echo $this->_tpl_vars['i']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</a> 
<?php endfor; endif; ?>
</td></tr>
</tfoot>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>