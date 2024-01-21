<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\Crud;

class CrudController extends Controller
{
    public function showData(){
        $showData=Crud::all();
        
        return view('showData', compact('showData'));
    }

    public function addData(){
        return view('addData');
    }

    public function storeData(Request $request){
        $rules=[
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'designation' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'salary' => 'required|numeric',
            'phone_numbers.*' => 'required|numeric', // Validate each phone number
        ];
    
        $this->validate($request, $rules);
    
        $crud = new Crud();
        $crud->name = $request->name;
        $crud->email = $request->email;
        $crud->phone_numbers = json_encode($request->phone_numbers);
        $crud->designation = $request->designation;
        $crud->salary = $request->salary;
        $crud->district = $request->district;
        $crud->upazila = $request->upazila;
        $crud->union = $request->union;
        $crud->save();
    
        Session::flash('msg', 'Data successfully added.');
        return redirect('/add-Data');
    }

    public function editData($id=null){
        $editData=Crud::find($id);
        return view('edit',compact('editData'));
    }


    public function updateData(Request $request,$id){
        $rules=[
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'designation' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'salary' => 'required|numeric',
        ];
        $this->validate($request,$rules);
        $crud= Crud::find($id);
        $crud->name =$request->name;
        $crud->email =$request->email;
        $crud->designation =$request->designation;
        $crud->salary =$request->salary;
        $crud->district =$request->district;
        $crud->upazila =$request->upazila;
        $crud->union =$request->union;
        $crud->save();

        Session::flash('msg','Data succesfully updated.');
        return redirect('/add-Data');

    }

    public function deleteData($id=null){
        $deleteData=Crud::find($id);
        $deleteData->delete();
        Session::flash('msg','Data succesfully deleted.');
        return redirect('/');
    }

}
