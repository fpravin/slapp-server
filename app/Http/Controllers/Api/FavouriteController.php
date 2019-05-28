<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Favourite;
use Validator;
use DB;

class FavouriteController extends BaseController
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $favourites = Favourite::where('user_id', $request->userID)->get();
        return $this->sendResponse($favourites->toArray(), 'Favourites retrieved successfully.');
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
            'user_id' => 'required',
            'place_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $favourite = Favourite::create($input);

        return $this->sendResponse($favourite->toArray(), 'Favourite created successfully.');
    }

    public function toggleFavourite(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required',
            'place_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $favouriteAlreadyExist = Favourite::where('user_id', $request->user_id)->where('place_id', $request->place_id)->exists(); // check if already fav

        if ($favouriteAlreadyExist) {
            // toggle to opposite (un favourite it)
            $favourite = Favourite::where('user_id', $request->user_id)->where('place_id', $request->place_id)->first();
            $favourite->delete();
            return $this->sendResponse($favourite->toArray(), 'Favourite removed successfully.');
        } else {
            $favouriteTrashedExist = Favourite::where('user_id', $request->user_id)->where('place_id', $request->place_id)->withTrashed()->exists();
            // dd("2", $favouriteTrashedExist);

            if ($favouriteTrashedExist) {
                // toggle to opposite (favourite it)
                $favourite = Favourite::where('user_id', $request->user_id)->where('place_id', $request->place_id)->withTrashed()->first();
                $favourite->restore();
                return $this->sendResponse($favourite->toArray(), 'Favourite added successfully.');
            } else {
                // create
                $favourite = Favourite::create($input);
                return $this->sendResponse($favourite->toArray(), 'Favourite created successfully.');
            }
        }
    }
}
