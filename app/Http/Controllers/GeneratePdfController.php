<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;
use App\Models\Schedule;
use Carbon\Carbon;
// use Carbon\CarbonInterval;
use PDF;

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
        // use the sched as entered and make set day name array
        $setWithScheds = [];
        // add staff info
        $schedules = $this->collectSchedSets() ;
        

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
        // $this->generatePdf($setWithScheds ) ;


        // eventually download a PDF
    }

    public function generatePdf($setWithScheds ) {
        $margins  =[
            'top' => 10,
            'bottom' => 10,
            'left' => 50,
            'right' => 50,
        ];
        // get todays date time 
        $dateTime = 'Updated: May 21 1982 ' ;// + moment().format('yyyy-mm-dd:hh:mm');;
        
        $titlePos = 30;
        $topOfColumns = 120;
        $leftMargin = 50;
        $taglinePos = 580;

        $postionColumn = 0; // index of added column
        $columnSpacing = 120;

        $namesPerColumn = 48;
        $namesOnPage = $namesPerColumn * 6; // start with 6 columns

        logger("GeneratePdfController");
        PDF::SetTitle('Hello World');
        PDF::SetMargins($margins['left'], $margins['top'],$margins['right'],$margins['bottom']);
        foreach($setWithScheds as $set) {
            // dd($set);

            PDF::AddPage();
            PDF::SetFont('dejavusans', '', 24, '', true);
            // "sequence" => 1
            PDF::Write(0, $set['title']);
            // PDF::Write(64, $set['location']);
            PDF::SetFont('dejavusans', '', 14, '', true);
            PDF::Write(128, $set['worshipLeader']);
            PDF::Write(128, $set['prayerLeader']);
            PDF::Write(128, $set['sectionLeader']);
            // $set['scheds'];
            PDF::SetFont('dejavusans', '', 12, '', true);
            PDF::Write(196, $set['dayOfWeek']);
            PDF::Write(196, $set['setOfDay']);
            

            //$dateTime
        }
        PDF::Output('hello_world.pdf');
    }

    public function collectSchedSets() {
        $schedLines = [];
        foreach(Schedule::where('room', 'GPR')->get() as $schedule) {
            $schedLines[] = $this->modSchedLines($schedule);
        }
        return $schedLines;
    }
    public function modSchedLines($schedule) {
        
        $dayOfWeek = $schedule->day;
        $dayOfWeek = ($dayOfWeek == 'Thursday') ? 'Thurs' : substr($dayOfWeek,0, 3);

        $setOfDay = [
            '12am', '2am', '4am',
            '6am',  '8am', '10am',
            '12pm', '2pm', '4pm',
            '6pm',  '8pm', '10pm'
        ];

        $setSched = [] ;
        forEach($setOfDay as $setTime)  {

            // logger($setTime);
            //     // CarbonInterval::seconds(2),
            $setTimeStartM = Carbon::parse($setTime)->addMinutes(60); //->format('h:i a');
            $setTimeEndM = Carbon::parse($setTime)->subMinutes(60); //->format('h:i a');

            $scheduleStartM = Carbon::parse($schedule->start); //->format('h:i a');
            $scheduleEndM = Carbon::parse($schedule->end); //->format('h:i a');

            $isStart = $scheduleStartM->lte($setTimeStartM );
            $isEnd = $scheduleEndM->gte($setTimeEndM);

            $schedDuration = $scheduleStartM->diffInMinutes($schedule->end);

            if ($isStart && $isEnd  && $schedDuration >= 60 ) {
             // check for duration >= 60 min
                $generatedSched = [
                    'name' => (trim($schedule->staff->firstName). ' ' . trim($schedule->staff->lastName)) ?? "Sam IAm",
                    'day' => $dayOfWeek,
                    'set' => $setTime,
                    'location' => $schedule->room,
                ];
                $setSched[] = $generatedSched;
                logger($generatedSched);
            // } else {
            //     logger("No Match");
            }
        };
        // logger($setSched);
        return $setSched;

    }
}
