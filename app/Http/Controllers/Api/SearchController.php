<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    /**
     * Search the products table.
     *
     * @param Request $Request
     * @return mixed
     */
     public function search(Request $request)
     {
          // First we define the error message we are going to show if no keywords
          // existed or if no results found.
          $error = [ 'error' => 'No results found, please try with different keywords.' ];

          // Making sure the user entered a keyword.
          if ($request->has('q'))
          {
              // Using the Laravel Scout syntax to search the products table
              $posts = Product::search($request->get('q'))->get();

              // If there are results return them, otherwise, return the error message
              return $posts->count() ? $posts : $error;
          }

          // Return the error message if no keyword existed
          return $error;
     }
}
