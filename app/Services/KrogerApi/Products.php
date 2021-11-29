<?php

namespace App\Services\KrogerApi;

class Products extends KrogerApi {

    /*
     * see https://developer.kroger.com/reference/#tag/Products
     */
    protected $scope    = 'product.compact';
    protected $endpoint = '/products';

    public function fulfillment()
    {
        return [
            'ais' => 'Available In Store',
            'csp' => 'Curbside Pickup',
            'dth' => 'Delivery To Home',
            'sth' => 'Ship To Home'
        ];
    }

    public function detail($upc, $locationId = null)
    {
        $this->endpoint = "{$this->endpoint}/{$upc}";

        return $this->get(['filter.locationId' => $locationId]);
    }

    public function search($term, $locationId = null)
    {
        $params = [
            'filter.term'        => $term,
            'filter.locationId'  => $locationId,
            'filter.fulfillment' => '', // enum
            'filter.start'       => '', // number to skip
            'filter.limit'       => 25, // 1 - 50
        ];

        if (is_numeric($term)) $params['filter.productId'] = $term;

        return $this->get($params);
    }
}
