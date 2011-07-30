function initPlanetMenu(){
	if($.cookie('pmenu') == "on" || $("#planet_menu_content:visible").length == 1) {
		$('#planet_menu_content').show();
		$('body').css('padding-bottom', '112px');
	} else {
		$('#planet_menu_content').hide();
		$('body').css('padding-bottom', '21px');
	}
	window.setTimeout(PlanetMenu, 1000);
	PlanetMenu();
}

function PlanetMenu() {
	$.each(planetmenu, function(index, val) {
		if(val.length != 0 && val[0] < serverTime.getTime() / 1000 + ServerTimezoneOffset)
			val.shift();
	
		if(val.length == 0)
			$('#planet_'+index).text(Ready);
		else	
			$('#planet_'+index).text(getFormatedTime(val[0] - serverTime.getTime() / 1000 + ServerTimezoneOffset));
	});
}

function ShowPlanetMenu() {
	if($("#planet_menu_content:visible").length == 1) {
		$.cookie('pmenu', 'off');
		$('body').animate({'padding-bottom' :'21px'}, 500);
	} else {
		$.cookie('pmenu', 'on');
		$('body').animate({'padding-bottom' :'112px'}, 500);
	}
	$('#planet_menu_content').slideToggle(500);
}