<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Resources\Folder as FolderResource;
use App\Http\Resources\WorkPaper as WorkPaperResource;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new FolderResource(Folder::all());
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
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $folder = Folder::create($request->all());

        if ($folder) {
            return response()->json(['success'=>true, 'msg' => 'Record Succesfully Added'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        //
        return new FolderResource($folder);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        //

        return new FolderResource($folder);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        //
        try {
            $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()], 400);
            }

            $folder->name = $request->get('name');
            $folder->description = $request->get('description');

            if ($folder->save()) {
                return response()->json(['success'=>true, 'msg' => 'Record Succesfully Updated'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success'=>false, 'msg' => 'Folder not found'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        //
        if ($folder->delete()) {
            return response()->json(['success'=>true, 'msg' => 'Record Succesfully Deleted'], 200);
        }
        return response()->json(['success'=>false, 'msg' => 'Folder not found'], 400);
    }
    public function papers(Folder $folder)
    {
        return new FolderResource($folder->working_papers);
    }
}
