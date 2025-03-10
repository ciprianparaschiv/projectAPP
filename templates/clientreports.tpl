{include file="inc/top.tpl"}
<div style='padding:10px'>
{assign var=base_url value=$smarty.const.ROOT_HOST|cat:"project/"|cat:$project.project_id|cat:"/"}
<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
<li>
   <a title="List users" href="{$smarty.const.ROOT_HOST}reports/special/">Special Reports</a>

  </li>		
<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}reports/users/">User Reports</a>
			
		</li>
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}reports/client/"  id="activer">Client Reports</a>
		</li>
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}reports/client/saved/">Saved Reports</a>
		</li>
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">&nbsp;</h1>
	</div>
	 <div class="clear"> </div>
	 <br />

	 <div class="filter">
		<form method="post">
		<fieldset>
			<legend>Filters</legend>
		
		<label for="report_user">Client</label>
		<select name="report[client]" id="report_client">
						{assign var="curcont" value="0"}
						{foreach from=$clients item=item key=key}
							{if $item.contractor_id!=$curcont}
								<option {if $report.client==$item.contractor_id}selected{/if} value="{$item.contractor_id}">{$item.contractor_name}</option>
								{assign var="curcont" value=$item.contractor_id}
							{/if}
							{assign var='cur_cli' value=$curcont|cat:"_"|cat:$key}
							<option {if $report.client==$cur_cli}selected{/if} value="{$cur_cli}">&nbsp;&nbsp;{$item.client_name}</option>
						{/foreach}
		</select>
		
		<span class="separator">  | </span>
		
		<label for="report_start">Start date</label>
		<input name="report[start]" id="report_start" value="{$report.start}" size=10 class="date-pick" />
		
		<label for="report_stop">Stop date</label>
		<input name="report[stop]" id="report_stop" value="{$report.stop}" size=10 class="date-pick" />
		
		<span class="separator">  | </span>
		
		
		<label for="report_type">Type</label>
		<select name="report[type]" id="report_type">	
					<option value="">Any</option>
			{foreach from=$PROJECT_WTYPES item=item key=key}
					<option {if $report.type==$key}selected{/if} value="{$key}">{$item}</option>
			{/foreach}
			
		</select>
		<span class="separator">  | </span>
		
				<label for="project_type">Project Type</label>
				
		<select name="report[ptype]" id="project_type">	
					<option value="">Any</option>
			{foreach from=$project_types item=item key=key}					
					<option {if $report.ptype==$key}selected{/if} value="{$key}">{$item.ptype_name}</option>
			{/foreach}
			
		</select>
		<span class="separator">  | </span>
		
		<label for="report_paid">Paid</label>
		<select name="report[paid]" id="report_paid">	
					<option value="">Any</option>
					<option {if $report.paid=="0"}selected{/if} value="0">No</option>
					<option {if $report.paid=="1"}selected{/if} value="1">YES</option>
			
		</select>
		<input type="submit" class="buttoner" name="submit" value="Generate"/>		
		<input type="submit" class="buttoner" name="submit" value="PDF"/>		
		</fieldset>
		</form>
		
	 </div>	
	 		<table class="lister" style="">	
		<thead>
			<tr class="head">
				<td width="20px">#
				</td>
				<td>
					Project name
				</td>
				<td>
					Type
				</td>
				<td>
					Project date
				</td>
				<td>
					Project completed
				</td>
				<td  align="center">
					Hours worked
				</td>
				
				<td  align="center">
					Price
				</td>				
				<td  align="center">
					Paid
				</td>				
			</tr>
		</thead>
		<tbody>
		{assign var=client value=""}
		{foreach name="types" from=$projects item=item key=key}	
				{if $client!=$item.client}
				<tr>
					<td colspan="10" align="left">
						<b>{$item.client}</b>
					</td>
				</tr>
					{assign var=client value=$item.client}
				{/if}
				<tr>
					<td>{$smarty.foreach.types.iteration}</td>
					<td>{$item.project_name}</a></td>	
					{assign var=pttype value=$item.project_type}
					<td>{$project_types.$pttype.ptype_name}</td>
					<td>{$item.project_date|date_format}</td>
					<td>{$item.project_cdate|date_format}</td>	
					<td>{if $item.project_ishourly}{$item.project_worked|time_format:"%Hh %Mm"}{else}-{/if}</td>					
					<td>{$item.price}$</td>										
					<td>{if $item.project_paid}Yes{else}No{/if}</td>
				</tr>
		{/foreach}
		</tbody>
		<tfoot>
			<tr><td colspan="10" align="right">
			Total: {$total}$
			
			</td></tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td style="text-align: left;">{$hour|time_format:"%Hh %Mm"}</td>
</tr>
		</tfoot>
	</table>
	
</div>

{include file="inc/footer.tpl"}