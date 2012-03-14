<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>BBC Coin Algorithm</title>
	<link rel="stylesheet" href="https://raw.github.com/necolas/normalize.css/master/normalize.css" type="text/css" media="screen" charset="utf-8">
	<style type="text/css">
	body {
		font: normal normal 300 10pt/14pt sans-serif;
	}
	
	div#container {
		margin: 200px auto;
		
		width: 420px;
	}
	
	header {
		margin: 20px 0;
		font: 14pt/18pt sans-serif;
	}
	
	form#coin_form {}
		
		form#coin_form fieldset {
			margin: 0;
			padding: 0;
			
			border: 0;
		}
		
			form#coin_form fieldset input#amount {
				padding: 8px;
				
				font-size: 120%;
				
				width: 400px;
				
				background: #efefef;
				border: 1px solid #ccc;
				
				        border-radius: 3px;
				-webkit-border-radius: 3px;
				   -moz-border-radius: 3px;
				     -o-border-radius: 3px;
				
				outline: 0;
			}
			
				form#coin_form fieldset input#amount:focus {
					box-shadow: 0px 0px 5px #ddd;
				}
				
	table#results {
		margin-top: 30px;
		width: 418px;
		
		border-collapse: collapse;		
	}
	
		table#results thead {}
			
			table#results thead th {
				padding: 5px;
				text-align: left;
				
				border-bottom: 1px solid #ddd;
			}
			
		table#results tbody {}
		
			table#results tbody td {
				padding: 5px;
				
				border-bottom: 1px solid #ddd;
			}
			
				table#results tbody tr:last-child td {
					border-bottom: 0;
				}
				
				table#results tbody tr td[colspan='2'] {
					text-align: center;
				}
			
	</style>
	<!-- pull from a CDN hoping that the user has visited this before so it's cached by the browser -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" charset="utf-8">
		// coin types
		var coins = {'200': '&pound;2', '100': '&pound;1', '50': '50 pence', '20': '20 pence', '2': '2 pence', '1': '1 pence'};
		
		$(document).ready(function() {
			$('form#coin_form').submit(function(evt) {
				evt.preventDefault();
				
				var value = $('#amount').val();
				
				$.post($(this).attr('action'), {'amount': value}, function(data) {
					$('table#results tbody').empty();
					
					jQuery.each(data.coins, function(v, i) {
						var coin = coins[v];
						var amountOfCoins = data.coins[v];
						
						var row = $('<tr>').append($('<td>').html(coin), $('<td>').html(amountOfCoins));
						
						$('table#results tbody').append(row);
					})
				}, 'json').error(function(data) {
					data = JSON.parse(data.responseText);
					
					// empty table
					$('table#results tbody').empty();
						
					var row = $('<tr>').append($('<td>').attr({'colspan': 2}).html(data.message));
						
					$('table#results tbody').append(row);
						
				});
			});
		});
	</script>
</head>
<body>
	<div id="container">
		<header>BBC Coin Algorithm Test</header>
		<p>Enter an amount below and press return/enter to find out which coins are needed to make up the amount.</p>
		<form id="coin_form" action="results.php" method="post">
			<fieldset>
				<input id="amount" name="amount" type="text" placeholder="Enter an amount">
			</fieldset>
		</form>
		<table id="results">
			<thead>
				<th>Coin</th>
				<th>Count</th>
			</thead>
			<tbody>
				<tr>
					<td colspan="2">No data</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>