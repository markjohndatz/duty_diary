<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;


class ApprovalRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            
            if(Auth::user()->role_as == 1){
                $diaries = Diary::all();
                return $this->generateDatatables($diaries);
            } 

            $diaries = Diary::where('status','=',0)->where('supervisor_id',Auth::user()->id)->get();
            return $this->generateDatatables($diaries);
        };

        return view('admin.approval-requests.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            'supervisor' => $supervisor
        ];
        return view('admin.approval-requests.show')->with('diary',$diary_details);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function generateDatatables($request)
    {
        return DataTables::of($request)
                ->addIndexColumn()
                ->addColumn('author', function($data){
                    $author = '';
                    $name = User::where('id','=',$data->author_id)->first();
                    return $author = $name->name;
                })
                ->addColumn('status', function($data){
                    $status = '';
                    if($data->status == 0){
                        $status = '<span class="badge badge-warning">Pending</span>';
                    } elseif($data->status == 1) {
                        $status = '<span class="badge badge-success">Approved</span>';
                    } else {
                        $status = '<span class="badge badge-danger">Rejected</span>';
                    }
                    return $status;
                })
                ->addColumn('title', function($data){
                    $title = '';
                    $user = User::where('id','=',$data->author_id)->first();
                    $date = $user->created_at->format('M d, Y');
                    $name = $user->name;
                    $title = 'EOD Report by ' . $name . ' on ' . $date;
                    return $title;
                })
                ->addColumn('action', function($data){
                    if($data->status == 1){
                        $hideApproveBtn = 'd-none';
                        $hideRejectBtn = '';
                    } else {
                        $hideApproveBtn = '';
                        $hideRejectBtn = 'd-none';
                    }

                    $actionButtons = '<a href="'.route("approval-requests.show",$data->id).'" data-id="'.$data->id.'" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                      </a>
                                      <button data-id="'.$data->id.'" class="btn btn-sm btn-success '.$hideApproveBtn.'btn-'.$data->id.'" onclick="approveDiary('.$data->id.')">
                                        <i class="fas fa-check"></i>
                                      </button>';
                                  
                    return $actionButtons;
                })
                ->rawColumns(['action','role','author','status'])
                ->make(true);
    }
}
