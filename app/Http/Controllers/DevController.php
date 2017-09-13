<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>
 */

namespace Penati\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Penati\Agent;
use Penati\Offer;
use Penati\Role;

class DevController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($model)
    {
        $model = ucfirst(camel_case($model));
        $class = "Penati\\$model";
        /** @var Model[] $models */
        $models = $class::all();
        return view('_dev.model', compact('model', 'models'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function agents()
    {
        $models = Role::whereName('agent')->first()->users;
        return view('_dev.agents', compact('models'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function offers()
    {
        $models = Offer::all();
        return view('_dev.offers', compact('models'));
    }
}
