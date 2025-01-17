<?php /* Smarty version 2.6.12, created on 2023-02-20 10:37:41
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.tpl', 36, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='padding:10px'>
<div class="content">
<div class="titler">
<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
<?php if ($this->_tpl_vars['auth']['user_admin'] > 0 || $this->_tpl_vars['auth']['user_subadmin'] > 0): ?>
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
"  id="activer">Dashboard</a>
</li>
<li>
<a title="" href="<?php echo @ROOT_HOST; ?>
finished/">Finished projects</a>
</li>
<?php endif; ?>
</ul>
<h1 style="top:-25px;position:relative;float:left">Dashboard</h1>
</div>
<div class="clear"> </div>
<br />
<div class="project_dashboard">
<fieldset>
<legend>
Your high priority projects:
</legend>
<?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<div class="notice">
<strong><a href="<?php echo @ROOT_HOST; ?>
/project/<?php echo $this->_tpl_vars['item']['project_id']; ?>
"><?php echo $this->_tpl_vars['item']['project_name']; ?>
</a> (<?php echo $this->_tpl_vars['item']['ptype_name']; ?>
)</strong>
</div>
<?php endforeach; endif; unset($_from); ?>
</fieldset>
<fieldset>
<legend>
Latest messages concerning your projects
</legend>
<?php $this->assign('date', '');  $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
 $this->assign('newdate', ((is_array($_tmp=$this->_tpl_vars['item']['message_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)));  if ($this->_tpl_vars['newdate'] != $this->_tpl_vars['date']): ?>
<span><?php echo $this->_tpl_vars['newdate']; ?>
</span>
<?php $this->assign('date', $this->_tpl_vars['newdate']);  endif; ?>
<div class="notice <?php if ($this->_tpl_vars['item']['message_file']): ?>attachment<?php endif; ?>">
<?php if ($this->_tpl_vars['item']['message_type'] == 1):  echo ((is_array($_tmp=$this->_tpl_vars['item']['message_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
 &rarr; <strong><?php echo $this->_tpl_vars['item']['user_name']; ?>
</strong> commented on <strong><a href="<?php echo @ROOT_HOST; ?>
project/<?php echo $this->_tpl_vars['item']['project_id']; ?>
"><?php echo $this->_tpl_vars['item']['project_name']; ?>
</a></strong>
<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['item']['message_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
 &rarr; <strong><?php echo $this->_tpl_vars['item']['user_name']; ?>
</strong> on <strong><a href="<?php echo @ROOT_HOST; ?>
project/<?php echo $this->_tpl_vars['item']['project_id']; ?>
"><?php echo $this->_tpl_vars['item']['project_name']; ?>
</a></strong>: <?php echo $this->_tpl_vars['item']['message_text']; ?>

<?php endif; ?>
</div>
<?php endforeach; endif; unset($_from); ?>
</fieldset>
</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>