<?php /* Smarty version 2.6.12, created on 2023-02-20 10:37:36
         compiled from inc/top.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body>
<div id="container">
<div id="header" style=''>
</div>
<div class="up_info">&nbsp;
<h1>
OfficialBranding Project Management
</h1>
<div id="working" <?php if (! $this->_tpl_vars['working']): ?> style='display:none'<?php endif; ?>>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/working.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div class="right_info">
<span class="time_today">Time worked today: <?php echo $this->_tpl_vars['time_today']; ?>
 </span>
<a href="<?php echo @ROOT_HOST; ?>
account/">My Account</a> <a href="<?php echo @ROOT_HOST; ?>
logout/">Logout</a>
</div>
</div>
<ul id="nav">
<li><a href="<?php echo @ROOT_HOST; ?>
" <?php if (! $this->_tpl_vars['active']): ?>id="active"<?php endif; ?> title="Dashboard" >Dashboard</a></li>
<li><a href="<?php echo @ROOT_HOST; ?>
myprojects/" title="My Projects" <?php if ($this->_tpl_vars['active'] == 'myprojects'): ?>id="active"<?php endif; ?>>My Projects</a></li>
<?php if ($_SESSION['auth']['user_admin'] || $_SESSION['auth']['user_subadmin']): ?>
<li><a href="<?php echo @ROOT_HOST; ?>
projects/" title="Projects" <?php if ($this->_tpl_vars['active'] == 'projects'): ?>id="active"<?php endif; ?>>Projects</a></li>
<li><a href="<?php echo @ROOT_HOST; ?>
clients/" title="Clients" <?php if ($this->_tpl_vars['active'] == 'clients'): ?>id="active"<?php endif; ?>>Clients</a></li>
<?php endif;  if ($_SESSION['auth']['user_admin']): ?>
<li><a href="<?php echo @ROOT_HOST; ?>
users/" title="Users" <?php if ($this->_tpl_vars['active'] == 'users'): ?>id="active"<?php endif; ?>>Users</a></li>
<li><a href="<?php echo @ROOT_HOST; ?>
reports/" title="Reports" <?php if ($this->_tpl_vars['active'] == 'reports'): ?>id="active"<?php endif; ?>>Reports</a></li>
<?php endif; ?>
</ul>
<div class="clear"></div>