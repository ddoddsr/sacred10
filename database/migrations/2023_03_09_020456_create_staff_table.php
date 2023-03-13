<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('resultId')->nullable();
            $table->dateTime('startDate')->nullable();
            $table->dateTime('finishDate')->nullable();
            $table->dateTime('updateDate')->nullable();
            $table->char('resultStatus', 100)->nullable();
            $table->char('firstName', 100)->nullable();
            $table->char('lastName', 100)->nullable();
            $table->char('designation', 100)->nullable();
            $table->char('supervisor', 100)->nullable();
            $table->char('superEmail1', 100)->nullable();
            $table->date('effectiveDate')->nullable();
            $table->timestamps();
        });
    }

    /**
    +"resultId": "17925859"
    +"dateStart": "2023-01-02T17:58:50Z"
    +"dateFinish": "2023-01-02T18:19:12Z"
    +"dateUpdate": "2023-01-02T18:19:12Z"
    +"resultStatus": "Complete"
    +"firstName": "Linda "
    +"lastName": "King"
    +"designation": "Full-Time Ministry Staff"
    +"department": "Partners Care Team"
    +"supervisor": "Brian Pendleton"
    +"superEmail1": "brianpendleton@ihopkc.org"
    +"superEmail2": ""
    +"effectiveDate": "01/03/2023"
    +"sched": array:10 [▶]
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
