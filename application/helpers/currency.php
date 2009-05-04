<?php
/**
 * Currency helper to convert currency using google
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class currency_Core {

	/**
	 * @param string $from
	 * @param string $to
	 * @param float  $amount
	 * @return float
	 */
	public static function convert($from, $to, $amount = 1)
	{
		$googleQuery = $amount . ' ' . $from . ' in ' . $to;
		$googleQuery = urlEncode( $googleQuery );
		$askGoogle = file_get_contents( 'http://www.google.com/search?q=' . $googleQuery );
		$askGoogle = strip_tags( $askGoogle );
		$matches = array();
		preg_match( '/= (([0-9]|\.|,|\ )*)/', $askGoogle, $matches );

		return $matches[1] ? ($matches[1]) : $amount;

	}
}