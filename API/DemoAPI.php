<?php 
namespace API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Event\Emitter;
use GuzzleHttp\Event\ErrorEvent;

class DemoAPI {
	protected $formdata;
	protected $endpoint;
	protected $client;
	public function __construct(){
		$this->endpoint = 'http://table-api.app/';
		$this->formdata = [
			'client_id' => '[enter the client id]', 
			'client_secret' => '[enter the client secret]', 
			'username' => '[enter the username]', 
			'password' => '[enter the user password]'
			'grant_type' => 'password'
		];
		$this->client = new Client([
			'base_url' => $this->endpoint 
		]);
	}

	/** Retrieve the token */
	public function getToken(){
		$response = $this->client->post('oauth/access_token', [ 'body' => $this->formdata ]);
		
		return $response->json()['access_token'];
	}

	/**
	 * GET Request
	 * @param  [type]     $segment  API location
	 * @param  array|null $queryData Optional GET data.
	 * @return [type]                [description]
	 */
	public function get( $segment, array $queryData = null) {
		$token = $this->getToken();
		if( !$token ) return false;
		$query = '';
		if (! is_null( $queryData ) ) {
			foreach( $queryData as $field => $value) {
				$query .= "&$field=$value";
			}
		}
		$endpoint = $this->endpoint . $segment . '?access_token=' . $token . $query;
		$response =  $this->client->get(  $endpoint );
		return $response->json();
	}


	/**
	 * POST Request
	 * @param  [type]     $endpoint API location
	 * @param  array|null $postdata Optional POST data.
	 * @return [type]               [description]
	 */
	public function post($segment, array $data = array(), $headers = array() ) {
		$token = $this->getToken();
		if( !$token ) return false;
		$endpoint = $this->endpoint . $segment;
		return $response = $this->client->post( $endpoint, [
			'headers' => $headers,
			'body' =>  array_merge($data, ['access_token' => $token]),
		] );
    	}
}