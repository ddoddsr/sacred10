<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;
use App\Models\Schedule;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function storeRecord($formData)
    {
       foreach($formData as $form) {

           if( $form->resultStatus == 'Complete') {
                $staffRecord = Staff::firstOrCreate(
                    [   // search params
                        'firstName' => $form->firstName,
                        'lastName' => $form->lastName
                    ],
                    // [] of any additional data to add to record
                    $this->formPrep($form)
                );
                // If a record exists what to do about it,
                if ( $staffRecord->resultId != $form->resultId ) {
                    // dd($form->sched);
                    //logger("Found Existing ", ['Exist' => $staffRecord->resultId, 'Form' => (int)$form->resultId]);
                    if ( $staffRecord->resultId < (int)$form->resultId ) {
                        //logger(" ID Less  ", ['Exist' => $staffRecord->resultId, 'Form' => (int)$form->resultId]);
                        // DO Nothing
                    } else {
                      //  logger(" ID Greater", ['Exist' => $staffRecord->resultId, 'Form' => (int)$form->resultId]);
                        // replace data in DB with new record
                    }

                } else {
                    // this is a new record added
                    //logger("Add new ", ['Exist' => $staffRecord->resultId, 'Form' => (int)$form->resultId]);
                    // collect schedules, add
                    // $scheds = [];
                    // dd($form->sched );
                    foreach($form->sched as $schedLine){
                        if  (property_exists($schedLine, 'day' ) ){

                             $scheds =
                            new Schedule(
                                [
                                    'day' => $schedLine->day,
                                    'start' => $schedLine->start,
                                    'end' => $schedLine->end,
                                    'room' => $schedLine->location,
                                ]
                            );
                            $staffRecord->schedules()->save($scheds);
                        }
                    }
                }
            }
        }
    }

    public function formPrep($form) {
        return [
            'resultId' => $form->resultId ,
            'startDate' => \Carbon\Carbon::parse($form->startDate)->format('Y-m-d H:i:s'),
            'finishDate' => \Carbon\Carbon::parse($form->finishDate) ->format('Y-m-d H:i:s'),
            'updateDate' => \Carbon\Carbon::parse($form->updateDate)->format('Y-m-d H:i:s'),
            'resultStatus' => $form->resultStatus,
            'designation' => $form->designation,
            'supervisor' => $form->supervisor,
            'superEmail1' => $form->superEmail1,
            'effectiveDate' => \Carbon\Carbon::parse($form->effectiveDate)->format('Y-m-d'),
        ];
    }


    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
