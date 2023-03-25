<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Set;
use App\Models\Schedule;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\FPDF;

class Pdf extends FPDF
{
    public function __construct($orentation = 'L', $unit = 'pt', $size = 'Letter')
    {
        parent::__construct($orentation, $unit, $size);
    }

    public function setSchedule($location='GPR')
    {
        // get staff sched into sets
        $setRecords = Set::all();
        $setWithScheds = [];

        foreach ($setRecords as $setData ) {
            // Get all  names for this set
            $setWithScheds[] = [
                'sequence' => $setData->sequence,
                'dayOfWeek' => $setData->dayOfWeek,
                'setOfDay' => $setData->setOfDay,
                'location' => $setData->location ,
                'sectionLeader' => $setData->sectionLeader ,
                'worshipLeader' => $setData->worshipLeader ,
                'prayerLeader' => $setData->prayerLeader ,
                'title' => $setData->title ,
                'scheds' =>  $this->collectSchedSets($setData->dayOfWeek, $setData->setOfDay, $location) ,
            ];
        }

        unset($setRecords);
        $this->generatePdf($setWithScheds) ;
    }

    public function generatePdf($setWithScheds ) {

        // get todays date time
        $dateTime = 'Updated: ' . Carbon::now()->format('M d Y');

        $this->SetTitle('Sacred Trust');
        $this->SetAutoPageBreak(true,5);

        $leaderWidth = $this->GetPageWidth() -35 ;
        $taglinePos =  - 20 ;
        $tagline = env('FOOTER_STATEMENT','Set FOOTER_STATEMENT in .env');
        $topOfColumns = 80;
        $postionColumn = 0; // index of name column

        $namesPerColumn = 48;
        $maxColumns = 6;
        foreach($setWithScheds as $set) {
            $maxNamesOnPage = $namesPerColumn * $maxColumns ; // start with 6 columns
            if ( $maxNamesOnPage  < 22) {
                $nameFontSize = 10;
                $rowHeight = 12;
                $maxColumns = 6;
            } else {
                $nameFontSize = 8;
                $rowHeight = 10;
                $maxColumns = 7;
            }
            $columnSpacing = $this->GetPageWidth() / $maxColumns -5;

            $this->AddPage();
            $this->SetFont('Arial', 'B', 24);

            $this->Cell(0,0, $set['title'], 0, 1, 'C');

            $this->Ln(32);
            $this->SetFont('Arial', 'B', 14);
            $this->Cell($leaderWidth,0, "Worship Leader" .$set['worshipLeader']  , 0, 1, 'L');
            $this->Cell($leaderWidth,0, "Prayer Leader" . $set['prayerLeader'], 0, 1, 'C');
            $this->Cell($leaderWidth,0, "Section Leader" . $set['sectionLeader']  , 0, 1, 'R');
            $this->Ln(32);
            $this->SetFont('Arial', '', $nameFontSize);

            $rowCount = 0;
            $postionColumn = 0;

            foreach($set['scheds'] as $name ) {
                if ($name != '' ) {
                    $rowCount++;

                    $this->Text( 50 +($columnSpacing * $postionColumn),
                        $topOfColumns + ( $rowCount * $rowHeight), $name );

                    if ($rowCount != 1 && $rowCount % $namesPerColumn == 0) {
                        $postionColumn++;
                    }
                    if( $namesPerColumn == $rowCount ) { $rowCount = 0; }

                }
            }

            $this->SetFont('Arial', 'B', 12);

            $this->SetY( $taglinePos );
            $this->Cell( $leaderWidth, 0, $set['dayOfWeek'] . ' ' . $set['setOfDay'], 0, 1, 'L');
            $this->SetFont('Arial', 'B', 10);
            $this->Cell( $leaderWidth, 0, $tagline, 0, 1, 'C');
            $this->SetFont('Arial', 'B', 12);
            $this->Cell( $leaderWidth ,0, $dateTime, 0, 1, 'R');

            //$dateTime
        }
        $this->Output('I');
        // Or a file $this->Output('F', 'staff-set-schedule.pdf');
        exit;
    }
    
    public function collectSchedSets($day, $set, $location) {
        $schedLines = [];
        $daysOfWeek = [];
        $daysOfWeek['Sun'] = 'Sunday';
        $daysOfWeek['Mon'] = 'Monday';
        $daysOfWeek['Tues'] = 'Tuesday';
        $daysOfWeek['Weds'] = 'Wednesday';
        $daysOfWeek['Thur'] = 'Thursday';
        $daysOfWeek['Fri'] = 'Friday';
        $daysOfWeek['Sat'] = 'Saturday';
        foreach(Schedule::where('room', $location)
                       ->where('day' , $daysOfWeek[$day])
                        ->get() as $schedule) {
            $schedLines[] = $this->modSchedLines($set, $schedule);
            // logger($day);
        }
        // logger($schedLines);
        return $schedLines;
        // return sort($schedLines);
    }
    public function modSchedLines($setTime, $schedule) {

        $dayOfWeek = $schedule->day;
        $dayOfWeek = ($dayOfWeek == 'Thursday') ? 'Thurs' : substr($dayOfWeek,0, 3);

        $setOfDay = [
            '12am', '2am', '4am',
            '6am',  '8am', '10am',
            '12pm', '2pm', '4pm',
            '6pm',  '8pm', '10pm'
        ];

        $setSched = [] ;
        
            $setTimeStartM = Carbon::parse($setTime)->addMinutes(60); //->format('h:i a');
            $setTimeEndM = Carbon::parse($setTime)->subMinutes(60); //->format('h:i a');

            $scheduleStartM = Carbon::parse($schedule->start); //->format('h:i a');
            $scheduleEndM = Carbon::parse($schedule->end); //->format('h:i a');

            $isStart = $scheduleStartM->lte($setTimeStartM );
            $isEnd = $scheduleEndM->gte($setTimeEndM);

            $schedDuration = $scheduleStartM->diffInMinutes($schedule->end);

            if ($isStart && $isEnd  && $schedDuration >= 60 ) {
             // check for duration >= 60 min
                // $generatedSched = [
                //     'name' => (trim($schedule->staff->firstName). ' ' . trim($schedule->staff->lastName)) ?? "Sam IAm",
                //     'day' => $dayOfWeek,
                //     'set' => $setTime
                // ];
                return (trim($schedule->staff->firstName). ' ' . trim($schedule->staff->lastName)); //$generatedSched;
                // logger($generatedSched);
            } else {
                return ;
                // logger("No Match");
            }
    

    }
    public function test() {
        logger("PdfController");
        // set page ('P',')
        $pdf = new FPDF('P','mm','LETTER');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 18);

        //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

        $pdf->Cell(40,10,'Hello World !',1,1);
        $pdf->Cell(60,10,'Powered by FPDF.',0,1,'C');
        $pdf->Cell(60,10,'Powered by FPDF.',0,1,'C');
        $pdf->Cell(60,10,'Powered by FPDF.',0,1,'C');
        //          H  V
        $pdf->Text(10,200,"THis is the Text method");
        $pdf->Output('D');
        
        exit;

    }
}
