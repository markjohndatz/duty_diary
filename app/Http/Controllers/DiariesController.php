<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Diary;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Notification;
use App\Notifications\NewDiaryPosted;

class DiariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            if(Auth::user()->role_as == 1){
                $diaries = Diary::all();
                return $this->generateDatatables($diaries);
            } else if(Auth::user()->role_as == 2){
                $supervisorId = Auth::user()->id;
                $diaries = Diary::where(function ($query) use ($supervisorId) {
                    $query->where('supervisor_id', $supervisorId)
                        ->orWhere('author_id', $supervisorId);
                })->get();
                return $this->generateDatatables($diaries);
            } else {
                $diaries = Diary::where('author_id','=',Auth::user()->id)->get();
                return $this->generateDatatables($diaries);
            }
        };
        return view('admin.diaries.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supervisors = User::where('role_as','=',2)->get();
        return view('admin.diaries.create')->with('supervisors',$supervisors);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'plan_today' => 'required',
                'end_day' => 'required',
                'roadblock' => 'required',
                'summary' => 'required',
                'plan_tomorrow' => 'required',
                'supervisor' => 'required'
            ]);
            $diary = Diary::create([
                'plan_today' => $request->plan_today,
                'end_day' => $request->end_day,
                'roadblock' => $request->roadblock,
                'summary' => $request->summary,
                'plan_tomorrow' => $request->plan_tomorrow,
                'author_id' => Auth::user()->id,
                'supervisor_id' => $request->supervisor,
                'status' => 0
            ]);
            if($diary){
                $trainee = User::where('id','=',$diary->author_id)->first();
                $supervisor = User::where('id','=',$diary->supervisor_id)->first();
                $diary = [
                    'trainee' => $trainee->name,
                    'supervisor' => $supervisor->name,
                    'sup_email' => $supervisor->email,
                    'url' => route('approval-requests.show',$diary->id),
                ];

                Notification::route('slack', config('notifications.slack_webhook'))->notify(new NewDiaryPosted($diary));
            }
            $diaries = Diary::all();
            return view('admin.diaries.index')->with('diaries',$diaries);
            // return redirect()->route('success')->with('success', 'Data saved successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function print($id)
    {
        $diary = Diary::where('id','=',$id)->first();
        $user = User::where('id','=',$diary->author_id)->first();
        $date = $user->created_at->format('M d, Y');
        $name = $user->name;
        $sup = User::where('id','=',$diary->supervisor_id)->first();
        $supervisor = $sup->name;
        $title = 'EOD Report by ' . $name . ' on ' . $date;
        $diary_details = [
            'diary' => $diary,
            'name' => $name,
            'title' => $title,
            'supervisor' => $supervisor,
            'signature' => $sup->signature
        ];
        return view('admin.diaries.print')->with('diary',$diary_details);
    }

    public function show($id)
    {

        $diary = Diary::where('id','=',$id)->first();
        $user = User::where('id','=',$diary->author_id)->first();
        $date = $user->created_at->format('M d, Y');
        $name = $user->name;
        $sup = User::where('id','=',$diary->supervisor_id)->first();
        $supervisor = $sup->name;
        $title = 'EOD Report by ' . $name . ' on ' . $date;
        $diary_details = [
            'diary' => $diary,
            'name' => $name,
            'title' => $title,
            'supervisor' => $supervisor,
            'signature' => $sup->signature
        ];
        return view('admin.diaries.show')->with('diary',$diary_details);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diary = Diary::findOrFail($id);
        $supervisors = User::where('role_as','=',2)->get();
        
        return view('admin.diaries.edit')->with([
            'diary' => $diary,
            'supervisors' => $supervisors,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'plan_today' => 'required',
                'end_day' => 'required',
                'roadblock' => 'required',
                'summary' => 'required',
                'plan_tomorrow' => 'required',
                'supervisor' => 'required'
            ]);
            $diary = Diary::findOrFail($id);
            $diary->update([
                'plan_today' => $request->plan_today,
                'end_today' => $request->end_today,
                'roadblock' => $request->roadblock,
                'summary' => $request->summary,
                'plan_tomorrow' => $request->plan_tomorrow,
                'author_id' => Auth::user()->id,
                'supervisor_id' => $request->supervisor,
            ]);
            $diaries = Diary::all();
            $message = 'EOD Report has been updated!';
            return view('admin.diaries.index')->with([
                'diaries'=>$diaries,
                'success' => $message
            ]);
          
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteDiary = Diary::findOrFail($id);
        $deleteDiary->destroy($id); 
        if($deleteDiary){
            return response()->json(['message' => 'Diary deleted successfully']);
        } else {
            return response()->json(['error' => 'Deletion failed!']);
        }
    }

    public function generateDatatables($request)
    {
        return DataTables::of($request)
                ->addIndexColumn()
                ->addColumn('title', function($data){
                    $date = $data->created_at->format('F j, Y');
                    $author = User::where('id','=',$data->author_id)->first();
                    if(Auth::user()->role_id == 1 || Auth::user()->role == 2){
                        return $title = 'EOD Report for '.$date.' by '.$author->name;
                    } else {
                        return $title = 'EOD Report for '.$date;
                    }
                })
                ->addColumn('status', function($data){
                    $status = '';
                    if($data->status == 0){
                        $status = '<span class="badge badge-danger">Pending</span>';
                    } else {
                        $status = '<span class="badge badge-success">Approved</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="'.route("diaries.show",$data->id).'" data-id="'.$data->id.'" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="'.route("diaries.edit",$data->id).'" data-id="'.$data->id.'" class="btn btn-sm btn-warning editDiary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button data-id="'.$data->id.'" class="btn btn-sm btn-danger" onclick="confirmDeleteDiary('.$data->id.')">
                                    <i class="fas fa-trash"></i>
                                    </button>';
                    return $actionButtons;
                })
                ->rawColumns(['action','status','title','author'])
                ->make(true);
    }
}