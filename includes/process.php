<?php
error_reporting(-1); 
ini_set('display_errors', 1);

//Include Libs
require_once 'lib/Unirest.php';
require_once 'classes/call_api.php';
require_once 'classes/product.php';

//Initialize Variables
$result = NULL;
$error = NULL;
$keyword = NULL;
$total_found = 0;
if(isset($_GET) && @$_GET['Product']=='Search'){
	if(!isset($_GET['keyword']) || @$_GET['keyword']==NULL){
		$error = 'Enter keywords to search';
	}else{
		//Pagination Attributes
		$current_url = $_SERVER['PHP_SELF'];
		$rows =  21;
		$current_page = isset($_REQUEST["page"]) ? $_GET["page"] : 1;
		$offset = ($current_page - 1);
		
		//Keyword
    	$keyword = $_GET["keyword"];
		
		//Call Products method to grab products
		$product = new Products();
		$response = $product->Search($keyword, $rows, $offset);
		
		//If response is 200 aka OK, then go further
		if(@$response->code==200){
			$result = $response->body;
			
			//Set Count Variables
			$total_found = $result->total_found; //Total numbers of products available
			$result_count = count($result->products); //Our count set
		}else{
			//Throw Error
			$result = false;
		}
	}
}
?>