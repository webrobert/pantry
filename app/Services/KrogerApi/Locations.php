<?php

namespace App\Services\KrogerApi;

class Locations extends KrogerApi {

    protected $scope    = '';
    protected $endpoint = '/locations';


    public function detail($locationId)
    {
        $this->endpoint = "{$this->endpoint}/{$locationId}";
        return $this->get();
    }

    /*
     * see https://developer.kroger.com/reference/#operation/SearchLocations
     */
    public function list($params = null)
    {
        return $this->get(['filter.zipCode.near' => '92037']);
    }

}
