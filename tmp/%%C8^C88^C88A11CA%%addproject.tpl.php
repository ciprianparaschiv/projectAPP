<?php /* Smarty version 2.6.12, created on 2024-10-01 16:03:58
         compiled from addproject.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='padding:10px'>
<div class="content">
<div class="titler">
<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
<li>
<a title="List users" href="<?php echo @ROOT_HOST; ?>
projects/"  >Projects List</a>
</li>
<li>
<a title="Add Project" href="<?php echo @ROOT_HOST; ?>
projects/add/" id="activer">Add Project</a>
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
<div class="form center" style="width:650px !important">
<form id="frm" name="frm" action="projects/edit/" method="post" enctype="multipart/form-data">
<?php if ($this->_tpl_vars['project']): ?><input type="hidden" name="pid" value="<?php echo $this->_tpl_vars['project']['project_id']; ?>
"><?php endif; ?>
<table class="two_options">
<tr>
<td colspan="2" class="tH">
<h3><?php if ($this->_tpl_vars['project']): ?>Edit<?php else: ?>Add<?php endif; ?> Project</h3>
</td>
</tr>
<tr>
<td class="t1">
Client
</td>
<td class="t2">
<select class="texter required" name="project_client" id="project_client">
<option value="">Select</option>
<?php $_from = $this->_tpl_vars['clients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['project']['project_client'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['client_id']; ?>
"><?php echo $this->_tpl_vars['item']['client_name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>
<tr>
<td class="t1">
Harvest
</td>
<td class="t2">
<select class="texter " name="project_client_harvest" id="project_client_harvest">
<option value="">Select</option>
<?php $_from = $this->_tpl_vars['clients_harvest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['project']['project_client_harvest'] == $this->_tpl_vars['item']['project_harvest_id']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['project_harvest_id']; ?>
"><?php echo $this->_tpl_vars['item']['project_harvest_name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>
<tr>
<td class="t1">
Name
</td>
<td class="t2">
<input type="text" id="project_name" class="texter required" name="project_name" size="40" value="<?php echo $this->_tpl_vars['project']['project_name']; ?>
" />
</td>
</tr>
<tr>
<td class="t1">
Job Number
</td>
<td class="t2">
<input type="text" id="project_job" class="texter" name="project_job" value="<?php echo $this->_tpl_vars['project']['project_job']; ?>
" />
</td>
</tr>
<tr>
<td class="t1">
Description
</td>
<td class="t2">
<textarea rows="5" cols="80" id="project_description" class="texter required"  name="project_description"><?php echo $this->_tpl_vars['project']['project_description']; ?>
</textarea>
</td>
</tr>
<tr>
<td class="t1">
File
</td>
<td class="t2">
<div class="left inputfiles">
<input type="file" id="project_file" class="texter" name="project_file[]" />
</div>
<div class="left" style='padding:5px'>
<a href="javascript:;" onClick="return addFileField('project_file','<br />');" class="buttoner">Add field</a>
</div>
<?php if ($this->_tpl_vars['project']['project_files']): ?>
<div class="clear"></div>
<?php $_from = $this->_tpl_vars['project']['project_files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<a href="project/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/download/<?php echo $this->_tpl_vars['item']['file_id']; ?>
"><?php echo $this->_tpl_vars['item']['file_name']; ?>
</a> <a href="projects/edit/<?php echo $this->_tpl_vars['project']['project_id']; ?>
/delete/<?php echo $this->_tpl_vars['item']['file_id']; ?>
" class="delete">Delete</a> <br />
<?php endforeach; endif; unset($_from);  endif; ?>
</td>
</tr>
<tr>
<td class="t1">
Project Type
</td>
<td class="t2">
<select class="texter required" name="project_type" id="project_type">
<option value="">Select</option>
<?php $_from = $this->_tpl_vars['projecttypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
 $this->assign('ptype', $this->_tpl_vars['item']['ptype_rtype']); ?>
<option type='<?php echo $this->_tpl_vars['item']['ptype_wtype']; ?>
'  hourly="<?php echo $this->_tpl_vars['PROJECT_TYPES'][$this->_tpl_vars['ptype']]['hourly']; ?>
" price='<?php echo $this->_tpl_vars['item']['ptype_price']; ?>
' <?php if ($this->_tpl_vars['project']['project_type'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['ptype_id']; ?>
"><?php echo $this->_tpl_vars['item']['ptype_name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>
<tr>
<td class="t1">
Time Frame
</td>
<td class="t2">
<select id="time_frame" name="project_time_frame" class="texter required valid">
<option time_work="12" value="1" <?php if ($this->_tpl_vars['project']['project_time_frame'] == 1): ?> selected <?php endif; ?>>Landing page</option/>
<option time_work="15" value="2" <?php if ($this->_tpl_vars['project']['project_time_frame'] == 2): ?> selected <?php endif; ?>>Pillar page</option/>
<option time_work="15" value="3" <?php if ($this->_tpl_vars['project']['project_time_frame'] == 3): ?> selected <?php endif; ?>>Competition</option/>
<option time_work="30" value="4" <?php if ($this->_tpl_vars['project']['project_time_frame'] == 4): ?> selected <?php endif; ?>>Blog</option/>
<option time_work="4" value="5" <?php if ($this->_tpl_vars['project']['project_time_frame'] == 5): ?> selected <?php endif; ?>>Optimisation</option/>
<option time_work="100" value="6" <?php if ($this->_tpl_vars['project']['project_time_frame'] == 6): ?> selected <?php endif; ?>>Small website</option/>
<option time_work="150" value="7" <?php if ($this->_tpl_vars['project']['project_time_frame'] == 7): ?> selected <?php endif; ?>>Medium website</option/>
<option time_work="200" value="8" <?php if ($this->_tpl_vars['project']['project_time_frame'] == 8): ?> selected <?php endif; ?>>Large website</option/>
<option time_work="custom" value="0" <?php if ($this->_tpl_vars['project']['project_time_frame'] == 0): ?> selected <?php endif; ?>>Custom</option/>
</select>
</td>
</tr>
<tr  class="">
<td class="t1">
Department
</td>
<td class="t2">
<input type="text"  name="project_department" value="<?php if ($this->_tpl_vars['project']['project_department']):  echo $this->_tpl_vars['project']['project_department']; ?>
  <?php endif; ?>" class="texter "/>
</td>
</tr>
<tr  class="custom_time_frame">
<td class="t1">
Custom Time
</td>
<td class="t2">
<input type="text" id="custom_time_frame" name="project_custom_time_frame" value="<?php if ($this->_tpl_vars['project']['project_custom_time_frame']):  echo $this->_tpl_vars['project']['project_custom_time_frame']; ?>
  <?php endif; ?>" class="texter "/>
</td>
</tr>
<tr>
<td class="t1">
Work Type
</td>
<td class="t2">
<select id="ptype_wtype" name="ptype_wtype" class="texter required valid">
<option value="">Select</option>
<option value="1" selected>SEO</option>
<option value="2">WEB DESIGN</option>
<option value="3">SOCIAL MEDIA</option>
<option value="4">PPC</option>
<option value="5" >MARKETING</option>
<option value="6" >US</option>
</select>
</td>
</tr>
<?php if ($this->_tpl_vars['auth']['user_admin']): ?>
<tr>
<td class="t1">
Price
</td>
<td class="t2">
<input type="text" id="project_price" class="texter required number" name="project_price" value="<?php echo $this->_tpl_vars['project']['project_price']; ?>
" />
</td>
</tr>
<tr>
<td class="t1">
Hourly
</td>
<td class="t2">
<input type="checkbox" id="project_ishourly" class="texter" name="project_ishourly" value="1" <?php if ($this->_tpl_vars['project']['project_ishourly'] == 1): ?>checked="checked"<?php endif; ?> />
</td>
</tr>
<?php endif; ?>
<tr>
<td class="t1">
Quantity
</td>
<td class="t2">
<input type="text" id="project_count" class="texter required digits" name="project_count" value="<?php echo $this->_tpl_vars['project']['project_count']; ?>
" />
</td>
</tr>
<?php if ($this->_tpl_vars['auth']['user_admin']): ?>
<tr>
<td class="t1">
Is Paid
</td>
<td class="t2">
<input type="checkbox" id="project_paid" class="texter" name="project_paid" value="1" <?php if ($this->_tpl_vars['project']['project_paid'] == 1): ?>checked="checked"<?php endif; ?> />
</td>
</tr>
<?php else: ?>
<tr>
<td colspan="2">
<input type="hidden" id="project_price" name="project_price" value="<?php echo $this->_tpl_vars['project']['project_price']; ?>
" />
<input type="hidden" id="project_ishourly" name="project_ishourly" value="<?php echo $this->_tpl_vars['project']['project_ishourly']; ?>
" />
<input type="hidden" id="project_paid" name="project_paid" value="<?php echo $this->_tpl_vars['project']['project_paid']; ?>
" />
</td>
</tr>
<?php endif; ?>
<tr>
<td class="t1">
Assigned people
</td>
<td class="t2">
<select class="texter required sasmselect" multiple="multiple" name="project_users[]" id="project_users" title="Select users">
<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['project']['project_users'][$this->_tpl_vars['key']]): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['user_id']; ?>
"><?php echo $this->_tpl_vars['item']['user_name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>
<tr>
<td class="t1">
Responsable persons
</td>
<td class="t2">
<select class="texter required "  name="project_users_responsable" id="" title="Select users">
<option value="">Any</option>
<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
 if ($this->_tpl_vars['item']['user_subadmin'] == 1 || $this->_tpl_vars['item']['user_admin'] == 1): ?>
<option  <?php if ($this->_tpl_vars['project']['project_users_responsable'] == $this->_tpl_vars['item']['user_id']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['user_id']; ?>
"><?php echo $this->_tpl_vars['item']['user_name']; ?>
</option>
<?php endif;  endforeach; endif; unset($_from); ?>
</td>
</tr>
<tr>
<td class="t1">
Phase
</td>
<td class="t2">
<select class="texter required" name="project_status" id="project_status">
<option value="">Select</option>
<?php $_from = $this->_tpl_vars['project_phases']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['project']['project_status'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>
<tr>
<td class="t1">
Priority
</td>
<td class="t2">
<select class="texter required" name="project_priority" id="project_priority">
<option value="">Select</option>
<?php $_from = $this->_tpl_vars['project_priorities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['project']['project_priority'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>
<tr>
<td colspan="2" class="t5" align="center">
<input type="submit" value="<?php if ($this->_tpl_vars['project']): ?>Save<?php else: ?>Add<?php endif; ?>" class="buttoner"> <a href="<?php echo @ROOT_HOST; ?>
projects/" class="buttoner">Cancel</a>
</td>
</tr>
</table>
</form>
</div>
</div>
<?php echo '
<script>
		$(\'#time_frame\').change(function(){


				$("#time_frame option:selected").each(function () {
					valuechange=$(this).attr(\'time_work\');
       if($(this).val()=="0") { /*$(".custom_time_frame").show();*/ $("#custom_time_frame").val(\'\'); } else { /*$(".custom_time_frame").hide();*/  $("#custom_time_frame").val(valuechange); }
				});
		});


		$("#project_type").change(
			function() {
				$("#project_type option:selected").each(function () {

					$("#project_price").val($(this).attr("price"));
					$("#ptype_wtype").attr(\'selectedIndex\', $(this).attr(\'type\'));

					if($(this).attr("hourly")==1) {
						$("#project_ishourly").val(1);
						$("#project_ishourly").attr("checked",true);
					} else {
						$("#project_ishourly").val(0);
						$("#project_ishourly").attr("checked",false);
					}
				});

			}
		)
	</script>
'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>