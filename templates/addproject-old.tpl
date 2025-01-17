{include file="inc/top.tpl"}
<div style='padding:10px'>

<div class="content">
	<div class="titler">

	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}projects/"  >Projects List</a>
		</li>

		<li>
			<a title="Add Project" href="{$smarty.const.ROOT_HOST}projects/add/" id="activer">Add Project</a>
		</li>
		{if $auth.user_admin}
		<li>
			<a title="User types" href="{$smarty.const.ROOT_HOST}projects/types/" >Project types</a>
		</li>
		{/if}
	</ul>
	<h1 style="top:-25px;position:relative;float:left">{$subtitle}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />

	<div class="form center" style="width:600px !important">
	<form id="frm" name="frm" action="projects/edit/" method="post" enctype="multipart/form-data">
	{if $project}<input type="hidden" name="pid" value="{$project.project_id}">{/if}
	 <table class="two_options">
		<tr>
			<td colspan="2" class="tH">
				<h3>{if $project}Edit{else}Add{/if} Project</h3>
			</td>
		</tr>
		<tr>
			<td class="t1">
				Client
			</td>
			<td class="t2">
				<select class="texter required" name="project_client" id="project_client">
					<option value="">Select</option>
						{foreach from=$clients item=item key=key}
							<option {if $project.project_client==$key}selected{/if} value="{$item.client_id}">{$item.client_name}</option>
						{/foreach}
				</select>
			</td>
		</tr>
		<tr>
			<td class="t1">
				Name
			</td>
			<td class="t2">
				<input type="text" id="project_name" class="texter required" name="project_name" size="40" value="{$project.project_name}" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Job Number
			</td>
			<td class="t2">
				<input type="text" id="project_job" class="texter" name="project_job" value="{$project.project_job}" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Description
			</td>
			<td class="t2">
				<textarea rows="5" cols="80" id="project_description" class="texter required"  name="project_description">{$project.project_description}</textarea>
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
				{if $project.project_files}
					<div class="clear"></div>
					{foreach from=$project.project_files item=item key=key}
						<a href="project/{$project.project_id}/download/{$item.file_id}">{$item.file_name}</a> <a href="projects/edit/{$project.project_id}/delete/{$item.file_id}" class="delete">Delete</a> <br />
					{/foreach}
				{/if}
			</td>
		</tr>
		<tr>
			<td class="t1">
				Project Type
			</td>
			<td class="t2">
				<select class="texter required" name="project_type" id="project_type">
					<option value="">Select</option>

						{foreach from=$projecttypes item=item key=key}
							{assign var="ptype" value=$item.ptype_rtype}
							<option type='{$item.ptype_wtype}'  hourly="{$PROJECT_TYPES.$ptype.hourly}" price='{$item.ptype_price}' {if $project.project_type==$key}selected{/if} value="{$item.ptype_id}">{$item.ptype_name}</option>
						{/foreach}
				</select>
			</td>
		</tr>
		<tr>
		<td class="t1">
		 Time Frame
			</td>
				<td class="t2">

<select id="time_frame" name="project_time_frame" class="texter required valid">
<option time_work="12" value="1" {if $project.project_time_frame==1} selected {/if}>Landing page</option/>
<option time_work="15" value="2" {if $project.project_time_frame==2} selected {/if}>Pillar page</option/>
<option time_work="15" value="3" {if $project.project_time_frame==3} selected {/if}>Competition</option/>
<option time_work="30" value="4" {if $project.project_time_frame==4} selected {/if}>Blog</option/>
<option time_work="4" value="5" {if $project.project_time_frame==5} selected {/if}>Optimisation</option/>
<option time_work="100" value="6" {if $project.project_time_frame==6} selected {/if}>Small website</option/>
<option time_work="150" value="7" {if $project.project_time_frame==7} selected {/if}>Medium website</option/>
<option time_work="200" value="8" {if $project.project_time_frame==8} selected {/if}>Large website</option/>
<option time_work="custom" value="0" {if $project.project_time_frame==0} selected {/if}>Custom</option/>
</select>

			</td>
		</tr>
				<tr  class="">
		<td class="t1">
	Department
			</td>
				<td class="t2">
<input type="text"  name="project_department" value="{if $project.project_department}{$project.project_department}  {/if}" class="texter "/>
			</td>
		</tr>
		
		<tr  class="custom_time_frame">
		<td class="t1">
	Custom Time
			</td>
				<td class="t2">
