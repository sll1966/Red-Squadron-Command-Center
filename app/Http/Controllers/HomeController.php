<?php

namespace App\Http\Controllers;
use App\Pilot;
use Illuminate\Http\Request;

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
        // Handy list of task statuses used in this appliction
        //$TaskStatuses = TaskStatuses::value('StatusValues');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    // Below used on main status screen
    public function GetStatuses()
    {
        $rss = Pilot::orderBy('pilots.name', 'asc')
        ->join('shiproster','shiproster.id','=','pilots.currentship')
        ->join('ships','ships.id','=','shiproster.shiptypeid')
        ->select('pilots.*', 
                'shiproster.id as shipid', 
                'ships.name as shipname',
                'ships.type as shiptype', 
                'shiproster.status as shipstatus', 
                'shiproster.propulsionstatus', 
                'shiproster.shieldstatus', 
                'shiproster.weoponstatus', 
                'shiproster.lifesupportstatus', 
                'shiproster.structurestatus', 
                'shiproster.navstatus', 
                'shiproster.commstatus' 
                )
        ->get();
        return view('statusboard')->with(array('rss'=>$rss));
    }
}
