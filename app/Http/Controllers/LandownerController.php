<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Models\LandOwner;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class LandownerController extends Controller
{
    public function index()
    {
        $data = LandOwner::all();
        return view('admin.landowner.index',compact('data'));
    }

    public function store(Request $request)
    {
        
            try{
                $data = new LandOwner();
                $data->name = $request->name;
                $data->phone = $request->phone;
                $data->address = $request->address; 
                $data->voter_id = $request->voter_id; 
                $data->passport_id = $request->passport_id;

                $data->created_by= Auth::user()->id;
                $data->save();

                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
                return response()->json(['status'=> 300,'message'=>$message]);

            }catch (\Exception $e){
                return response()->json(['status'=> 303,'message'=>'Server Error!!']);

            }

    }

    public function edit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = LandOwner::where($where)->get()->first();
        return response()->json($info);
    }

    public function update(Request $request, $id)
    {
        $data = LandOwner::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address; 
        $data->voter_id = $request->voter_id; 
        $data->passport_id = $request->passport_id;
        $data->updated_by= Auth::user()->id;
        

        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function delete($id)
    {
        if(LandOwner::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Listing Deleted']);
        }
        else{
            return response()->json(['success'=>false,'message'=>'Update Failed']);
        }
    }


    public function land($id)
    {
        $data = Land::where('owner_id','=', $id)->get();
        return view('admin.landowner.land',compact('data','id'));
    }

    public function landstore(Request $request)
    {
        
            try{
                $data = new Land();
                $data->mouja = $request->mouja;
                $data->kharij = $request->kharij;
                $data->bs_khotiyan = $request->bs_khotiyan; 
                $data->owner_id = $request->owner_id; 

                $data->created_by= Auth::user()->id;
                $data->save();

                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
                return response()->json(['status'=> 300,'message'=>$message]);

            }catch (\Exception $e){
                return response()->json(['status'=> 303,'message'=>'Server Error!!']);

            }

    }

    public function landedit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Land::where($where)->get()->first();
        return response()->json($info);
    }

    public function landupdate(Request $request, $id)
    {
        $data = Land::find($id);
        $data->mouja = $request->mouja;
        $data->kharij = $request->kharij;
        $data->bs_khotiyan = $request->bs_khotiyan; 
        $data->owner_id = $request->owner_id; 
        $data->updated_by= Auth::user()->id;
        

        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function landdelete($id)
    {
        if(Land::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Listing Deleted']);
        }
        else{
            return response()->json(['success'=>false,'message'=>'Update Failed']);
        }
    }
}
