<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;

class DiariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $diaries = Diary::all();
            return $this->generateDatatables($diaries);
        }
    
        $diaries = Diary::all(); // Fetch diaries here
        return view('admin.diaries.index')->with('diaries', $diaries);
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
    
            $validatedData = $request->validate([
                'plantoday' => 'required',
                'eod' => 'required',
                'roadblock' => 'required',
                'summary' => 'required',
                'plantomorrow' => 'required',
                'supervisor' => 'required'
            ]);

            $diary = Diary::create([
                'plan_today' => $request->plantoday,
                'end_day' => $request->eod,
                'roadblock' => $request->roadblock,
                'summary' => $request->summary,
                'plan_tomorrow' => $request->plantomorrow,
                'author_id' => Auth::user()->id,
                'supervisor_id' => $request->supervisor,
                'status' => 0
            ]);

            $diaries = Diary::all();

               return redirect()->route('diaries.index')->with('success_message', 'Diary entry created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        return view('admin.diaries.edit')->with('diary',$diary);
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
            $validatedData = $request->validate([
                'plantoday' => 'required',
                'eod' => 'required',
                'roadblock' => 'required',
                'summary' => 'required',
                'plantomorrow' => 'required',
                'supervisor' => 'required'
            ]);

            $diary = Diary::findOrFail($id);
            
            
            $diary->update([
                'plan_today' => $request->plantoday,
                'end_day' => $request->eod,
                'roadblock' => $request->roadblock,
                'summary' => $request->summary,
                'plan_tomorrow' => $request->plantomorrow,
                'author_id' => Auth::user()->id,
                'supervisor_id' => $request->supervisor,
                'status' => 0
            ]);

            $diaries = Diary::all();

            return view('admin.diaries.index')->with([
                'diaries'=>$diaries
            ]);
            return redirect()->route('success')->with('success', 'Data saved successfully!');
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
                return 'EOD Report for '.$date.' by '.$author->name;
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
                $actionButtons = '<a href="'.route("diaries.edit",$data->id).'" data-id="'.$data->id.'" class="btn btn-sm btn-warning editDiary">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <button data-id="'.$data->id.'" class="btn btn-sm btn-danger deleteDiary">
                                    <i class="fas fa-trash"></i>
                                  </button>';
                return $actionButtons;
            })
            ->rawColumns(['title','status','action']) // Include 'title' in rawColumns
            ->make(true);
    }
    
}
