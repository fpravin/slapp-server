<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Category;
use Validator;

class CategoryController extends BaseController
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();


        return $this->sendResponse($category->toArray(), 'Categories retrieved successfully.');
        // return response()->json([
        //     'success' => true,
        //     'data' => $category
        // ]);
    }
}
