<?php /* Smarty version 2.6.12, created on 2023-02-20 10:37:28
         compiled from inc/working.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'time_format', 'inc/working.tpl', 2, false),)), $this); ?>
<form method="post" action="<?php echo @ROOT_HOST; ?>
project/<?php echo $this->_tpl_vars['working']['project_id']; ?>
/stop">
<label>Working on: <?php echo $this->_tpl_vars['working']['project_name']; ?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['working']['efective'])) ? $this->_run_mod_handler('time_format', true, $_tmp, "%H:%M") : smarty_modifier_time_format($_tmp, "%H:%M")); ?>
)</label> &nbsp;
<input type="submit" class="small-button stop" value="Stop">
</form>