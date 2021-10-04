<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::where("user_id", Auth::user()->id)->get()->toArray();
        return $items;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->title = $request->title;
        $item->description = $request->description;
        $item->user_id = Auth::user()->id;
        $item->save();
        return $item;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */


    public function show($item_id)
    {
        // how to search on item
        $item = Item::all()->where("id", "equal", $item_id)
            ->where("user_id", "equal", Auth::user()->id)
            ->first();
        return $item;
    }


    public function search($title)
    {
        $items = Item::where("user_id", Auth::user()->id)
            ->where("title", "like", "%" .  $title .  "%")->get()->toArray();
        return $items;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $item_id)
    {
        $item = Item::where("id", $item_id)->get()->first();
        $item->title = $request->title;
        $item->description = $request->description;

        $item->save();
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */

    public function destroy($item_id)
    {

        $item = Item::where("user_id", Auth::user()->id)
            ->where("id", $item_id)->first();
        $item->delete();
        return "item has been deleted!";
    }
}
