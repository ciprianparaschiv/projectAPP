	<table class="lister">
		<thead>
			<td>Server</td>
			<td>Scenery</td>
			<td>Status</td>
			<td>Players</td>
			<td>Private</td>
			<td>Server uptime</td>
			<td>Task length</td>
			<td>Flown</td>
			<td>Current leader</td>
		</thead>
		<tbody>
		
		{foreach from=$servers item=item key=key}
			<tr>
				<td>
					<a href="cndr://{$key}">{$item.servername}</a>
				</td>
				<td>{$item.landscape} - {$item.landscapeversion}
				</td>
				<td>
					{$item.textstatus}
				</td>
				<td>
					{$item.users|@count} / {$item.maxuser}
					{foreach from=$item.users item=uitem key=ukey}<br />{$ukey}{/foreach}
				</td>
				<td>
					{$item.private}
				</td>
					
				<td>
					{assign var=secs value=$smarty.now}
					{assign var=start value=$item.starttime}
					{assign var=secs value=$secs-$start}
					 
					{$secs|date_format:"%H:%M:%S"}
				</td>
				<td>
					{$item.tasklength} km
				</td>
				<td>
					{$item.flown} km
				</td>
				<td>
					{$item.leader}
				</td>
			</tr>
		{/foreach}
	</tbody>
	</table>