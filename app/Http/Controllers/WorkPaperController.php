<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Resources\Folder as FolderResource;
use App\Http\Resources\WorkPaper as WorkPaperResource;

use App\WorkPaper;
use Illuminate\Http\Request;

class WorkPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return new FolderResource(Folder::all());
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
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
            'folder_id' => 'required|exists:folders,id'
            ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $workPaper = WorkPaper::create($request->all());

        if ($workPaper) {
            return response()->json(['success'=>true, 'msg' => 'Record Succesfully Added'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkPaper  $workPaper
     * @return \Illuminate\Http\Response
     */
    public function show(WorkPaper $working_paper)
    {
        //
        return new WorkPaperResource($working_paper);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkPaper  $workPaper
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkPaper $working_paper)
    {
        //
        return response([
            'data' => [
                'work_paper' => $working_paper,
                'folders' => Folder::all()
            ]
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkPaper  $workPaper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkPaper $working_paper)
    {
        //
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
            'folder_id' => 'required|exists:folders,id'
            ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $working_paper->name = $request->get('name');
        $working_paper->content = $request->get('content');
        $working_paper->folder_id = $request->get('folder_id');

        if ($working_paper->save()) {
            return response()->json(['success'=>true, 'msg' => 'Record Succesfully Updated'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkPaper  $workPaper
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkPaper $working_paper)
    {
        //
        if ($working_paper->delete()) {
            return response()->json(['success'=>true, 'msg' => 'Record Succesfully Deleted'], 200);
        }
        return response()->json(['success'=>false, 'msg' => 'Working Paper not found'], 400);
    }
}
