{include file="inc/top.tpl"}
<div style='padding:10px'>
{assign var=base_url value=$smarty.const.ROOT_HOST|cat:"reports/client/saved/"}
<div class="content">
	<div class="titler">
	
	<ul id="subnav" style="background-image:none;margin-top:-7px;background:#CFCFCF;">
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}reports/users/">User Reports</a>
			
		</li>
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}reports/client/">Client Reports</a>
		</li>
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}reports/client/saved/"  id="activer">Saved Reports</a>
		</li>
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">{$report.report_title}</h1>
	</div>
	 <div class="clear"> </div>
	 <br />

		<div class="left form">
			<form id="frm" name="frm" action="{$base_url}{$report.report_id}" method="post">
			
	 <table class="two_options">
		<tr>
			<td colspan="2" class="tH">
				<h3>Mark paid?</h3>
			</td>
		</tr>
		
		<tr>
			<td class="t1">
			
			</td>
		</tr>					
		<tr>
			<td colspan="2" class="t5" align="center">			
				<input name="btn" type="submit" value="Mark Paid" class="buttoner"> <a href="{$base_url}" class="buttoner">Cancel</a>
			</td>
		</tr>
	 </table>
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
		{foreach name="types" from=$report.data item=item key=key}
				{if $item|@count==1}
				<tr>
					<td colspan="10" align="left">
						<b>{$item[0]}</b>
					</td>
				</tr>
				{else}
				<tr>
					<td>{$item[0]}</td>
					<td>{$item[1]}</a></td>	
					
					<td>{$item[2]}</td>
					<td>{$item[3]}</td>
					<td>{$item[4]}</td>	
					<td>{$item[5]}</td>					
					<td>{$item[7]}</td>		
					{assign var=pid value=$item[8]}
					<td>{if $report.projects.$pid.project_paid}Yes{else}No{/if}</td>
				</tr>
				{/if}
		{/foreach}
		</tbody>
		<tfoot>
			<tr><td colspan="10" align="right">
			Total: {$report.report_price}$
			
			</td></tr>
		</tfoot>
	</table>
	
</div>

{include file="inc/footer.tpl"}