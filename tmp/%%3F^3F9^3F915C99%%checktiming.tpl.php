<?php /* Smarty version 2.6.12, created on 2023-02-20 10:40:02
         compiled from checktiming.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'checktiming.tpl', 14, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='padding:10px'>
<div class="content">
<div class="titler">
<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">	
</ul>	
<h1 style="top:-25px;position:relative;float:left">Check your timing</h1>
</div>
<div class="clear"> </div>
<br />
<div class="filter">
<fieldset>
<legend>
<b>Since last update your '<?php echo $this->_tpl_vars['tworking']['project_name']; ?>
' project had timed (<?php echo ((is_array($_tmp=$this->_tpl_vars['tworking']['delta'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
) what do you want to do?</b>
</legend>
<form method="post">
<br />
<input type="submit" name="efective" class="buttoner" value="close project with last saved time (<?php echo ((is_array($_tmp=$this->_tpl_vars['tworking']['efective'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
)" />
<input type="submit" name="full" class="buttoner" value="close with current time (<?php echo ((is_array($_tmp=$this->_tpl_vars['tworking']['full'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
)" />
<input type="submit" name="continue" class="buttoner" value=" continue " />
<br />
<br />
</form>
</fieldset>
</div>
</div>	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>