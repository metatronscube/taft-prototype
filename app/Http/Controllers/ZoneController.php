<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ZoneRepository;

class ZoneController extends Controller
{
    /**
     * The zone repository instance.
     *
     * @var ZoneRepository
     */
    protected $zones;

    /**
     * Create a new controller instance.
     *
     * @param  ZoneRepository  $zones
     * @return void
     */
    public function __construct(ZoneRepository $zones)
    {
        $this->middleware('auth');

        $this->zones = $zones;
    }

    /**
     * Display a list of all of the user's zones.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view ('zones.index', [
            'zones' => $this->getzonesForUser($request)
        ]);
    }

    /**
     * JSON feed of zones, using for Angular setup
     */
    public function feed(Request $request)
    {
        return $this->getzonesForUser($request);
    }

    /**
     * Gets all zones if user id is 1, otherwise gets authorized user's zones
     */
    private function getzonesForUser(Request $request)
    {
        if ($request->user()->id === 1) {
            return $this->zones->forAdmin();
        } else {
            return $this->zones->forUser($request->user());
        }
    }

    /**
     * Create a new zone.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->zones()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/zones');
    }

    /**
     * Destroy the given zone.
     *
     * @param  Request  $request
     * @param  Zone  $zone
     * @return Response
     */
    public function destroy(Request $request, Zone $zone)
    {
        $this->authorize('destroy', $zone);

        $zone->delete();

        return redirect('/zones');
    }
}
