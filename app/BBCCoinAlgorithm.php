<?php

/**
 * BBC Coin Algorith
 *
 * The class validates input and finds the minimum coins needed for an amount
 * 
 * @author     Simon Thulbourn <simon@thulbourn.com>
 */
class BBCCoinAlgorithm
{
	/**
	 * @var         array coin values
	 */
	private $coinTypes = array(
		// for whatever reason, the 5 and 10p coins were left out of the spec...
		200, 100, 50, 20, 2, 1
	);
	
	/**
	 * Validates user input
	 *
	 * @param       string user input
	 *
	 * @return      integer amount in pennies
	 */
	public function validate($input)
	{
	}
	
	/**
	 * Gets the mimumum coins needed for a value
	 * 
	 * @param       integer amount in pence
	 *
	 * @return      array coins needed in pairs
	 */
	public function getMinimumCoins($input)
	{
	}
}
	
?>