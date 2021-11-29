<?php

namespace App\Http\Controllers;

use App\Services\KrogerApi\Locations;
use App\Services\KrogerApi\Products;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index(Products $krogerProducts)
    {

        return Http::get('https://api.barcodelookup.com/v3/products?barcode=9780140157376&formatted=y&key=kvd7rx16x4nnrv07bszoz2sobrhg5z')->collect();

        // didn't work for body
        Http::dump()->post('https://api.agora.io/v1/apps/test/cloud_recording/acquire', [
            'body' => json_encode(["cname" => 'test'])
        ]);

        // HAD to set JSON, you were right.
        // Too few arguments to function Illuminate\Http\Client\PendingRequest::withBody(),
        Http::dump()->withBody(json_encode(["cname" => 'test']), 'application/json')
            ->post('https://api.agora.io/v1/apps/test/cloud_recording/acquire');


        return 'test';



        return $krogerProducts->detail('0074236526497', '70300108');

        return $krogerProducts->search('0074236526497');

        // Our Ralphs 70300108

        return (new Locations())->detail('70300108');

    }


    protected function item()
    {
        return json_decode('{
              "data": [
                {
                  "productId": "0001111042861",
                  "upc": "0001111042861",
                  "aisleLocations": [],
                  "brand": "Simple Truth Organic",
                  "categories": [
                    "Natural & Organic",
                    "Dairy"
                  ],
                  "countryOrigin": "UNITED STATES",
                  "description": "Simple Truth Organic™ 2% Reduced Fat Milk with DHA Omega-3",
                  "images": [
                    {
                      "perspective": "left",
                      "sizes": [
                        {
                          "size": "thumbnail",
                          "url": "https://www.kroger.com/product/images/thumbnail/left/0001111042861"
                        },
                        {
                          "size": "medium",
                          "url": "https://www.kroger.com/product/images/medium/left/0001111042861"
                        },
                        {
                          "size": "large",
                          "url": "https://www.kroger.com/product/images/large/left/0001111042861"
                        },
                        {
                          "size": "small",
                          "url": "https://www.kroger.com/product/images/small/left/0001111042861"
                        },
                        {
                          "size": "xlarge",
                          "url": "https://www.kroger.com/product/images/xlarge/left/0001111042861"
                        }
                      ]
                    },
                    {
                      "perspective": "front",
                      "featured": true,
                      "sizes": [
                        {
                          "size": "small",
                          "url": "https://www.kroger.com/product/images/small/front/0001111042861"
                        },
                        {
                          "size": "medium",
                          "url": "https://www.kroger.com/product/images/medium/front/0001111042861"
                        },
                        {
                          "size": "thumbnail",
                          "url": "https://www.kroger.com/product/images/thumbnail/front/0001111042861"
                        },
                        {
                          "size": "large",
                          "url": "https://www.kroger.com/product/images/large/front/0001111042861"
                        },
                        {
                          "size": "xlarge",
                          "url": "https://www.kroger.com/product/images/xlarge/front/0001111042861"
                        }
                      ]
                    },
                    {
                      "perspective": "right",
                      "sizes": [
                        {
                          "size": "thumbnail",
                          "url": "https://www.kroger.com/product/images/thumbnail/right/0001111042861"
                        },
                        {
                          "size": "small",
                          "url": "https://www.kroger.com/product/images/small/right/0001111042861"
                        },
                        {
                          "size": "medium",
                          "url": "https://www.kroger.com/product/images/medium/right/0001111042861"
                        },
                        {
                          "size": "large",
                          "url": "https://www.kroger.com/product/images/large/right/0001111042861"
                        },
                        {
                          "size": "xlarge",
                          "url": "https://www.kroger.com/product/images/xlarge/right/0001111042861"
                        }
                      ]
                    }
                  ],
                  "items": [
                    {
                      "itemId": "0001111042861",
                      "favorite": false,
                      "fulfillment": {
                        "curbside": false,
                        "delivery": false,
                        "inStore": false,
                        "shipToHome": false
                      },
                      "size": "1/2 gal"
                    }
                  ],
                  "itemInformation": [],
                  "temperature": {
                    "indicator": "Refrigerated",
                    "heatSensitive": false
                  }
                }
              ],
              "meta": {
                "pagination": {
                  "start": 0,
                  "limit": 0,
                  "total": 1
                }
              }
            }');
    }
}
