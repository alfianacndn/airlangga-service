<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Facility;
use App\Helpers\Tool;

use Symfony\Component\HttpFoundation\Response;
Use Exception;
class FacilityController extends Controller
{
    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $this->validate($request,[
                "facility_nm" => "required"
            ]);
            $data = $request->all();
            $user= Auth::user();
            $facility = Facility::create([
                "facility_nm" => $data['facility_nm'],
                "create_user" => $user->name
            ]);

            DB::commit();
            return Tool::MyResponse(true,"Create Facility Is Successfully",$facility,Response::HTTP_CREATED);
        }
        catch (Exception $e){
            Db::rollBack();
            return Tool::MyResponse(false,$e,null,Response::HTTP_CREATED);
        }
    }

    public function getall(){
        $get = Facility::get();
        return Tool::MyResponse(true,"Get All Of Facillity is Successfully",$get,Response::HTTP_CREATED);
    }
    public function getbyid($id){
        $get = Facility::find($id);
        return Tool::MyResponse(true,"Get All Of Facillity is Successfully",$get,Response::HTTP_CREATED);
    }

    public function update(Request $request,$id){
        Db::beginTransaction();
        try {
            $this->validate($request,[
                "facility_nm" => "required"
            ]);
            $arg = $request->all();
            $facility = Facility::find($id)->first();

            if (!$facility){
                throw New Exception ('ID of facility is doesnt exist');
            }
            $data['facility_nm'] = $arg['facility_nm'];
            $facility->fill($data);
            $facility->save();
            DB::commit();
            return Tool::MyResponse(true,"Get All Of Facillity is Successfully",$facility,Response::HTTP_CREATED);
        }
        catch (Exception $e){
            Db::rollBack();
            return Tool::MyResponse(false,$e,null,Response::HTTP_CREATED);
        }
    }

    public function delete($id){
        Db::beginTransaction();
        try {
            $facility = Facility::find($id);
            $facility->delete();
            DB::commit();
            return Tool::MyResponse(true,"Delete is successfully",null,Response::HTTP_CREATED);

        }
        catch (Exception $e){
            DB::rollBack();
            throw new Exception($e);
        }
    }
}
