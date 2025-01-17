<?php /* Smarty version 2.6.12, created on 2023-02-20 10:38:32
         compiled from project.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'project.tpl', 3, false),array('modifier', 'regex_replace', 'project.tpl', 28, false),array('modifier', 'nl2br', 'project.tpl', 28, false),array('modifier', 'date_format', 'project.tpl', 37, false),array('modifier', 'time_format', 'project.tpl', 58, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='padding:10px'>
<?php $this->assign('base_url', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=@ROOT_HOST)) ? $this->_run_mod_handler('cat', true, $_tmp, "project/") : smarty_modifier_cat($_tmp, "project/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['project']['project_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['project']['project_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/"))); ?>
<!-- -->
<div class="content">
<div class="titler">
<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
<?php if ($_SESSION['auth']['user_admin'] == 1 || $_SESSION['auth']['user_subadmin'] == 1): ?>
<li>
<a title="List users" href="https://www.officialbranding.org/project/projects/edit/<?php  echo  explode('/',$_SERVER['REQUEST_URI'])[3];  ?>">Edit</a>
</li>
<?php endif; ?>
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
myprojects/">Projects List</a>
</li>
<li>
<a title="" href="<?php echo @ROOT_HOST; ?>
project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
" id="activer" ><?php echo $this->_tpl_vars['project']['project_name']; ?>
</a>
</li>
</ul>
<h1 style="top:-25px;position:relative;float:left"><?php echo $this->_tpl_vars['project']['client_name']; ?>
 - <?php echo $this->_tpl_vars['project']['project_name']; ?>
</h1>
</div>
<div class="clear"> </div>
<br />
<div class="project_dashboard">
<fieldset>
<legend>Project info</legend>
<div class="left project_description">
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['project']['project_description'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, " @((([[:alnum:]]+)://|www\.)([^[:space:]]*)([[:alnum:]#?/&=]))@", " <a href=\"\\1\" target=\"_blank\" >\\1</a>") : smarty_modifier_regex_replace($_tmp, " @((([[:alnum:]]+)://|www\.)([^[:space:]]*)([[:alnum:]#?/&=]))@", " <a href=\"\\1\" target=\"_blank\" >\\1</a>")))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

<?php if ($this->_tpl_vars['project']['files']): ?>
<br /> <hr />
<?php $_from = $this->_tpl_vars['project']['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<a class="file" href="<?php echo $this->_tpl_vars['base_url']; ?>
download/<?php echo $this->_tpl_vars['item']['file_id']; ?>
"><?php echo $this->_tpl_vars['item']['file_name']; ?>
</a>
<?php endforeach; endif; unset($_from);  endif; ?>
</div>
<div class="left project_info">
<p>Date Added: <?php echo ((is_array($_tmp=$this->_tpl_vars['project']['project_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</p>
<p>Client: <?php echo $this->_tpl_vars['project']['client_name']; ?>
</p>
<form method="post" action="<?php echo $this->_tpl_vars['base_url']; ?>
change">
<p>Status:
<?php if ($this->_tpl_vars['project']['project_status'] != @PS_COMPLETED || $this->_tpl_vars['auth']['user_admin'] == 1 || $this->_tpl_vars['auth']['user_subadmin'] == 1): ?>
<select class="texter" name="project_status" id="project_status">
<?php $_from = $this->_tpl_vars['project_phases']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['project']['project_status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<input class="save small-button" type="submit" value="Change">
<?php else: ?>
Completed
<?php endif; ?>
</p>
</form>
<?php $this->assign('pttype', $this->_tpl_vars['project']['project_priority']); ?>
<p>Priority: <?php echo $this->_tpl_vars['project_priorities'][$this->_tpl_vars['pttype']]; ?>
</p>
<?php if ($this->_tpl_vars['project']['project_ishourly']): ?>
<form method="post" action="<?php echo $this->_tpl_vars['base_url'];  if ($this->_tpl_vars['project']['started']): ?>stop<?php else: ?>start<?php endif; ?>">
<p>
Timing: <?php echo ((is_array($_tmp=$this->_tpl_vars['project']['timing'])) ? $this->_run_mod_handler('time_format', true, $_tmp, "%Hh %Mmin") : smarty_modifier_time_format($_tmp, "%Hh %Mmin")); ?>

<?php if ($this->_tpl_vars['project']['project_status'] != @PS_COMPLETED):  if ($this->_tpl_vars['project']['started']): ?>
<input type="submit" class="small-button stop" value="Stop" />
<?php else: ?>
<input type="submit" class="small-button start" value="Start" />
<?php endif;  endif; ?>
</p>
<p>
<?php $_from = $this->_tpl_vars['project']['timings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
 echo $this->_tpl_vars['project']['users'][$this->_tpl_vars['key']]; ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('time_format', true, $_tmp, "%H:%M") : smarty_modifier_time_format($_tmp, "%H:%M")); ?>
<br />
<?php endforeach; endif; unset($_from); ?>
</p>
</form>
<?php endif;  if ($_SESSION['auth']['user_admin'] == 1 || $_SESSION['auth']['user_subadmin'] == 1): ?>
<p><input type="checkbox" name="user_respons" value="<?php echo $_SESSION['auth']['user_id']; ?>
" id="user_respons_sent" style="margin:0;" <?php if ($this->_tpl_vars['project']['project_sent'] == 1): ?>checked<?php endif; ?>>Set as reviewed and sent to the client
<input type="hidden" value="<?php echo $this->_tpl_vars['project']['project_id']; ?>
" id="id_project"
</p>
<?php endif; ?>
</div>
<div class="clear"> </div>
</fieldset>
</div>
<?php if ($this->_tpl_vars['project']['project_ishourly']): ?>
<div class="project_dashboard">
<fieldset>
<legend>Edit timings</legend>
<table class="lister" style="width:400px">
<tr><th>Date</th><th>User</th><th>Time</th><th>New time</th><th>&nbsp</th></tr>
<?php $_from = $this->_tpl_vars['project']['alltimings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
 if ($this->_tpl_vars['item']['delta']): ?>
<tr>
<?php $this->assign('tuser', $this->_tpl_vars['item']['timing_user']); ?>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['timing_start'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td><td><?php echo $this->_tpl_vars['project']['users'][$this->_tpl_vars['tuser']]; ?>
</td> <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['delta'])) ? $this->_run_mod_handler('time_format', true, $_tmp, "%H:%M") : smarty_modifier_time_format($_tmp, "%H:%M")); ?>
</td>
<?php if (! $this->_tpl_vars['item']['timing_open']): ?>
<form action="<?php echo $this->_tpl_vars['base_url']; ?>
/timing/" method="post">
<input type="hidden" name="tid" value="<?php echo $this->_tpl_vars['item']['timing_id']; ?>
" />
<td><input class="texter" type="text" name="timing" size="2" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['delta'])) ? $this->_run_mod_handler('time_format', true, $_tmp, "%H:%M") : smarty_modifier_time_format($_tmp, "%H:%M")); ?>
"></td>
<td><input type=submit class="small-button save" value="Save"></td>
</form>
<?php else: ?>
<td colspan=2>&nbsp;</td>
<?php endif; ?>
</tr>
<?php endif;  endforeach; endif; unset($_from); ?>
</table>
</fieldset>
</div>
<?php endif; ?>
<div class="project_dashboard">
<fieldset>
<legend>Messages</legend>
<div class="addmessage text-center">
<form method="POST" enctype="multipart/form-data" id="frm"  name="frm" action='<?php echo $this->_tpl_vars['base_url']; ?>
post/'>
<fieldset>
<img src="images/icons/user.png" class="left">
<div class="left">
<div class="left">
<textarea id="message" name="message" class="texter required" cols="80" rows="2"></textarea>
</div>
<div class="left">
<a id="btn_Add" href="javascript:;" onClick="return addFileField('project_file',' ');" class="buttoner">Add File field</a>
<a id="btn_Send" style='display:none' href="javascript:;" onClick="MsgSend();frm.submit();return(false);" class="buttoner">Send Message</a>
<a id="btn_Cancel" style='display:none' "href="<?php echo $this->_tpl_vars['base_url']; ?>
" class="buttoner">Cancel</a>
<a href=""><img id="msgloader" style='display:none;vertical-align:middle;' src="images/ajax-loader-big.gif" /></a>
</div>
<div class="clear"></div>
<div class="left inputfiles">
<input type="file" id="project_file" class="texter" name="project_file[]" />
</div>
<div class="clear"></div>
</div>
</fieldset>
</form>
</div>
<?php $_from = $this->_tpl_vars['project']['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
 if ($this->_tpl_vars['item']['message_type'] == 1): ?>
<fieldset>
<legend><?php if ($this->_tpl_vars['auth']['user_admin'] > 0): ?><a href="<?php echo $this->_tpl_vars['base_url']; ?>
rm/<?php echo $this->_tpl_vars['item']['message_id']; ?>
" class="right sterge" style=""><img src="images/icons/sterge.gif"></a><?php endif; ?> On <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['message_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 <?php echo $this->_tpl_vars['item']['user']; ?>
 said:  </legend>
<?php $this->assign('mid', $this->_tpl_vars['item']['message_id']);  if ($this->_tpl_vars['project']['mfiles'][$this->_tpl_vars['mid']]): ?>
<div class="right" style="width:200px;border:dashed 1px;padding:10px;">
<?php $_from = $this->_tpl_vars['project']['mfiles'][$this->_tpl_vars['mid']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fkey'] => $this->_tpl_vars['fitem']):
?>
<a class="file" href="<?php echo $this->_tpl_vars['base_url']; ?>
download/<?php echo $this->_tpl_vars['fkey']; ?>
"><?php echo $this->_tpl_vars['fitem']['file_name']; ?>
</a>
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>
<p>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['message_text'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, " @((([[:alnum:]]+)://|www\.)([^[:space:]]*)([[:alnum:]#?/&=]))@", " <a href=\"\\1\" target=\"_blank\" >\\1</a>") : smarty_modifier_regex_replace($_tmp, " @((([[:alnum:]]+)://|www\.)([^[:space:]]*)([[:alnum:]#?/&=]))@", " <a href=\"\\1\" target=\"_blank\" >\\1</a>")))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

</p>
</fieldset>
<?php else: ?>
<div class="notice">
<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['message_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 &rarr; <strong><?php echo $this->_tpl_vars['item']['user']; ?>
</strong>: <?php echo $this->_tpl_vars['item']['message_text']; ?>

</div>
<?php endif;  endforeach; endif; unset($_from); ?>
</fieldset>
</div>
</div>
<script type="javascript">

</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>