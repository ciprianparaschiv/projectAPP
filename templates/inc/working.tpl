			<form method="post" action="{$smarty.const.ROOT_HOST}project/{$working.project_id}/stop">
				<label>Working on: {$working.project_name} ({$working.efective|time_format:"%H:%M"})</label> &nbsp;
				<input type="submit" class="small-button stop" value="Stop">
			</form>