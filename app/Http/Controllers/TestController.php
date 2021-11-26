<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;

class TestController extends Controller
{
    public function index()
    {

        ShoppingList::all()->each(function ($list) {
            @dump(class_basename($list));
        });

    }
}
