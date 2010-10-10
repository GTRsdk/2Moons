{include file="overall_header.tpl"}
{include file="overall_topnav.tpl"}
{include file="left_menu.tpl"}
<div id="content" class="content">
	{if !$NotBuilding}<span style="color:red">{$bd_building_shipyard}</span><br>{/if}
	{if $BuildList != '[]'}
    <table>
		<tr>
			<td class="transparent">
				<div id="bx" class="z"></div>
				<br>
				<form method="POST" action="">
				<input type="hidden" name="mode" value="fleet">
				<input type="hidden" name="action" value="delete">
				<table>
				<tr>
					<th>&nbsp;</th>
				</tr>
				<tr>
					<td><select name="auftr[]" id="auftr" size="10" multiple><option>&nbsp;</option></select><br><br>{$bd_cancel_warning}<br><input type="Submit" value="{$bd_cancel_send}"></td>
				</tr>
				<tr>
					<th>&nbsp;</th>
				</tr>
				</table>
				</form>
				<br><span id="timeleft"></span><br><br>
			</td>
		</tr>
    </table>
	<br>
	{/if}
	<form action="" method="POST">
    <table>	
		{foreach name=DefenseList item=DefenseListRow from=$DefenseList}
		<tr>
			<td rowspan="2" style="width:120px;">
				<a href="javascript:OpenPopup('game.php?page=infos&gid={$DefenseListRow.id}', '', 640, 510);">
					<img src="{$dpath}gebaeude/{$DefenseListRow.id}.gif" alt="{$DefenseListRow.name}" width="120" height="120">
				</a>
			</td>
			<th>
				<a href="javascript:OpenPopup('game.php?page=infos&gid={$DefenseListRow.id}', '', 640, 510);">{$DefenseListRow.name}</a>{if $DefenseListRow.Available != 0} ({$bd_available} {$DefenseListRow.Available}){/if}
			</th>
		</tr>
		<tr>
			<td>
				<table style="width:100%">
					<tr>
						<td class="transparent left" style="width:90%;padding:10px;">{$DefenseListRow.descriptions}<br><br>{$DefenseListRow.price}</td>
						<td class="transparent" style="vertical-align:middle;width:100px">
						{if $DefenseListRow.AlreadyBuild}<span style="color:red">{$bd_protection_shield_only_one}</span>{elseif $NotBuilding && $DefenseListRow.IsAvailable}<input type="text" name="fmenge[{$DefenseListRow.id}]" id="input_{$DefenseListRow.id}" size="{$maxlength}" maxlength="{$maxlength}" value="0" tabindex="{$smarty.foreach.DefenseList.iteration}">
						<br><br>
						<input type="button" value="Max" onclick="$('#input_{$DefenseListRow.id}').val(maxcount({$DefenseListRow.id}))">
						{/if}
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="margin-bottom:10px;">  
				<table style="width:100%">
					<tr>
						<td class="transparent left">
							{$bd_remaining}<br>
							{foreach key=ResName item=ResCount from=$DefenseListRow.restprice}
							{$ResName}: <span style="font-weight:700">{$ResCount}</span><br>
							{/foreach}
							<br>
						</td>
						<td class="transparent right">
							{$fgf_time}
						</td>
					</tr>
					<tr>		
						<td class="transparent left" style="width:68%">
							&nbsp;
						</td>
						<td class="transparent right" style="white-space:nowrap;">
							{$DefenseListRow.time}
						</td>
					</tr>	
				</table>
			</td>
		</tr>
		{/foreach}
		{if $NotBuilding}<tr><th colspan="2" style="text-align:center"><input type="submit" value="{$bd_build_ships}"></th></tr>{/if}
    </table>
	</form>
</div>
<script type="text/javascript">
data			= {$BuildList};
bd_operating	= '{$bd_operating}';
</script>
{include file="planet_menu.tpl"}
{include file="overall_footer.tpl"}