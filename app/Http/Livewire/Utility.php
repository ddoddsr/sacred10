<?php

namespace App\Http\Livewire;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Schedule;
use App\Http\Controllers\Pdf;
use App\Http\External\FormsiteController;

class Utility extends Component
{

    public $confirmingStaffDeletion = false;
    
    public function render()
    {
        return view('livewire.utility');
    }

    public function importNewestStaffSchedules() 
    {
        logger("importNewestStaffSchedules");
    }
    
    public function truncateSchedule() 
    {
    //    logger("Truncating Schedule");
       Schedule::truncate();
    }

    public function importStaffSchedules() 
    {
        logger("Importing Staff and Schedule");
        $fooSite = new FormsiteController;
        $fooSite->storeForms();
    }
    
    public function generateStaffSetdPdf() 
    {
        logger("Generating Staff Set Schedule");
        // $pdf = new Pdf;
        // $pdf->test();
    }


}
