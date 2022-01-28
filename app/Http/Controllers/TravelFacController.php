<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TravelFac;
use App\Models\TravelPack;
use App\Helpers\Tool;
use App\Models\Facility;
Use Exception;

use Symfony\Component\HttpFoundation\Response;
class TravelFacController extends Controller
{
    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $this->validate($request,[
                "travel_pack_id" => "required",
                "facility_id" => "required",
                "fac_nm" => "required",
            ]);
            $data = $request->all();
            $user= Auth::user();
            $travelpack = TravelPack::where('id',$data['travel_pack_id'])->first();
            if (!$travelpack){
                throw new Exception ('Travel Pack id is not found');
            }
            $newarr = [];
            foreach ($data['facility_id'] as $facility){
                $fac = Facility::where('id', $data['facility_id'])->value('id');
                if (!$fac){
                    throw new Exception ('Facility id is not found');
                }
                // throw new exception ($fac);
                // $travelfac = TravelFac::create([
                //     "travel_pack_id" => $data['travel_pack_id'],
                //     "facility_id" =>$fac,
                //     "fac_nm" => $data['fac_nm'],
                // ]);
                array_push($newarr,$fac);
            }




            DB::commit();
            return Tool::MyResponse(true,"Create Travel Fac Is Successfully",$newarr,Response::HTTP_CREATED);
        }
        catch (Exception $e){
            Db::rollBack();
            return Tool::MyResponse(false,$e,null,Response::HTTP_CREATED);
        }
    }

    public function getall(){
        $get = TravelFac::get();
        return Tool::MyResponse(true,"Get All Of Travel Fac is Successfully",$get,Response::HTTP_CREATED);
    }
    public function getbyid($id){
        $get = TravelFac::find($id);
        return Tool::MyResponse(true,"Get Travel Fac is Successfully",$get,Response::HTTP_CREATED);
    }

    public function update(Request $request,$id){
        Db::beginTransaction();
        try {
            $arg = $request->all();
            $travelfac = TravelFac::find($id)->first();

            if (!$travelfac){
                throw New Exception ('ID of Travel Pack is doesnt exist');
            }
            $data['pack_nm'] = $arg['pack_nm'];
            $data['facility_id'] = $arg['facility_id'];
            $data['fac_nm'] = $arg['fac_nm'];
            $travelfac->fill($data);
            $travelfac->save();
            DB::commit();
            return Tool::MyResponse(true,"Travel Pack is Successfully Updated", $travelfac,Response::HTTP_CREATED);
        }
        catch (Exception $e){
            Db::rollBack();
            return Tool::MyResponse(false,$e,null,Response::HTTP_CREATED);
        }
    }

    public function delete($id){
        Db::beginTransaction();
        try {
            $facility = TravelFac::find($id);
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
