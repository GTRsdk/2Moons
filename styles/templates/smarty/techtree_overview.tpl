{include file="overall_header.tpl"}
{include file="overall_topnav.tpl"}
{include file="left_menu.tpl"}
<div id="content">
<table width="569" align="center">
{foreach item=TechInfo from=$TechTreeList}
{if !is_array($TechInfo)}
<tr>
	<td class="c">{$TechInfo}</td>
	<td class="c">{$tt_requirements}</td>
</tr>
{else}
<tr>
	<th class="l" width="40%">
	<table width="100%">
	<tr>
		<td style="background-color: transparent;" align="left"><a href="game.php?page=infos&amp;gid={$TechInfo.id}">{$TechInfo.name}</a></td>
	</tr>
	</table>
	</th>
	<th class="l" width="60%">
	<table width="100%">
	<tr>
	<td style="background-color: transparent;" align="left">
	{if $TechInfo.need}
		{foreach item=NeedLevel from=$TechInfo.need.{$TechInfo.id}}
			{if $NeedLevel.own >= $NeedLevel.count}
				<font color="#00ff00">{$lang.{$NeedLevel.id}} ({$tt_lvl}{$NeedLevel.count})</font><br>
			{else}
				<font color="#ff0000">{$lang.{$NeedLevel.id}} ({$tt_lvl}{$NeedLevel.count})</font><br>
			{/if}
		{/foreach}
	{/if}
	</td>
	</tr>
	</table>
	</th>
</tr>
{/if}
{/foreach}
</table>
</div>
{if $is_pmenu == 1}
{include file="planet_menu.tpl"}
{/if}
{include file="overall_footer.tpl"}