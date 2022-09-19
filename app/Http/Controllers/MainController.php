<?php

namespace App\Http\Controllers;

use App\Models\Arrival;
use App\Models\Departure;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $arrivals = Arrival::all();
        $departures = Departure::all();
        return view( 'tables', compact('arrivals','departures'));
    }
}