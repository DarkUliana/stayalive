<?php

namespace App\Http\Controllers\Admin;

use App\Enemy;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Mob;
use Illuminate\Http\Request;

class MobsController extends Controller
{
    protected $validationArray = [

        'enemyType' => 'required|integer',
        'enemyLevel' => 'required|integer',
        'peaceRadius' => 'required|numeric',
        'maximumHP' => 'required|integer',
        'playerDetectRadius' => 'required|numeric',
        'callRadius' => 'required|numeric',
        'addAgroRadius' => 'required|numeric',
        'attackCloseRange' => 'required|numeric',
        'attackClosePower' => 'required|integer',
        'attackCloseRate' => 'required|numeric',
        'giveExpirience' => 'required|integer',
        'movementSpeed' => 'required|numeric',
        'timeToStay' => 'required|numeric',
        'increaseSpeedRange' => 'required|numeric',
        'increaseSpeedValue' => 'required|numeric',
        'increaseSpeedTime' => 'required|numeric',
        'attackDistanceRange' => 'required|numeric',
        'attackDistancePower' => 'required|integer',
        'attackDistanceRate' => 'required|numeric',
        'attackSpeedDecrease' => 'required|numeric',
        'movementSpeedDecrease' => 'required|numeric',
        'timeDebuff' => 'required|numeric',
        'chance' => 'required|numeric',
        'hillRange' => 'required|numeric',
        'hillPower' => 'required|integer',
        'hillRate' => 'required|numeric'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        session(['itemsParams' => $request->getQueryString()]);

        $keyword = $request->get('search');
        $sort = $request->get('sort');
        $perPage = 25;

        $type = 'asc';
        if (!empty ($request->get('type'))) {
            $type = $request->get('type');
        }

        $mobs = Mob::where([]);

        if (!empty($keyword)) {
            $mobs = $mobs->whereHas('enemy', function($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            });
        }

        if (!empty($sort)) {

            $mobs = $mobs->orderBy($sort, $type);
        }

        if (empty($request->type) && empty($keyword) && empty($sort)) {

            $mobs = $mobs->latest();
        }

        $mobs = $mobs->paginate($perPage);

        return view('admin.mobs.index', compact('mobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $enemies = Enemy::all();
        $currentEnemy = Enemy::first();

        return view('admin.mobs.create', compact('enemies', 'currentEnemy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $this->validate($request, $this->validationArray);
        $requestData = $request->all();

        Mob::create($requestData);

        return redirect('mobs' . getQueryParams(request()))->with('flash_message', 'Mob added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $mob = Mob::findOrFail($id);

        return view('admin.mobs.show', compact('mob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $mob = Mob::findOrFail($id);
        $enemies = Enemy::all();
        $currentEnemy = $mob->enemy;

        return view('admin.mobs.edit', compact('mob', 'enemies', 'currentEnemy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->validationArray);

        $requestData = $request->all();

        $mob = Mob::findOrFail($id);
        $mob->update($requestData);

        return redirect('mobs' . getQueryParams(request()))->with('flash_message', 'Mob updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Mob::destroy($id);

        return redirect('mobs' . getQueryParams(request()))->with('flash_message', 'Mob deleted!');
    }

    public function getFields(Request $request)
    {
        if (!isset($request->enemy)) {

            return response('Invalid data', 400);
        }

        $currentEnemy = Enemy::find($request->enemy);
        $enemies = Enemy::all();

        return view('admin.mobs.fields', compact('currentEnemy', 'enemies'));

    }
}
