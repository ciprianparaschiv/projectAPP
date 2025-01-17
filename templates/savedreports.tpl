{include file="inc/top.tpl"}
<div style='padding:10px'>
{assign var=base_url value=$smarty.const.ROOT_HOST|cat:"reports/client/saved/"}
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
			<a title="List users" href="{$smarty.const.ROOT_HOST}reports/client/">Client Reports</a>
		</li>
		<li>
			<a title="List users" href="{$smarty.const.ROOT_HOST}reports/client/saved/"  id="activer">Saved Reports</a>
		</li>
	</ul>	
	<h1 style="top:-25px;position:relative;float:left">&nbsp;</h1>
	</div>
	 <div class="clear"> </div>
	 <br />

		<table class="lister" style="">	
		<thead>
			<tr class="head">
				<td width="20px">#
				</td>
				<td>
					Title
				</td>
				<td>
					Date
				</td>
				<td>
					Price
				</td>
				<td>
					Paid
				</td>
				<td>&nbsp;</td>
			</tr>
		</thead>
		<tbody>
		{foreach name="types" from=$reports item=item key=key}
				<tr>
					<td>{$key}</td>										
					<td><a href="{$base_url}{$item.report_id}">{$item.report_title}</a></td>
					<td>{$item.report_date|date_format}</a></td>
					<td>{$item.report_price} $</td>
					<td>{if $item.report_paid}Yes{else}No{/if}</td>
					<td><a href="freports/{$item.report_id}.pdf"><img src="images/icons/attachment.gif" /></a> 
					<a href="{$base_url}{$item.report_id}/getexcel"><img src="images/icons/excel.gif" /></a> 
					<a class="delete" href="{$base_url}{$item.report_id}/delete">Delete</a></td>
				</tr>
		{/foreach}
		</tbody>
		<tfoot>
			<tr><td colspan="10" align="right">
				Page: 
			{section name=pages start=1 loop=$page_count+1 step=1}
				{assign var=i value=$smarty.section.pages.index}
				<a {if $page==$i}class="cur" {/if} href="{$base_url}?page={$i}">{$i}</a> 
			{/section}
			</td></tr>
		</tfoot>
	</table>
	
</div>

{include file="inc/footer.tpl"}