<input type="text" id="custom_time_frame" name="project_custom_time_frame" value="{if $project.project_custom_time_frame}{$project.project_custom_time_frame}  {/if}" class="texter "/>
			</td>
		</tr>
		<tr>
		<td class="t1">
		  Work Type
			</td>
						<td class="t2">

<select id="ptype_wtype" name="ptype_wtype" class="texter required valid">
{foreach from=$projecttypes item=item key=key}
{assign var="ptype" value=$item.ptype_rtype}
{if $project.ptype_wtype}

{if $project.ptype_wtype==1 && $project.project_type==$key}
<option value="">Select</option>
<option value="1" selected>SEO</option>
<option value="2">WEB DESIGN</option>
<option value="3">SOCIAL MEDIA</option>
<option value="4">PPC</option>
<option value="5" >MARKETING</option>
<option value="6" >US</option>
{/if}

{if $project.ptype_wtype==2 && $project.project_type==$key}
<option value="">Select</option>
<option value="1">SEO</option>
<option value="2" selected>WEB DESIGN</option>
<option value="3">SOCIAL MEDIA</option>
<option value="4">PPC</option>
<option value="5" >MARKETING</option>
<option value="6" >US</option>
{/if}

{if $project.ptype_wtype==3 && $project.project_type==$key}
<option value="">Select</option>
<option value="1">SEO</option>
<option value="2">WEB DESIGN</option>
<option value="3" selected>SOCIAL MEDIA</option>
<option value="4">PPC</option>
<option value="5" >MARKETING</option>
<option value="6" >US</option>
{/if}

{if $project.ptype_wtype==4 && $project.project_type==$key}
<option value="">Select</option>
<option value="1">SEO</option>
<option value="2">WEB DESIGN</option>
<option value="3">SOCIAL MEDIA</option>
<option value="4" selected>PPC</option>
<option value="5" >MARKETING</option>
<option value="6" >US</option>
{/if}

{if $project.ptype_wtype==5 && $project.project_type==$key}
<option value="">Select</option>
<option value="1">SEO</option>
<option value="2">WEB DESIGN</option>
<option value="3">SOCIAL MEDIA</option>
<option value="4" >PPC</option>
<option value="5" selected>MARKETING</option>
<option value="6" >US</option>
{/if}

{if $project.ptype_wtype==6 && $project.project_type==$key}
<option value="">Select</option>
<option value="1">SEO</option>
<option value="2">WEB DESIGN</option>
<option value="3">SOCIAL MEDIA</option>
<option value="4">PPC</option>
<option value="5">MARKETING</option>
<option value="6" selected>US</option>
{/if}

{else}

{if $item.ptype_wtype==1 && $project.project_type==$key}
<option value="">Select</option>
<option value="1" selected>SEO</option>
<option value="2">WEB DESIGN</option>
<option value="3">SOCIAL MEDIA</option>
<option value="4">PPC</option>
<option value="5" >MARKETING</option>
<option value="6" >US</option>
{/if}

{if $item.ptype_wtype==2 && $project.project_type==$key}
<option value="">Select</option>
<option value="1" >SEO</option>
<option value="2" selected>WEB DESIGN</option>
<option value="3">SOCIAL MEDIA</option>
<option value="4">PPC</option>
<option value="5" >MARKETING</option>
<option value="6" >US</option>
{/if}

{if $item.ptype_wtype==3 && $project.project_type==$key}
<option value="">Select</option>
<option value="1" >SEO</option>
<option value="2" >WEB DESIGN</option>
<option value="3" selected>SOCIAL MEDIA</option>
<option value="4">PPC</option>
<option value="5" >MARKETING</option>
<option value="6" >US</option>
{/if}
{if $item.ptype_wtype==4 && $project.project_type==$key}
<option value="">Select</option>
<option value="1" >SEO</option>
<option value="2" >WEB DESIGN</option>
<option value="3" >SOCIAL MEDIA</option>
<option value="4" selected>PPC</option>
<option value="5" >MARKETING</option>
<option value="6" >US</option>
{/if}

{if $item.ptype_wtype==5 && $project.project_type==$key}
<option value="">Select</option>
<option value="1" >SEO</option>
<option value="2" >WEB DESIGN</option>
<option value="3" >SOCIAL MEDIA</option>
<option value="4" >PPC</option>
<option value="5"  selected>MARKETING</option>
<option value="6" >US</option>
{/if}

