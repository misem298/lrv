<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Useric;
use DataTables;

class TableController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Useric::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('tables');
    }


    public function  select_info(){
        $now = time() - strtotime("Today");
        $arrivals = DB::table('arrivals')->where('arr_time','>=', $now )
                                         ->where('arr_time','<=', $now + 3600)
                                         ->orderBy('arr_time')
                                         ->get();
        
        $departures = DB::table('departures')->where('dep_time','>=', $now )
                                             ->where('dep_time','<=', $now + 3600)
                                             ->orderBy('dep_time')
                                             ->get();                                    
        return view('home', compact('arrivals','departures'));
    } 
}