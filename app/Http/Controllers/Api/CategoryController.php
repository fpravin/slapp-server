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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'category' => 'required'
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category = Category::create($input);

        return $this->sendResponse($category->toArray(), 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);


        if (is_null($category)) {
            return $this->sendError('Category not found.');
        }


        return $this->sendResponse($category->toArray(), 'Category retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        ////////////////////////////////////////////////////////////////////have to check and re-write
        $input = $request->all();

        $validator = Validator::make($input, [
            'category' => 'required'
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $category->category = $input['category'];
        $category->save();


        return $this->sendResponse($category->toArray(), 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->sendResponse($category->toArray(), 'Category deleted successfully.');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $category = Category::onlyTrashed()->find($request->id);
        $category->restore();
        return $this->sendResponse($category->toArray(), 'Category restored successfully.');
    }
}
