<?php
	require 'BBCCoinAlgorithm.php';
	
	$amount = (isset($_POST['amount'])) ? $_POST['amount'] : 0;
	
	$coinAlgo = new BBCCoinAlgorithm();
	
	// validate data
	$validatedAmount = $coinAlgo->validate($amount);
	
	// get coins
	$coins = $coinAlgo->getMinimumCoins($validatedAmount);
	
	if (count($coins) == 0) {
		// invalid input
		header("HTTP/1.1 400 Bad Request");
		
		$output = json_encode(array(
			'status' => 'error',
			'message' => 'Unable to process the input'
		));
	} else {
		// all ok
		header("HTTP/1.1 200 OK");
		
		$output = json_encode(array(
			'status' => 'ok',
			'coins' => $coins
		));
	}
	
	// set content-type to JSON
	header("Content-Type: application/json;charset=utf-8");
	
	echo $output;
?>