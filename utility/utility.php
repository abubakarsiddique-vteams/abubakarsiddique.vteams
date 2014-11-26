<?php
/************************************
* Contains small utility methods
************************************/
class utility
{
    public function paginateUrl($url, $page, $query, $rows)
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