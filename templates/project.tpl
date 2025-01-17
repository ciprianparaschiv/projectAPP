{include file="inc/top.tpl"}
<div style='padding:10px'>
{assign var=base_url value=$smarty.const.ROOT_HOST|cat:"project/"|cat:$project.project_id|cat:"/"}
<!-- -->
<div class="content">
	<div class="titler">


	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
{if $smarty.session.auth.user_admin==1 || $smarty.session.auth.user_subadmin==1}
<li>
			<a title="List users" href="https://www.officialbranding.org/project/projects/edit/{php} echo  explode('/',$_SERVER['REQUEST_URI'])[3]; {/php}">Edit</a>
		</li>
{/if}
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}myprojects/">Projects List</a>
		</li>
		<li>
			<a title="" href="{$smarty.const.ROOT_HOST}project/{$project.project_id}" id="activer" >{$project.project_name}</a>
		</li>
	</ul>
	<h1 style="top:-25px;position:relative;float:left">{$project.client_name} - {$project.project_name}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />
	 <div class="project_dashboard">
		<fieldset>
			<legend>Project info</legend>
			<div class="left project_description">
			{$project.project_description|regex_replace:" @((([[:alnum:]]+)://|www\.)([^[:space:]]*)([[:alnum:]#?/&=]))@":" <a href=\"\\1\" target=\"_blank\" >\\1</a>"|nl2br}
			{if $project.files}
			<br /> <hr />
			{foreach from=$project.files item=item key=key}
							<a class="file" href="{$base_url}download/{$item.file_id}">{$item.file_name}</a>
			{/foreach}
			{/if}
			</div>
			<div class="left project_info">
				<p>Date Added: {$project.project_date|date_format}</p>
				<p>Client: {$project.client_name}</p>
				<form method="post" action="{$base_url}change">
				<p>Status:
					{if $project.project_status!=$smarty.const.PS_COMPLETED || $auth.user_admin==1 || $auth.user_subadmin==1 }
						<select class="texter" name="project_status" id="project_status">
							{foreach from=$project_phases item=item key=key}
								<option value="{$key}" {if $key==$project.project_status}selected{/if}>{$item}</option>
							{/foreach}
						</select>
						<input class="save small-button" type="submit" value="Change">

					{else}
						Completed
					{/if}
				</p>
				</form>
				{assign var=pttype value=$project.project_priority}
				<p>Priority: {$project_priorities.$pttype}</p>
				{if $project.project_ishourly}
				<form method="post" action="{$base_url}{if $project.started}stop{else}start{/if}">
				<p>
					Timing: {$project.timing|time_format:"%Hh %Mmin"}
					{if $project.project_status!=$smarty.const.PS_COMPLETED}
						{if $project.started}
							<input type="submit" class="small-button stop" value="Stop" />
						{else}
							<input type="submit" class="small-button start" value="Start" />
						{/if}
					{/if}
				</p>
				<p>
					{foreach from=$project.timings item=item key=key}
						{$project.users.$key} - {$item|time_format:"%H:%M"}<br />
					{/foreach}
				</p>
				</form>
				{/if}
{if $smarty.session.auth.user_admin==1 || $smarty.session.auth.user_subadmin==1}
<p><input type="checkbox" name="user_respons" value="{$smarty.session.auth.user_id}" id="user_respons_sent" style="margin:0;" {if $project.project_sent==1}checked{/if}>Set as reviewed and sent to the client
<input type="hidden" value="{$project.project_id}" id="id_project"

</p>
{/if}
			</div>
			<div class="clear"> </div>
		</fieldset>
	</div>

	{if $project.project_ishourly}
		<div class="project_dashboard">
			<fieldset>
				<legend>Edit timings</legend>
					<table class="lister" style="width:400px">
					<tr><th>Date</th><th>User</th><th>Time</th><th>New time</th><th>&nbsp</th></tr>
					{foreach from=$project.alltimings item=item key=key}
						{if $item.delta}
						<tr>
							{assign var=tuser value=$item.timing_user}
							<td>{$item.timing_start|date_format}</td><td>{$project.users.$tuser}</td> <td>{$item.delta|time_format:"%H:%M"}</td>
							{if !$item.timing_open}
							<form action="{$base_url}/timing/" method="post">
							<input type="hidden" name="tid" value="{$item.timing_id}" />
							<td><input class="texter" type="text" name="timing" size="2" value="{$item.delta|time_format:"%H:%M"}"></td>
							<td><input type=submit class="small-button save" value="Save"></td>
							</form>
							{else}
								<td colspan=2>&nbsp;</td>
							{/if}
						</tr>
						{/if}
					{/foreach}
					</table>
			</fieldset>
		</div>
	{/if}

		<div class="project_dashboard">
		<fieldset>
			<legend>Messages</legend>
			<div class="addmessage text-center">
				<form method="POST" enctype="multipart/form-data" id="frm"  name="frm" action='{$base_url}post/'>
				<fieldset>
					<img src="images/icons/user.png" class="left">
					<div class="left">
						<div class="left">

						<textarea id="message" name="message" class="texter required" cols="80" rows="2"></textarea>
						</div>
						<div class="left">
							<a id="btn_Add" href="javascript:;" onClick="return addFileField('project_file',' ');" class="buttoner">Add File field</a>

							<a id="btn_Send" style='display:none' href="javascript:;" onClick="MsgSend();frm.submit();return(false);" class="buttoner">Send Message</a>

							<a id="btn_Cancel" style='display:none' "href="{$base_url}" class="buttoner">Cancel</a>
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
			{foreach from=$project.messages item=item key=key}
			{if $item.message_type==1}
			<fieldset>
				<legend>{if $auth.user_admin>0}<a href="{$base_url}rm/{$item.message_id}" class="right sterge" style=""><img src="images/icons/sterge.gif"></a>{/if} On {$item.message_time|date_format} {$item.user} said:  </legend>
				{assign var=mid value=$item.message_id}
				{if $project.mfiles.$mid}
				<div class="right" style="width:200px;border:dashed 1px;padding:10px;">

					{foreach from=$project.mfiles.$mid item=fitem key=fkey}
						<a class="file" href="{$base_url}download/{$fkey}">{$fitem.file_name}</a>
					{/foreach}
				</div>
				{/if}
				<p>

				{$item.message_text|regex_replace:" @((([[:alnum:]]+)://|www\.)([^[:space:]]*)([[:alnum:]#?/&=]))@":" <a href=\"\\1\" target=\"_blank\" >\\1</a>"|nl2br}
				</p>
			</fieldset>
			{else}
			<div class="notice">
				{$item.message_time|date_format} &rarr; <strong>{$item.user}</strong>: {$item.message_text}
			</div>
			{/if}
			{/foreach}
		</fieldset>
	</div>


</div>
<script type="javascript">

</script>
{include file="inc/footer.tpl"}
