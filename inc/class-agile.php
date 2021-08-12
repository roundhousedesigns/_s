<?php
/**
 * Agile WebSales Feed functions.
 */

namespace RHD\StateTheatre;

class AgileFeed {
	const CACHE_KEY_PREFIX = 'rhd-agile__';
	protected $cache_key;
	protected $url;
	protected $bust;
	private $data;

	/**
	 * Constructor.
	 *
	 * @param string $cache_key
	 * @param string $url Agile WebSales Feed URL
	 * @param bool $bust Bust cache?
	 *
	 * // TODO force $url to be json format (`&format=json`) with regex
	 */
	public function __construct( $cache_key, $url, $bust = false ) {
		$this->cache_key = $cache_key;
		$this->url       = $this->format_feed_url( $url );
		$this->bust      = $bust;

		$this->fetch_feed();
	}

	/**
	 * @param string $data
	 * @return void
	 */
	private function set_data( $data ) {
		$this->data = $data;
	}

	/**
	 * Forces the 'format' parameter to 'json'
	 *
	 * @param string $url
	 * @return string The filtered URL
	 */
	private function format_feed_url( $url ) {
		if ( preg_match( '/[?|&]format=/', $url ) ) {
			$url = remove_query_arg( 'format', $url );
		}
		$url = add_query_arg( 'format', 'json', $url );

		return esc_url_raw( $url );
	}

	/**
	 * Retrieve fetched data
	 *
	 * @return array The decoded JSON data, or an empty array if no data present.
	 */
	public function get_json_data() {
		return $this->data ? json_decode( $this->data, true ) : [];
	}

	/**
	 * Fetch a feed.
	 *
	 * @return string $feed An array containg the feed url and response data.
	 */
	private function fetch_feed() {
		if ( $this->bust === true || false === ( $response = get_transient( $this->cache_key ) ) ) {
			// Fetch from source
			$response = file_get_contents( $this->url );

			set_transient( $this->cache_key, $response, MINUTE_IN_SECONDS * 10 );
		}

		$this->set_data( $response );
	}
}
