<?php

namespace App\Http\Controllers;
use App\Doctor;
use App\Department;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;
use Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.doctor.list', [
            'doctors' => Doctor::all(),
        ]);
    }

    public function DoctorAdd()
    {
        $depertments = Department::all();
        return view('backend.doctor.add', [
            'depertments' => $depertments
        ]);
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
        $validatedData = $request->validate([
            'first_name' => 'required|string|between:2,30',
            'last_name' => 'required|between:2,30',
            'email' => 'required|email|unique:doctors',
            'password' => 'required',
            'designation' => 'nullable|string|max:250',
            'department' => 'nullable|string|max:250',
            'address' => 'required',
            'phone' => 'nullable|string',
            'mobile' => 'required|min:5|max:15|regex:/[0-9]{9}/|not_regex:/(([a-zA-z])(\d)?$)/u',
            'short_biography' => 'nullable|string',
            'image' => 'nullable|image',
            'specialist' => 'required|string',
            'birth_date' => 'nullable|date',
            'sex' => 'required|string',
            'blood_group' => 'nullable|min:2|max:5',
            'education_degree' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        // print_r($request->except('_token'));
        $doctor_id = Doctor::insertGetId($request->except('_token','image') + [
            'created_at' => Carbon::now()
        ]);

        if ($request->hasFile('image')) {
            $uploaded_photo = $request->file('image');
            $photo_name = $doctor_id.".".$uploaded_photo->getClientOriginalExtension($uploaded_photo);
            $new_photo_location = 'public/dashboard/photo/doctor_image/'.$photo_name;

            Image::make($uploaded_photo)->resize(500,385)->save(base_path($new_photo_location), 50);
            Doctor::find($doctor_id)->update([
                'image' => $photo_name
            ]);
        }

        User::insert([
            'name' => $request->first_name,
            'email' => $request->email,
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);
        return redirect('/doctor')->with('success_status', 'Doctor created successfully!');
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
}
