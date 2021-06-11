<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB as DBS;
use Carbon\Carbon;

class CreateTreatments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('treatments', function (Blueprint $table) {
            $expire_date = Carbon::now()->addDays(7);
            $table->bigIncrements('id');
            $table->bigInteger('user_id_patient')->unsigned()->comment('Associated patient');
            $table->bigInteger('user_id_doctor')->unsigned()->comment('Doctor in charge associated');
            $table->bigInteger('type_medicine_id')->unsigned()->nullable()->comment('Kind of medicine associated');
            $table->bigInteger('medicine_administration_id')->nullable()->unsigned()->comment('Medicine administration associated');
            $table->string('description',1000)->nullable()->index()->default(0)->comment('Treatment description');
            $table->date('treatment_starting_date')->nullable()->useCurrent()->comment('Treatment start date');
            $table->date('treatment_end_date')->nullable()->default($expire_date)->comment('Treatment end date. Default 1 week');
            $table->softDeletes();
            $table->timestamps();
        });

        // Artisan::call('db:seed', [
        //     '--class' => TreatmentsTableSeeder::class
        // ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatments');
    }
}
