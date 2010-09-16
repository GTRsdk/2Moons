/**
 *  returns a formated number like php number_format()
 *
 * @see http://de3.php.net/number_format
 */
function number_format (number, decimals, dec_point, thousands_sep)
{
  dec_point      = LocalizationStrings['decimalPoint'];
  thousands_sep  = LocalizationStrings['thousandSeperator'];

  var exponent = "";
  var numberstr = number.toString ();
  var eindex = numberstr.indexOf ("e");
  if (eindex > -1)
  {
    exponent = numberstr.substring (eindex);
    number = parseFloat (numberstr.substring (0, eindex));
  }

  if (decimals != null)
  {
    var temp = Math.pow (10, decimals);
    number = Math.round (number * temp) / temp;
  }
  var sign = number < 0 ? "-" : "";
  var integer = (number > 0 ?
      Math.floor (number) : Math.abs (Math.ceil (number))).toString ();

  var fractional = number.toString ().substring (integer.length + sign.length);
  dec_point = dec_point != null ? dec_point : ".";
  fractional = decimals != null && decimals > 0 || fractional.length > 1 ?
               (dec_point + fractional.substring (1)) : "";
  if (decimals != null && decimals > 0)
  {
    for (i = fractional.length - 1, z = decimals; i < z; ++i)
      fractional += "0";
  }

  thousands_sep = (thousands_sep != dec_point || fractional.length == 0) ?
                  thousands_sep : null;
  if (thousands_sep != null && thousands_sep != "")
  {
    for (i = integer.length - 3; i > 0; i -= 3)
      integer = integer.substring (0 , i) + thousands_sep + integer.substring (i);
  }

  return sign + integer + fractional + exponent;
}


function NumberGetHumanReadable(value)
{
    value = Math.floor(value);
    var unit = '';
    var precision = 3;
    
    floorWithPrecision = function(value, precision) {
        return Math.floor(value * Math.pow(10, precision)) / Math.pow(10, precision);
    }
    
    value = floorWithPrecision(value, precision);
    
    while (precision >= 0) {
        if (floorWithPrecision(value, precision - 1) != value) {
            break;
        }
        precision = precision - 1;
    }
    
    return removeE(number_format(value, precision, LocalizationStrings['decimalPoint'], LocalizationStrings['thousandSeperator'])) + unit;
}

function removeE(Number) {
	Number	= String(Number);
	if(Number.search(/e\+/) == -1)
		return Number;
	
	var e = parseInt(Number.replace(/\S+.?e\+/g, ''));
	if(isNaN(e) || e == 0)
		return Number;
	else
		return parseFloat(Number).toPrecision(e+1);
}