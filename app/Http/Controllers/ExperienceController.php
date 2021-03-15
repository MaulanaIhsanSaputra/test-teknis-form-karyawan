<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Experience;
use Redirect,Response;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiences = Experience::latest()->paginate(4);
		return view('educations.index',compact('experiences'))->with('i', (request()->input('page', 1) - 1) * 4);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r=$request->validate([
            'perusahaan' => 'required',
            'jabatan' => 'required',
            'tahun' => 'required',
            ]);
    
            $expId = $request->exp_id;
            Experience::updateOrCreate(['id' => $expId],['perusahaan' => $request->perusahaan, 'jabatan' => $request->jabatan,'tahun'=>$request->tahun]);
            if(empty($request->exp_id))
                $msg = 'Experience entry created successfully.';
            else
                $msg = 'Experience data is updated successfully';
            return redirect()->route('educations.index')->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('educations.show',compact('education'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
		$experience = Experience::where($where)->first();
		return Response::json($experience);
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
        $experience = Experience::where('id',$id)->delete();
		return Response::json($experience);
    }
}
