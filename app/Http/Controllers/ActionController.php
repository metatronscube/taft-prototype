<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ActionRepository;

class ActionController extends Controller
{
    /**
     * The action repository instance.
     *
     * @var ActionRepository
     */
    protected $actions;

    /**
     * Create a new controller instance.
     *
     * @param  ActionRepository  $actions
     * @return void
     */
    public function __construct(ActionRepository $actions)
    {
        $this->middleware('auth');

        $this->actions = $actions;
    }

    /**
     * Display a list of all of the user's actions.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view ('actions.index', [
            'actions' => $this->getActionsForUser($request)
        ]);
    }

    /**
     * JSON feed of actions, using for Angular setup
     */
    public function feed(Request $request)
    {
        return $this->getActionsForUser($request);
    }

    /**
     * Gets all items if user id is 1, otherwise gets authorized user's items
     */
    private function getActionsForUser(Request $request)
    {
        if ($request->user()->id === 1) {
            return $this->actions->forAdmin();
        } else {
            return $this->actions->forUser($request->user());
        }
    }

    /**
     * Create a new action.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->actions()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/actions');
    }

    /**
     * Destroy the given action.
     *
     * @param  Request  $request
     * @param  Action  $action
     * @return Response
     */
    public function destroy(Request $request, Action $action)
    {
        $this->authorize('destroy', $action);

        $action->delete();
        return $action;

        return redirect('/actions');
    }
}
