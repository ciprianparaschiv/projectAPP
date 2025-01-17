<?php /* Smarty version 2.6.12, created on 2023-02-20 10:37:48
         compiled from projects.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'projects.tpl', 3, false),array('modifier', 'lower', 'projects.tpl', 108, false),array('modifier', 'join', 'projects.tpl', 113, false),array('modifier', 'date_format', 'projects.tpl', 158, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='padding:10px'>
<?php $this->assign('base_url', ((is_array($_tmp=@ROOT_HOST)) ? $this->_run_mod_handler('cat', true, $_tmp, "projects/") : smarty_modifier_cat($_tmp, "projects/"))); ?>
<div class="content">
<div class="titler">
<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
projects/" id="activer" >Projects List</a>
</li>
<li>
<a title="Add Project" href="<?php echo @ROOT_HOST; ?>
projects/add/">Add Project</a>
</li>
<?php if ($this->_tpl_vars['auth']['user_admin']): ?>
<li>
<a title="User types" href="<?php echo @ROOT_HOST; ?>
projects/types/" >Project types</a>
</li>
<?php endif; ?>
</ul>
<h1 style="top:-25px;position:relative;float:left"><?php echo $this->_tpl_vars['subtitle']; ?>
</h1>
</div>
<div class="clear"> </div>
<br />
<div class="filter">
<form method="post">
<fieldset>
<legend>Filters</legend>
<label for="filter_name">Name</label>
<input name="filter[name]" id="filter_name" value="<?php echo $this->_tpl_vars['filter']['name']; ?>
"/>
<label for="filter_client">Client</label>
<select name="filter[client]" id="filter_client">
<option value="">Any</option>
<?php $_from = $this->_tpl_vars['clients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['filter']['client'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['client_id']; ?>
"><?php echo $this->_tpl_vars['item']['client_name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<label for="filter_status">Users</label>
<select name="filter[projects_users]" id="filter_users">
<option value="">Any</option>
<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['filter']['projects_users'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']['user_name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<label for="filter_status">Status</label>
<select name="filter[status]" id="filter_status">
<option value="">Any</option>
<?php $_from = $this->_tpl_vars['project_phases']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['filter']['status'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<?php if ($this->_tpl_vars['auth']['user_admin']): ?>
<label for="filter_paid">Paid</label>
<select name="filter[paid]" id="filter_paid">
<option <?php if (! $this->_tpl_vars['filter']['paid']): ?>selected<?php endif; ?>value="">Any</option>
<option <?php if ($this->_tpl_vars['filter']['paid'] == '0'): ?>selected<?php endif; ?> value="0">No</option>
<option <?php if ($this->_tpl_vars['filter']['paid'] == '1'): ?>selected<?php endif; ?> value="1">YES</option>
</select>
<?php endif; ?>
<input type="submit" class="buttoner" name="submit" value="Filter"/>
<input type="submit" class="buttoner" name="submit" value="Clear Filters" />
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
Name
</td>
<td>
Users
</td>
<td>
Type
</td>
<td>
Work Type
</td>
<td  align="center">
Price
</td>
<td  align="center">
<a href="<?php echo $this->_tpl_vars['base_url']; ?>
?sort=project_status|<?php if ($this->_tpl_vars['sort'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>">
Status
<?php if ($this->_tpl_vars['sort_name'] == 'project_status'): ?><img src="images/icons/sort_<?php echo $this->_tpl_vars['sort']; ?>
.gif"><?php endif; ?>
</a>
</td>
<td  align="center">
Paid
</td>
<td align="center">
<a href="<?php echo $this->_tpl_vars['base_url']; ?>
?sort=project_date|<?php if ($this->_tpl_vars['sort'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>">Date
<?php if ($this->_tpl_vars['sort_name'] == 'project_date'): ?><img src="images/icons/sort_<?php echo $this->_tpl_vars['sort']; ?>
.gif"><?php endif; ?>
</a>
</td>
<td width="100px" align="center">
Action
</td>
</tr>
</thead>
<tbody>
<?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['types']['iteration']++;
 $this->assign('pttype', $this->_tpl_vars['item']['project_priority']); ?>
<tr class="<?php if ($this->_tpl_vars['item']['project_status'] == 3): ?>complete<?php elseif ($this->_tpl_vars['item']['project_status'] == 1): ?>pending<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['project_priorities'][$this->_tpl_vars['pttype']])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp));  endif; ?>"data-href="<?php echo @ROOT_HOST; ?>
project/<?php echo $this->_tpl_vars['item']['project_id']; ?>
">
<td><?php echo $this->_foreach['types']['iteration']; ?>
</td>
<?php $this->assign('pttype', $this->_tpl_vars['item']['project_client']); ?>
<td><?php echo $this->_tpl_vars['clients'][$this->_tpl_vars['pttype']]['client_name']; ?>
</td>
<td><a href="<?php echo @ROOT_HOST; ?>
project/<?php echo $this->_tpl_vars['item']['project_id']; ?>
"><?php echo $this->_tpl_vars['item']['project_name'];  if ($this->_tpl_vars['item']['project_job']): ?> (Job: <?php echo $this->_tpl_vars['item']['project_job']; ?>
)<?php endif; ?></a></td>
<td><?php echo join($this->_tpl_vars['item']['user']['project_users'], "<br/>"); ?>
</td>
<?php $this->assign('pttype', $this->_tpl_vars['item']['project_type']); ?>
<td><?php echo $this->_tpl_vars['projecttypes'][$this->_tpl_vars['pttype']]['ptype_name']; ?>
</td>
<td>
<?php if ($this->_tpl_vars['item']['ptype_wtype'] == 1): ?>
SEO
<?php endif;  if ($this->_tpl_vars['item']['ptype_wtype'] == 2): ?>
WEB DESIGN
<?php endif;  if ($this->_tpl_vars['item']['ptype_wtype'] == 3): ?>
SOCIAL MEDIA
<?php endif;  if ($this->_tpl_vars['item']['ptype_wtype'] == 4): ?>
PPC
<?php endif;  if ($this->_tpl_vars['item']['ptype_wtype'] == 5): ?>
MARKETING
<?php endif;  if ($this->_tpl_vars['item']['ptype_wtype'] == 6): ?>
US
<?php endif;  if ($this->_tpl_vars['projecttypes'][$this->_tpl_vars['pttype']]['ptype_wtype'] == 1 && ! $this->_tpl_vars['item']['ptype_wtype']): ?>
SEO
<?php endif;  if ($this->_tpl_vars['projecttypes'][$this->_tpl_vars['pttype']]['ptype_wtype'] == 2 && ! $this->_tpl_vars['item']['ptype_wtype']): ?>
WEB DESIGN
<?php endif;  if ($this->_tpl_vars['projecttypes'][$this->_tpl_vars['pttype']]['ptype_wtype'] == 3 && ! $this->_tpl_vars['item']['ptype_wtype']): ?>
SOCIAL MEDIA
<?php endif;  if ($this->_tpl_vars['projecttypes'][$this->_tpl_vars['pttype']]['ptype_wtype'] == 4 && ! $this->_tpl_vars['item']['ptype_wtype']): ?>
PPC
<?php endif;  if ($this->_tpl_vars['projecttypes'][$this->_tpl_vars['pttype']]['ptype_wtype'] == 5 && ! $this->_tpl_vars['item']['ptype_wtype']): ?>
MARKETING
<?php endif;  if ($this->_tpl_vars['projecttypes'][$this->_tpl_vars['pttype']]['ptype_wtype'] == 6 && ! $this->_tpl_vars['item']['ptype_wtype']): ?>
US
<?php endif; ?>
</td>
<td><?php if ($this->_tpl_vars['auth']['user_admin']):  if ($this->_tpl_vars['item']['project_count'] > 1):  echo $this->_tpl_vars['item']['project_count']; ?>
x<?php endif;  echo $this->_tpl_vars['item']['project_price']; ?>
$<?php if ($this->_tpl_vars['item']['project_ishourly']): ?>/h<?php endif;  endif; ?></td>
<?php $this->assign('pttype', $this->_tpl_vars['item']['project_status']); ?>
<td align="center"><?php echo $this->_tpl_vars['project_phases'][$this->_tpl_vars['pttype']]; ?>
</td>
<td align="center"><?php if ($this->_tpl_vars['auth']['user_admin']):  if ($this->_tpl_vars['item']['project_paid']): ?>Yes<?php else: ?>No<?php endif;  endif; ?></td>
<td align="center"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['project_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
<td align="center"><a href="<?php echo @ROOT_HOST; ?>
projects/edit/<?php echo $this->_tpl_vars['item']['project_id']; ?>
" class="editeaza">Edit</a>&nbsp; <?php if ($this->_tpl_vars['auth']['user_admin']): ?><a href="<?php echo @ROOT_HOST; ?>
projects/delete/<?php echo $this->_tpl_vars['item']['project_id']; ?>
" class="sterge">Delete</a><?php endif; ?></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</tbody>
<tfoot>
<tr><td colspan="10">
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