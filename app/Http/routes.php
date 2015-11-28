<?php

use App\Item;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/items', function () {
    $items = Item::orderBy('created_at', 'asc')->get();

    return view('items', [
        'items' => $items
    ]);
});

Route::post('/item', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/items')
            ->withInput()
            ->withErrors($validator);
    }

    $item = new Item;
    $item->name = $request->name;
    // add call to hex generator here
    $item->save();

    return redirect('/items');
});

Route::delete('/item/{id}', function ($id) {
    Item::findOrFail($id)->delete();

    return redirect('/items');
});