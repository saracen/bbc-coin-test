<?php

require 'BBCCoinAlgorithm.php';

/**
 * Test class for BBCCoinAlgorithm
 * 
 * @author     Simon Thulbourn <simon@thulbourn.com>
 */
class BBCCoinAlgorithmTests extends PHPUnit_Framework_TestCase
{
	/**
	 * Data provider for testValidation()
	 *
	 * @returns      array input, expected pairs
	 */
	public function validationProvider()
	{
		return array(
			array(4, 4),
			array(85, 85),
			array('197p', 197), 
			array('2p', 2), 
			array(1.87, 187), 
			array('£1.23', 123), 
			array('£2', 200), 
			array('£10', 1000), 
			array('£1.87p', 187), 
			array('£1p', 100), 
			array('£1.p', 100), 
			array('001.41p', 141), 
			array('4.235p', 426), 
			array('£1.257422457p', 126)
		);
	}
	
	/**
	 * Data provider for testGetMinimumCoins()
	 *
	 * @returns      array input, expected pairs
	 */
	public function coinsProvider()
	{
		return array(
			array(4,    array(2 => 2)),
			array(85,   array(50 => 1,  20 => 1, 2  => 7, 1 => 1)),
			array(197,  array(100 => 1, 50 => 1, 20 => 2, 2 => 3, 1 => 1)),
			array(2,    array(2 => 1)),
			array(187,  array(100 => 1, 50 => 1, 20 => 1, 2 => 8, 1 => 1)),
			array(123,  array(100 => 1, 20 => 1, 2  => 1, 1 => 1)),
			array(200,  array(200 => 1)),
			array(1000, array(200 => 5)),
			array(100,  array(100 => 1)),
			array(141,  array(100 => 1, 20 => 2, 1  => 1)),
			array(424,  array(200 => 2, 20 => 1, 2  => 2)),
			array(126,  array(100 => 1, 20 => 1, 2  => 3))
		);
	}
	
	/**
	 * Tests data validation
	 *
	 * @param        mixed input value
	 * @param        integer value in pence
	 *
	 * @dataProvider validationProvider
 	 * @asserts      equals
	 */
	public function testValidation($input, $expected)
	{
		$algo = new BBCCoinAlgorithm();
		$this->assertEquals($expected, $algo->validate($input));
	}
	
	/**
	 * Tests minimum coins
	 *
	 * @param        integer input value
	 * @param        array coins expected
	 *
	 * @dataProvider coinsProvider
	 * @asserts      equals
	 */
	public function testGetMinimumCoins($input, $expected)
	{
		$algo = new BBCCoinAlgorithm();
		
		$coins = $algo->getMinimumCoins($input);
		$this->assertEquals($expected, $coins);
		
		$amount = 0;
		foreach ($coins as $key => $value) {
			$amount += ($key * $value);
		}
		
		$this->assertEquals($input, $amount);
	}
}

?>