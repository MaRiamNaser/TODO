<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = auth()->user()->items;
        return view('view_list')->with('items', $items);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $user = auth()->user();

        $item = new Item();
        $item->title = $request->title;
        $item->description = $request->description;

        if ($user->items->save($item)) {
            return
                redirect("/items" . "/" . $id);
        }
    }

    public function create()
    {
        return view('create_new_item');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */

    public function show($user_id, $item_id)
    {
        $item =  Item::find($item_id);
        return view('show_item')->with('item', $item);
    }

    public function edit($user_id, $item_id)
    {


        $item =  auth()->user()->items;
        return view('edit_item')->with('items', $item);


        /*  $item =  Item::find($item_id);
        return view('edit_item')->with('item', $item);
        */
    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Item::where('title', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }

    /*
    public function search($user_id, $title)
    {
        
        $itemss = User::find($user_id)->items;
        //how to search on item by user id 
        $item = Item::where("title", "like", "%" . $title . "%")->get();
        return
            Item::where("title", "like", "%" . $title . "%")->get();
    }
    */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $item_id)
    {
        $user = auth()->user();
        $item = Item::findOrFail($item_id);

        $item->title = $request->title;
        $item->description = $request->description;

        if ($user->items->save($item)) {
            return redirect("/items" . "/" . $user_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $item_id)
    {
        /*
        $user = User::find($user_id);
        $item = Item::findOrFail($item_id);
        
        $user->items()->delete($item);
        */
        $row = Item::find($item_id);
        $row->destroy($item_id);


        return redirect('/items/1');
    }
}
