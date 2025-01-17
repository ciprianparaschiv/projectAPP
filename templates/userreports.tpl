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
			<a title="List users" href="{$smarty.const.ROOT_HOST}reports/users/" id="activer">User Reports</a>

		</li>
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}reports/client/">Client Reports</a>
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

		<label for="report_user">User</label>
		<select name="report[user]" id="report_user">
						{foreach from=$users item=item key=key}
							<option {if $report.user==$key}selected{/if} value="{$item.user_id}">{$item.user_name}</option>
						{/foreach}
		</select>

		<span class="separator">  | </span>

		<label for="report_start">Start date</label>
		<input name="report[start]" id="report_start" value="{$report.start}" size=10 class="date-pick" />

		<label for="report_stop">Stop date</label>
		<input name="report[stop]" id="report_stop" value="{$report.stop}" size=10 class="date-pick" />

		<span class="separator">  | </span>


		<label for="report_price">Show Price</label>
		<select name="report[price]" id="report_price">
			<option {if $report.price=="0"}selected{/if} value="0">No</option>
			<option {if $report.price=="1"}selected{/if} value="1">YES</option>
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
					Client
				</td>
				<td>
					Project name
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
				{if $report.price}
				<td  align="center">
					Price
				</td>
				{/if}
			</tr>
		</thead>
		<tbody>
		{foreach name="types" from=$projects item=item key=key}
				<tr>
					<td>{$smarty.foreach.types.iteration}</td>
					<td>{$item.client}</td>
					<td>{$item.project_name}</a></td>
					<td>{$item.project_date|date_format}</td>
					<td>{$item.project_cdate|date_format}</td>
					<td>{if $item.project_ishourly}{$item.project_worked|time_format:"%Hh %Mm"}{else}-{/if}</td>
					{if $report.price}
					<td>{$item.price}$</td>
					{/if}
				</tr>
		{/foreach}
		</tbody>
		<tfoot>
			<tr><td colspan="10" align="right">
			{if $report.price}Total: {$total}${/if}  Hours:{$hour_number|time_format:"%Hh %Mm"}

			</td></tr>
		</tfoot>
	</table>

</div>

{include file="inc/footer.tpl"}