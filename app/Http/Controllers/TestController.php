<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {

        if (file_exists($file = base_path("database/items/vitamins.txt"))) {
            $items = collect(file($file));

            collect($items)->each(function ($string){

                $pos = 5;
                $checkbox = substr($string, 0, $pos+1);
                $end = substr($string, $pos+1);

                dump([
                    str_contains('- [x] ', $checkbox),
                    trim($checkbox), $end]
                );
            });
        }

    }
}
