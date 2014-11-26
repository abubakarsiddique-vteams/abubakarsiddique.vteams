<?php
/************************************
*
* Products Class extending API CLass
*
* Contains Search Method Only
************************************/
class Products extends API
{
    /************************************************************
     * :: Search Method ::
	 * $this->fetch() is an API class method
	 * Which deals with type of request we want to make!
	 * For now, only search products is valid & developed by me.
     ************************************************************/
    public function Search($keywords, $limit = 10, $offset = 0)
    {
		$params = array();
		$params['q'] = $keywords;
		$params['rows'] = $limit;
		$params['start'] = $offset * $limit;
		
        $products = $this->fetch('products', $params);
		if($products){
			return $products;
		}else{
			return false;
		}
    }
}
?>