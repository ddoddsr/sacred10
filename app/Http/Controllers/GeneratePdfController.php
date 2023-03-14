<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;
use App\Models\Schedule;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class GeneratePdfController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        logger('generating');
        // get staff sched into sets
        $setRecords = Set::all();
        $setWithScheds = [];
        // use the sched as entered and make set day name array
        $schedules = $this->collectSchedSets() ;
        // get sets
        foreach ($setRecords as $setData ) {
            // logger($setData);
            // Get all  names for this set
            // $names = $schedules[how to get?];
            $setWithScheds[] = [
                'sequence' => $setData->sequence,
                'dayOfWeek' => $setData->dayOfWeek,
                'setOfDay' => $setData->setOfDay,
                'location' => $setData->location ,
                'sectionLeader' => $setData->sectionLeader ,
                'worshipLeader' => $setData->worshipLeader ,
                'prayerLeader' => $setData->prayerLeader ,
                'title' => $setData->title ,
                'scheds' =>  $schedules
            ];
        }
        // unset($schedules);
        // unset($setRecords);
        $this->generatePdf($setWithScheds ) ;

        // add staff info

        // eventually download a PDF
    }

    public function generatePdf($setWithScheds ) {
        
    }

    public function collectSchedSets() {
        $schedules = Schedule::all();
        $schedLines = [];
        foreach($schedules as $schedule) {
            $schedLines[] = $this->modSchedLines($schedule);
        }

        return $schedLines;
    }
    public function modSchedLines($schedule) {
        // logger($schedule);
        $dayOfWeek = $schedule->day;
        $dayOfWeek = ($dayOfWeek == 'Thursday') ? 'Thurs' : substr($dayOfWeek,0, 3);

        $setOfDay = [
            '12am', '2am', '4am',
            '6am', '8am', '10am',
            '12pm', '2pm', '4pm',
            '6pm','8pm','10pm'
        ];

        $setSched = [] ;
        forEach($setOfDay as $setTime)  {

            logger($setTime);
            //     // CarbonInterval::seconds(2),
            $setTimeStartM = Carbon::parse($setTime)->addMinutes(60); //->format('h:i a');
            $setTimeEndM = Carbon::parse($setTime)->subMinutes(60); //->format('h:i a');

            $scheduleStartM = Carbon::parse($schedule->start); //->format('h:i a');
            $scheduleEndM = Carbon::parse($schedule->end); //->format('h:i a');

            $isStart = $scheduleStartM->lte($setTimeStartM );
            $isEnd = $scheduleEndM->gte($setTimeEndM);

            $schedDuration = $scheduleStartM->diffInMinutes($schedule->end);
// if (
//     $schedDuration >= 60 && $isStart
// ) {

//     logger([
//         // 'setTime' => $setTime,
//         // 'setTimeStartM' => $setTimeStartM->format('h,i a'),
//         'scheduleStartM' => $scheduleStartM->format('h,i a'),
//         // 'isStart' => $isStart ,
//         // 'setTimeEndM' => $setTimeEndM->format('h,i a'),
//         'scheduleEndM' => $scheduleEndM->format('h,i a'),
//         // 'isEnd' => $isEnd,
//         'duration' =>$schedDuration,
//     ]);
// }
            if ($isStart && $isEnd  && $schedDuration >= 60 ) {
             // check for duration >= 60 min
                $generatedSched = [
                    'day' => $dayOfWeek,
                    'set' => $setTime,
                    'prayerRoom' => $schedule->room,
                ];
                $setSched[] = $generatedSched;
            //     logger($generatedSched);
            // } else {
            //     logger("No Match");
            }
        };
// logger($setSched);
        return $setSched;

    }
}
