var v  			= new Date();
var z			= new DecimalNumber(a[0],0);
var p			= 0;
var element		= $("#bx");

function BuildlistShipyard() {
	var n = new Date();
	var s = c[p] - hanger_id - Math.round((n.getTime() - v.getTime()) / 1000);
	var s = Math.round(s);
	var m = 0;
	var h = 0;
	if (s <= 0) {
		z.sub('1');
		if (z.toString() == '0') {
			p++;
			z = z.reset(a[p]);
			ShipyardList();
		} else {
			document.getElementById('auftr').options[0].innerHTML	= z.toString() + " \"" + b[p] + "\" " + bd_operating;
		}
		hanger_id = 0;
		v = new Date();
		s = 0;
	}
	
	if ( p > b.length - 2 ) {
		element.html(ready);
		return;
    } else {
		element.html(b[p]+" "+GetRestTimeFormat(s));
		window.setTimeout("BuildlistShipyard();", 1000);
    }
}

function ShipyardList() {
	while (document.getElementById('auftr').length > 0) {
		document.getElementById('auftr').options[document.getElementById('auftr').length-1] = null;
	}
	if ( p > b.length - 2 ) {
		document.getElementById('auftr').options[document.getElementById('auftr').length] = new Option(ready);
	}
	for ( iv = p; iv <= b.length - 2; iv++ ) {
		if ( iv == p ) {
			document.getElementById('auftr').options[document.getElementById('auftr').length] = new Option(z.toString() + " \"" + b[iv] + "\" " + bd_operating, iv);
		} else {
			document.getElementById('auftr').options[document.getElementById('auftr').length] = new Option(a[iv] + " \"" + b[iv] + "\"", iv); 
		}
	}
}