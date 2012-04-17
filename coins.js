var coinTypes = [200, 100, 50, 20, 2, 1];

function coinCalculator(input, result) {
	var input = $(input);
	
	input.keydown(function(e) {
		input.css('background', '#ffffff');
		
		if (e.which == 13) {
			// Validate input
			var re = /^(\u00A3)?([0-9\.]+)p?$/;
			var val = input.val().match(re);
			
			console.log(val);
			if (val) {
				// Figure out total amount of coins
				var total = parseFloat(val[2]); //.toFixed(2);
				
				// Were pounds found in the input?
				if (val[1] || val[2].indexOf('.') > -1) {
					total = (total * 100).toFixed(2);
				}
				
				// Put coins through sieve
				var coins = coinSieve(total);
				
				$(result).empty();
				for (var i in coins) {
					if (i) {
						$(result).append('<dt>&pound;'+(i/100).toFixed(2)+'</dt><dd>'+coins[i]+'</dd>');
					}
				}
			} else {
				input.stop().css('background', '#ff0000').animate({ background: '#ffffff'}, 1500);
			}
		}
	});
}

function coinSieve(pennies) {
	var coins = {};
	
	var intRemainder = function(amount, div) {
		return [ Math.floor(amount/div), amount % div];
	};
	
	var result = [0, pennies];
	for (var i in coinTypes) {
		result = intRemainder(result[1], coinTypes[i]);
		coins[coinTypes[i]] = result[0];
	}
	
	return coins;
};