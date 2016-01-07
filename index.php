<?php 
require "vendor/autoload.php";

use API\APIRepository;
use API\DemoAPI;

//------------------------------------------
// Step 1 - Authentication
//------------------------------------------

	# In the sample DemoAPI, it get the token on every call. We recommend to get this just once.




//------------------------------------------
// Step 2 - Get restaurant details
//------------------------------------------

	// Get all restaurant list
	// See Sample Response - sample_result_restaurants.json
	$api = new DemoAPI();
	echo json_encode( $api->get('v1/restaurants') );

	// To get individual restaurant details
	// See Sample Response - sample_result_restaurant.json
	echo json_encode( $api->get('v1/restaurants/38') );




//------------------------------------------
// Step 3 - Reserve a table
//------------------------------------------

	echo $api->post( 'v1/reserve', 
	[
		"time" => "18:00:00",
		"cover" => "1",
		"menus" => [ [ "count" => "1", "id" => "205" ] ],
		"restaurant_slug" => "damindra" 
	],
	['accept' => 'application/json'] )->getBody();

	/*
 	Sample Response
 	{"response":"success","message":"Successfully created."}
	*/



//------------------------------------------
// Step 4 - Create an order
//------------------------------------------

	echo $api->post( 'v1/order', 
	[
		"billing_fname" => "johnder",
		"billing_lname" => "baul",
		"billing_email" => "derjohn@live.com",
		"billing_phone" => "+639081089638",
		"hold_id" => "2179"
	]  )->getBody();

	/*
	 	Sample Response
	 	{"response":"success","message":"Successfully created."}
	*/

