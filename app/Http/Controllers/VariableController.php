<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Variable;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\VariableRepository;

class VariableController extends Controller
{
    /**
     * The variable repository instance.
     *
     * @var VariableRepository
     */
    protected $variables;

    /**
     * Create a new controller instance.
     *
     * @param  VariableRepository  $variables
     * @return void
     */
    public function __construct(VariableRepository $variables)
    {
        $this->middleware('auth');

        $this->variables = $variables;
    }

    /**
     * Display a list of all of the user's variables.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view ('variables.index', [
            'variables' => $this->getVariablesForUser($request)
        ]);
    }

    /**
     * JSON feed of variables, using for Angular setup
     */
    public function feed(Request $request)
    {
        return $this->getVariablesForUser($request);
    }

    /**
     * Gets all variables if user id is 1, otherwise gets authorized user's variables
     */
    private function getVariablesForUser(Request $request)
    {
        if ($request->user()->id === 1) {
            return $this->variables->forAdmin();
        } else {
            return $this->variables->forUser($request->user());
        }
    }

    /**
     * Create a new variable.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->variables()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/variables');
    }

    /**
     * Destroy the given variable.
     *
     * @param  Request  $request
     * @param  Variable  $variable
     * @return Response
     */
    public function destroy(Request $request, Variable $variable)
    {
        $this->authorize('destroy', $variable);

        $variable->delete();

        return redirect('/variables');
    }
}
