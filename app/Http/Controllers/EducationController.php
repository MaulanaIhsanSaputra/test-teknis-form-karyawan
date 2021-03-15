<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Education;
use App\Experience;
use Redirect,Response;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educations = Education::latest()->paginate(4);
        $experiences = Experience::latest()->paginate(4);
		return view('educations.index')->with(compact('educations'))
        ->with(compact('experiences'))
        ->with('i', (request()->input('page', 1) - 1) * 4);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('educations.create');
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
            'sekolah' => 'required',
            'jurusan' => 'required',
            'tahun_masuk' => 'required',
            'tahun_lulus' => 'required',
            ]);
    
            $eduId = $request->edu_id;
            Education::updateOrCreate(['id' => $eduId],['sekolah' => $request->sekolah, 'jurusan' => $request->jurusan,'tahun_masuk'=>$request->tahun_masuk,
            'tahun_lulus'=>$request->tahun_lulus]);
            if(empty($request->edu_id))
                $msg = 'Education entry created successfully.';
            else
                $msg = 'Education data is updated successfully';
            return redirect()->route('educations.index')->with('success',$msg);
            
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
		$education = Education::where($where)->first();
		return Response::json($education);
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
        $education = Education::where('id',$id)->delete();
		return Response::json($education);
    }
}
