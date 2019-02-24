<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Auth;
use App\User;
use App\Clinic;
use App\ClinicSlot;

class ClinicController extends Controller
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

    public function renderClinicData(){
        $userData = User::find(Auth::user()->id);
        $clinicData = Clinic::with('clinicSlots')->get();
        
        //restructuring data for ease of display
        $restructuredData = array();
        foreach($clinicData as $index => $slotData){
            foreach($slotData->clinicSlots as $key=> $slot){
                $restructuredData[$slot->day][$key]['slot_id'] = $slot->id;
                $restructuredData[$slot->day][$key]['start_time'] = date("g:i a", strtotime($slot->start_time));
                $restructuredData[$slot->day][$key]['end_time'] = date("g:i a", strtotime($slot->end_time));  
            }
            $clinicData[$index]->clinicSlots = $restructuredData;
            $restructuredData = [];
        }
        return view('partial.renderClinicData',compact('clinicData'));
    }


    /**
     * for deleting slot
     * @param slot_id is the primary key id of clinic slot
     */
    public function deleteSlot(Request $request){
        $result = ClinicSlot::where('id',$request->get('slot_id'))->where("user_id", Auth::user()->id)->delete();
        if($result){
            return response()->json([
                'status' => 1,
                'msg'    => "Slot successfully removed."
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'msg'    => "Some error occured."
            ]);
        }
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
    public function store(Request $request){
        $input_data = $request->get('formData');
        $rules = [
            'clinic_name'   => 'required|max:255',
            'clinic_phone'  => 'required|numeric',
            'clinic_email'  => 'required|email|unique:clinics,clinic_email,',
            'clinic_about'  => 'required|max:300',
            ];

        $validator = Validator::make($input_data, $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()->toArray()
            ]);
        }else{
            Clinic::create([
                "clinic_name"    => ucwords($input_data['clinic_name']),
                "user_id"    => Auth::user()->id,
                "clinic_phone"   => ucwords($input_data['clinic_phone']),
                "clinic_email"   => $input_data['clinic_email'],
                "clinic_about"   => $input_data['clinic_about']
            ]);
            return response()->json([
                'status' => 1,
                'msg'    => "Data saved successfully"
            ]);
        
        }
    }


    public function bookSlot(Request $request){
        $input_data = $request->get('formData');
        $start_time = $input_data['start_time'] = date("H:i", strtotime($input_data['start_time']));
        $end_time   = $input_data['end_time']   = date("H:i", strtotime($input_data['end_time']));
        $rules = [
            'start_time'    => 'required|date_format:H:i',
            'end_time'      => 'required|date_format:H:i|after:start_time',
            'day'          =>  'required'
            ];
        $validator = Validator::make($input_data, $rules);

        if(isset($input_data['day'])){
            //slot availibility code
            $availability =  ClinicSlot::where("user_id", Auth::user()->id)
            ->whereIn('day', $input_data['day'])
            ->where(function ($query) use ($start_time, $end_time) { 
                    $query
                        ->whereBetween('start_time', [$start_time, $end_time])
                        ->orWhere(function ($query) use ($start_time, $end_time) {
                            $query
                                ->whereBetween('end_time', [$start_time, $end_time]);
                        });
                })->count();
            if($availability > 0){
                $validator->errors()->add('start_time', 'Time Slot already booked.');
            }
        }
        //all errors
        $errors = $validator->errors()->toArray();
        if ($validator->fails() || $availability > 0){
            
            return response()->json([
                'status' => 0,
                'errors' => $errors
            ]);
        }else{
            foreach($input_data['day'] as $day){
                ClinicSlot::create([
                    "user_id"       => Auth::user()->id,
                    "clinic_id"     => $input_data['clinic_id'],
                    "day"           => $day,
                    "start_time"    => $start_time,
                    "end_time"      => $end_time
                ]);
            }
            return response()->json([
                'status' => 1,
                'msg'    => "Data saved successfully"
            ]);

            /*
             * $time_in_12_hour_format  = date("g:i a", strtotime("13:30"));
                echo $time_in_12_hour_format;
                // 12-hour time to 24-hour time 
                $time_in_24_hour_format  = date("H:i", strtotime("1:30 PM"));
             */
        
        }
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
