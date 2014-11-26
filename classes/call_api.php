<?php
/*******************************************
* API Class
*******************************************/
class API
{
	protected $api_key = '9a8b5f911cda204e744ebccd54309b5d';
	protected $api_version = 'v1';
	protected $host = 'api.gilt.com';
	
    /**************
     * Call the API
     *************/
    public function Call($url)
    {
		Unirest::verifyPeer(false); // Disables SSL cert validation
        $response = Unirest::get($url, array( "Accept" => "application/json" ),
		  array(
			"apikey" => $this->api_key
		  )
		);
		return $response;
    }
	
    /**************
     * Fetch Products
     *************/
    protected function fetch($type, $query)
    {
		$url = $this->fetchURL($type, $query);
		// Call API method
		return $this->Call($url);
    }
	
    /**************************************
    * Create a valid URL for API to request
    ***************************************/
    protected function fetchURL($type, $query)
    {
		$rawquery = http_build_query($query, null, '&');

        $query = preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $rawquery);
		
		$url = array(
                "scheme" => "https",
                "host" => $this->host,
                "path" => $this->api_version . '/' . trim($type, '/'),
				"query" => $query
            );
        if (function_exists('http_build_url')) {
            return http_build_url($url);
        }
		// Return URL
        return $url['scheme'].'://'.trim($url['host'], '/') . '/'.trim($url['path'], '/') . '?'.$url['query'];
    }
    
    function paginateUrl($url, $page, $query, $rows)
    {
        $data = array(
            'page' => $page,
            'keyword' => $query,
            'Product' => 'Search'
        );

        return $url . '?' . http_build_query($data);
    }
	
}
?>