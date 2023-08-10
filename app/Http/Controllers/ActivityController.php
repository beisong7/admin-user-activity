<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Services\ActivityService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    protected $service;

    public function __construct(ActivityService $activityService) {
        $this->service = $activityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.activity.index')->with(
            [
                'activities'=>$this->service->all()
            ]
        );
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
        $this->validate($request, [
            'date' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $file = $request->file('image');
        $data = [
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
        ];
        // dd($data);
        return $this->service->store($data, $file);
        // dd($request->all());
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
    public function edit(Request $request, $id)
    {
        $activity = Activity::whereUid($id)->first();
        $data = [
            'activity'=>$activity,
        ];
        if($request->input('type')==='private'){
            $data = [
                'activity'=>$activity,
                'type' => 'type',
                'user_id'=>$request->user_id
            ];
        }
        return view('pages.activity.edit')->with(
            $data
        );
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

        $this->validate($request, [
            'date' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $file = $request->file('image');
        $data = [
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
        ];
        if($request->input('type')==='private'){
            $data['type'] = 'private';
            $data['user_id'] = $request->input('user_id');
        }
        // dd($data);
        return $this->service->update($data, $file, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $this->service->delete($id, $request->input('type'), $request->input('user_id'));
        return back()->withMessage("Completed");
    }
}
