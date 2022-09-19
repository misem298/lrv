<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arrival;
use App\Models\Departure;
use App\Models\Airport;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    //public $arrival;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        //$this -> fill_tables();
       // $request = new Request();
       // $timezone = $request->get('timezone');
        $tz = 3600 * 3;
                
        $arrivals = $this -> select_arrivals_info();
        $departures = $this -> select_departures_info();
        //$arrivals = DB::select('select * from arrivals; ');
        //$departures = Departure::all();
        return view('home', compact('arrivals','departures', 'tz'));
    }

    public  function  select_arrivals_info(){
        $now = time() - strtotime("Today");
        $arrivals = DB::table('arrivals')->where('arr_time','>=', $now )
                                         ->where('arr_time','<=', $now + 3600)
                                         ->orderBy('arr_time')
                                         ->get();
        return $arrivals;                             
                                     
    }
    public function select_departures_info(){ 
        $now = time() - strtotime("Today");
        $departures = DB::table('departures')->where('dep_time','>=', $now )
                                             ->where('dep_time','<=', $now + 3600)
                                             ->orderBy('dep_time')
                                             ->get();
                                      
        return $departures;
    } 

    public function fill_tables()
    {
        $airports = Airport::all();
        //$results = array();
      
        foreach ($airports as $airport) 
        {           
     
            DB::table('arrivals')->insert(               
                array(
                       'place'     =>   $airport->name, 
                       'ident'    =>   $airport->ident,
                       'arr_time' =>  strval(rand(0, 24*60*60)),
                       'ts'  => timestamps(),
                )
           );
   
           DB::table('departures')->insert(               
                array(
                    'place'     =>   $airport->name, 
                    'ident'    =>   $airport->ident,
                    'dep_time' =>   strval(rand(0, 24*60*60)) ,
                    'ts'  => timestamps(),
                )
            ) ;
        }
    }
    public static function  select_info(){
        $now = time() - strtotime("Today");
        $tz = 3600 * 3;
        $arrivals = DB::table('arrivals')->where('arr_time','>=', $now )
                                         ->where('arr_time','<=', $now + 3600)
                                         ->orderBy('arr_time')
                                         ->get();
        
        $departures = DB::table('departures')->where('dep_time','>=', $now )
                                             ->where('dep_time','<=', $now + 3600)
                                             ->orderBy('dep_time')
                                             ->get();                                    
        return view('home', compact('arrivals','departures','tz'));
    } 
}