{if $item.ptype_wtype==6 && $project.project_type==$key}
<option value="">Select</option>
<option value="1" >SEO</option>
<option value="2" >WEB DESIGN</option>
<option value="3" >SOCIAL MEDIA</option>
<option value="4" >PPC</option>
<option value="5" >MARKETING</option>
<option value="6" selected>US</option>
{/if}

{/if}
{/foreach}

{if !$project.project_id}
<option value="add">Select</option>
<option value="1" >SEO</option>
<option value="2" >WEB DESIGN</option>
<option value="3" >SOCIAL MEDIA</option>
<option value="4" >PPC</option>
<option value="5" >MARKETING</option>
<option value="6" >US</option>
{/if}

</select>
			</td>
		</tr>
{if $auth.user_admin}
		<tr>
			<td class="t1">
				Price
			</td>
			<td class="t2">
				<input type="text" id="project_price" class="texter required number" name="project_price" value="{$project.project_price}" />
			</td>
		</tr>
		<tr>
			<td class="t1">
				Hourly
			</td>
			<td class="t2">
				<input type="checkbox" id="project_ishourly" class="texter" name="project_ishourly" value="1" {if $project.project_ishourly==1}checked="checked"{/if} />
			</td>
		</tr>
{/if}
		<tr>
			<td class="t1">
				Quantity
			</td>
			<td class="t2">
				<input type="text" id="project_count" class="texter required digits" name="project_count" value="{$project.project_count}" />
			</td>
		</tr>
{if $auth.user_admin}
		<tr>
			<td class="t1">
				Is Paid
			</td>
			<td class="t2">
				<input type="checkbox" id="project_paid" class="texter" name="project_paid" value="1" {if $project.project_paid==1}checked="checked"{/if} />
			</td>
		</tr>
{else}
<tr>
	<td colspan="2">
	<input type="hidden" id="project_price" name="project_price" value="{$project.project_price}" />
	<input type="hidden" id="project_ishourly" name="project_ishourly" value="{$project.project_ishourly}" />
	<input type="hidden" id="project_paid" name="project_paid" value="{$project.project_paid}" />
	</td>
</tr>
{/if}
		<tr>
			<td class="t1">
				Assigned people
			</td>
			<td class="t2">
				<select class="texter required sasmselect" multiple="multiple" name="project_users[]" id="project_users" title="Select users">
						{foreach from=$users item=item key=key}
							<option {if $project.project_users.$key}selected{/if} value="{$item.user_id}">{$item.user_name}</option>
						{/foreach}
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
						{foreach from=$users item=item key=key}
						{if $item.user_subadmin==1 || $item.user_admin==1}
							<option  {if $project.project_users_responsable==$item.user_id}selected{/if} value="{$item.user_id}">{$item.user_name}</option>
						{/if}
						{/foreach}
			</td>
		</tr>

		<tr>
			<td class="t1">
				Phase
			</td>
			<td class="t2">
				<select class="texter required" name="project_status" id="project_status">
					<option value="">Select</option>
						{foreach from=$project_phases item=item key=key}
							<option {if $project.project_status==$key}selected{/if} value="{$key}">{$item}</option>
						{/foreach}
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
						{foreach from=$project_priorities item=item key=key}
							<option {if $project.project_priority==$key}selected{/if} value="{$key}">{$item}</option>
						{/foreach}
				</select>
			</td>
		</tr>

		<tr>
			<td colspan="2" class="t5" align="center">
				<input type="submit" value="{if $project}Save{else}Add{/if}" class="buttoner"> <a href="{$smarty.const.ROOT_HOST}projects/" class="buttoner">Cancel</a>
			</td>
		</tr>
	 </table>
	 </form>
	</div>


</div>
{literal}
	<script>
		$('#time_frame').change(function(){


				$("#time_frame option:selected").each(function () {
					valuechange=$(this).attr('time_work');
       if($(this).val()=="0") { /*$(".custom_time_frame").show();*/ $("#custom_time_frame").val(''); } else { /*$(".custom_time_frame").hide();*/  $("#custom_time_frame").val(valuechange); }
				});
		});


		$("#project_type").change(
			function() {
				$("#project_type option:selected").each(function () {

					$("#project_price").val($(this).attr("price"));
					$("#ptype_wtype").attr('selectedIndex', $(this).attr('type'));

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
{/literal}
{include file="inc/footer.tpl"}
