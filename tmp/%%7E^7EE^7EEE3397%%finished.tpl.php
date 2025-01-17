<?php /* Smarty version 2.6.12, created on 2023-02-20 10:47:46
         compiled from finished.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'finished.tpl', 25, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='padding:10px'>
<div class="content">
<div class="titler">
<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
<?php if ($this->_tpl_vars['auth']['user_admin'] > 0): ?>
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
" >Dashboard</a>
</li>
<li>
<a title="" href="<?php echo @ROOT_HOST; ?>
finished/"  id="activer" >Finished projects</a>
</li>
<?php endif; ?>
</ul>
<h1 style="top:-25px;position:relative;float:left">Finished projects</h1>
</div>
<div class="clear"> </div>
<br />
<div class="project_dashboard">
<fieldset>
<legend>
</legend>
<?php $this->assign('date', '');  $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
 $this->assign('newdate', ((is_array($_tmp=$this->_tpl_vars['item']['project_cdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)));  if ($this->_tpl_vars['newdate'] != $this->_tpl_vars['date']): ?>
<span><?php echo $this->_tpl_vars['newdate']; ?>
</span>
<?php $this->assign('date', $this->_tpl_vars['newdate']);  endif;  if ($this->_tpl_vars['item']['project_users_responsable'] != 0):  if ($this->_tpl_vars['item']['project_sent'] == 1): ?>
<div class="notice" style="background-color: #e7ecd9;">
<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['project_cdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
 &rarr; <strong><a href="<?php echo @ROOT_HOST; ?>
project/<?php echo $this->_tpl_vars['item']['project_id']; ?>
"><?php echo $this->_tpl_vars['item']['client_name']; ?>
 &rarr; <?php echo $this->_tpl_vars['item']['project_name']; ?>
     &rarr;      <span id="messages_finished"><?php echo $this->_tpl_vars['item']['user_name']; ?>
  sent it to the client</span></a></strong>
</div>
<?php else: ?>
<div class="notice"   style="background-color: <?php echo $this->_tpl_vars['item']['colour']; ?>
;">
<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['project_cdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
 &rarr; <strong><a href="<?php echo @ROOT_HOST; ?>
project/<?php echo $this->_tpl_vars['item']['project_id']; ?>
"><?php echo $this->_tpl_vars['item']['client_name']; ?>
 &rarr; <?php echo $this->_tpl_vars['item']['project_name']; ?>
     &rarr;      <span id="messages_finished"><?php echo $this->_tpl_vars['item']['user_name']; ?>
 is responsible of this project</span></a></strong>
</div>
<?php endif;  else:  if ($this->_tpl_vars['item']['project_sent'] == 1): ?>
<div class="notice" >
<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['project_cdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
 &rarr; <strong><a href="<?php echo @ROOT_HOST; ?>
project/<?php echo $this->_tpl_vars['item']['project_id']; ?>
"><?php echo $this->_tpl_vars['item']['client_name']; ?>
 &rarr; <?php echo $this->_tpl_vars['item']['project_name']; ?>
     </a></strong>
</div>
<?php else: ?>
<div class="notice"  >
<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['project_cdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
 &rarr; <strong><a href="<?php echo @ROOT_HOST; ?>
project/<?php echo $this->_tpl_vars['item']['project_id']; ?>
"><?php echo $this->_tpl_vars['item']['client_name']; ?>
 &rarr; <?php echo $this->_tpl_vars['item']['project_name']; ?>
    </a></strong>
</div>
<?php endif;  endif;  endforeach; endif; unset($_from); ?>
</fieldset>
</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>