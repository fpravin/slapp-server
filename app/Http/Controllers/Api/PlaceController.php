<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Place;
use App\PlaceCategory;
use Validator;
use DB;

class PlaceController extends BaseController
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $place = Place::all();

        $place->each(function ($item, $key) {

            $categories = DB::table('place_categories')
                ->join('categories', 'place_categories.category_id', '=', 'categories.id')
                ->select('place_categories.id', 'place_categories.category_id', 'categories.category', 'categories.icon')
                ->where('place_categories.place_id', '=', $item->id)
                ->get();

            $item->category = $categories;
        });

        return $this->sendResponse($place->toArray(), 'Places retrieved successfully.');
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
            'name' => 'required',
            'description' => 'required',
            'latlang' => 'required',
            'address' => 'required',
            'rating' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $place = Place::create($input);
        $category_id = $input['category_id'];

        if ($place->count()) {
            foreach ($category_id as $key => $value) {
                $placeCategory = [
                    'place_id' => $place->id,
                    'category_id' => $value
                ];
                PlaceCategory::create($placeCategory);
            }
        }

        return $this->sendResponse($place->toArray(), 'Place created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::find($id);


        if (is_null($place)) {
            return $this->sendError('Place not found.');
        }

        $categories = DB::table('place_categories')
            ->join('categories', 'place_categories.category_id', '=', 'categories.id')
            ->select('place_categories.id', 'place_categories.category_id', 'categories.category')
            ->where('place_categories.place_id', '=', $id)
            ->get();

        $place->category = $categories;


        return $this->sendResponse($place->toArray(), 'Place retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        ////////////////////////////////////////////////////////////////////have to check and re-write

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'latlang' => 'required',
            'address' => 'required',
            'rating' => 'required',
            'category_id' => 'required'
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        //TODO: should validate category before update.
        //TODO: validate for new old and delete.

        $place->name = $input['name'];
        $place->description = $input['description'];
        $place->latlang = $input['latlang'];
        $place->address = $input['address'];
        $place->rating = $input['rating'];
        $place->save();


        return $this->sendResponse($place->toArray(), 'Place updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();
        return $this->sendResponse($place->toArray(), 'Place deleted successfully.');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $place = Place::onlyTrashed()->find($request->id);
        $place->restore();
        return $this->sendResponse($place->toArray(), 'Place restored successfully.');
    }
}
