<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/statusboard', 'HomeController@GetStatuses');

Route::get('/pilottasks', function () {
    return view('pilottasks');
});
Route::get('/shiptasks', function () {
    return view('shiptasks');
});
//Route::get('/tasks', function () {
 //   return view('tasks');
//});

use App\Task;
use Illuminate\Http\Request;

/**
 * Display All Tasks and allow adding of one
 * may use controller eventually such as Route::resource('tasks', 'TaskController');
 */
Route::get('/tasks', function () {
    $tasks = Task::orderBy('created_at', 'asc')
    ->join('pilots','pilots.id','=','tasks.pilotid')
    ->join('shiproster','shiproster.id','=','tasks.shipid')
    ->join('ships','ships.id','=','shiproster.shiptypeid')
    ->select('tasks.*', 'pilots.name as pilotname', 'shiproster.status as shipstatus', 'ships.name as shipname')
    ->get();
    // Handy list of task statuses used in this appliction
    $TaskStatuses = DB::table('taskstatuses')->get()->ToArray();
    // Send all data to view
    $data = ['tasks' => $tasks,
            'TaskStatuses' => $TaskStatuses];
    return view('tasks', [
        'tasks' => $tasks
        //'data' => $data
    ]);
});

/**
 * Add A New Task
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    // Create The Task...
    $task = new Task;
    $task->name = $request->name;
    $task->pilotid = $request->pilotid;
    $task->shipid = $request->shipid;
    $task->description = $request->description;
    $task->status = $request->TaskStatus;
    $task->save();
    // grab fresh copy of data
    $tasks = Task::orderBy('created_at', 'asc')
    ->join('pilots','pilots.id','=','tasks.pilotid')
    ->join('shiproster','shiproster.id','=','tasks.shipid')
    ->join('ships','ships.id','=','shiproster.shiptypeid')
    ->select('tasks.*', 'pilots.name as pilotname', 'shiproster.status as shipstatus', 'ships.name as shipname')
    ->get();
    // Handy list of task statuses used in this appliction
    $TaskStatuses = DB::table('taskstatuses')->get()->ToArray();
    // Send all data to view
    $data = ['tasks' => $tasks,
            'TaskStatuses' => $TaskStatuses];
    return view('tasks', [
        'tasks' => $tasks
    //return redirect('/');
    ]);
});

/**
 * Delete An Existing Task
 */
Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    $tasks = Task::orderBy('created_at', 'asc')
    ->join('pilots','pilots.id','=','tasks.pilotid')
    ->join('shiproster','shiproster.id','=','tasks.shipid')
    ->join('ships','ships.id','=','shiproster.shiptypeid')
    ->select('tasks.*', 'pilots.name as pilotname', 'shiproster.status as shipstatus', 'ships.name as shipname')
    ->get();
    // Handy list of task statuses used in this appliction
    $TaskStatuses = DB::table('taskstatuses')->get()->ToArray();
    // Send all data to view
    $data = ['tasks' => $tasks,
            'TaskStatuses' => $TaskStatuses];
    return view('tasks', [
        'tasks' => $tasks
    //return redirect('/');
    ]);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
