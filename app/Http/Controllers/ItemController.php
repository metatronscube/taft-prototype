<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ItemRepository;

class ItemController extends Controller
{
    /**
     * The item repository instance.
     *
     * @var ItemRepository
     */
    protected $items;

    /**
     * Create a new controller instance.
     *
     * @param  ItemRepository  $items
     * @return void
     */
    public function __construct(ItemRepository $items)
    {
        $this->middleware('auth');

        $this->items = $items;
    }

    /**
     * Display a list of all of the user's items.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view ('items.index', [
            'items' => $this->getItemsForUser($request)
        ]);
    }

    /**
     * JSON feed of items, using for Angular setup
     */
    public function feed(Request $request)
    {
        return $this->getItemsForUser($request);
    }

    /**
     * Gets all items if user id is 1, otherwise gets authorized user's items
     */
    private function getItemsForUser(Request $request)
    {
        if ($request->user()->id === 1) {
            return $this->items->forAdmin();
        } else {
            return $this->items->forUser($request->user());
        }
    }

    /**
     * Create a new item.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->items()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/items');
    }

    /**
     * Destroy the given item.
     *
     * @param  Request  $request
     * @param  Item  $item
     * @return Response
     */
    public function destroy(Request $request, Item $item)
    {
        $this->authorize('destroy', $item);

        $item->delete();

        return $item;
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        $data = $request->all();

        $item->fill($data);

        $item->save();

        return $item;
    }
}
