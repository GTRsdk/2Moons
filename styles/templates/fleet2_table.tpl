{include file="overall_header.tpl"}
{include file="overall_topnav.tpl"}
{include file="left_menu.tpl"}
<form action="game.php?page=fleet3" method="post" onsubmit='this.submit.disabled = true;'>
<input type="hidden" name="galaxy"      	value="{$galaxy}">
<input type="hidden" name="system"      	value="{$system}">
<input type="hidden" name="planet"      	value="{$planet}">
<input type="hidden" name="planettype"     	value="{$planettype}">
<input type="hidden" name="speed"          	value="{$speed}">
<input type="hidden" name="usedfleet"      	value="{$usedfleet}">
<input type="hidden" name="fleetroom" 	   	value="{$fleetroom}">
<input type="hidden" name="fleet_group"    	value="{$fleet_group}">
<input type="hidden" name="acs_target_mr"  	value="{$acs_target_mr}">
<input type="hidden" name="consumption"    	value="{$consumption}">
<input type="hidden" name="speedallsmin"   	value="{$speedallsmin}">
<input type="hidden" name="thisgalaxy"     	value="{$thisgalaxy}">
<input type="hidden" name="thissystem"     	value="{$thissystem}">
<input type="hidden" name="thisplanet"     	value="{$thisplanet}">
<input type="hidden" name="speedfactor" 	value="{$speedfactor}">
<input type="hidden" name="thisresource1"   value="{$thismetal}">
<input type="hidden" name="thisresource2"   value="{$thiscrystal}">
<input type="hidden" name="thisresource3" 	value="{$thisdeuterium}">
<br>
<div id="content" class="content">
   	<table class="table519">
        <tr>
        	<th colspan="2">{$thisgalaxy}:{$thissystem}:{$thisplanet} - {if $thisplanet_type == 3}{$fl_moon}{else}{$fl_planet}{/if}</th>
        </tr>
		<tr>
			<th>{$fl_mission}</th>
        	<th>{$fl_resources}</th>
        </tr>
		<tr class="left top">
			<td style="width:50%;margin:0;padding:0;">
        		<table border="0" cellpadding="0" cellspacing="0" width="259" style="margin:0;padding:0;">
        			{foreach item=MissionName key=MissionID from=$MissionSelector}
					<tr style="height:20px;">
						<td class="transparent left">
						<input id="radio_{$MissionID}" type="radio" name="mission" value="{$MissionID}" {if $mission == $MissionID}checked="checked"{/if} style="width:60px;"><label for="radio_{$MissionID}">{$MissionName}</label><br>
							{if $MissionID == 15}<br><div style="color:red;padding-left:13px;">{$fl_expedition_alert_message}"</div><br>{/if}
							{if $MissionID == 11}<br><div style="color:red;padding-left:13px;">{$fl_dm_alert_message}</div><br>{/if}
						</td>
					</tr>
					{/foreach}
        		</table>
        	</td>
        	<td class="top"
				<table border="0" cellpadding="0" cellspacing="0" width="259">
                    <tr style="height:20px;">
        				<td class="transparent">{$Metal}</td>
        				<td class="transparent"><a href="javascript:maxResource('1');">{$fl_max}</a></th>
        				<td class="transparent"><input name="resource1" size="10" onchange="calculateTransportCapacity();" type="text"></td>
        			</tr>
                    <tr style="height:20px;">
        				<td class="transparent">{$Crystal}</td>
        				<td class="transparent"><a href="javascript:maxResource('2');">{$fl_max}</a></th>
        				<td class="transparent"><input name="resource2" size="10" onchange="calculateTransportCapacity();" type="text"></td>
        			</tr>
                    <tr style="height:20px;">
        				<td class="transparent">{$Deuterium}</td>
        				<td class="transparent"><a href="javascript:maxResource('3');">{$fl_max}</a></td>
        				<td class="transparent"><input name="resource3" size="10" onchange="calculateTransportCapacity();" type="text"></td>
        			</tr>
                    <tr style="height:20px;">
        				<td class="transparent">{$fl_resources_left}</td>
        				<td class="transparent" colspan="2" id="remainingresources">-</td>
        			</tr>
                    <tr style="height:20px;">
        				<td class="transparent" colspan="3"><a href="javascript:maxResources()">{$fl_all_resources}</a></td>
        			</tr>
                    <tr style="height:20px;">
        				<td class="transparent" colspan="3">{$fl_fuel_consumption}: {$consumption}</td>
        			</tr>
					{if $StaySelector}
					<tr style="height:20px;">
						<th class="transparent" colspan="3">{$fl_hold_time}</th>
					</tr>
					<tr style="height:20px;">
						<td class="transparent" colspan="3">
						{html_options name=holdingtime options=$StaySelector} {$fl_hours}
						</td>
					</tr>
					{/if}
				</table>
			</td>
		</tr>
        <tr style="height:20px;">
        	<td colspan="2"><input value="{$fl_continue}" type="submit"></td>
        </tr>
    </table>
</div>
</form>
<script type="text/javascript">calculateTransportCapacity();</script>
{include file="planet_menu.tpl"}
{include file="overall_footer.tpl"}