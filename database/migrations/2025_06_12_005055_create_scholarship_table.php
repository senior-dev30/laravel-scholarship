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
        Schema::create('scholarship', function (Blueprint $table) {
            $table->id();

            $table->string('scholarshipType');
            $table->string('newOrReEntry');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('emailAddress')->unique();
            $table->string('phoneNumber');
            $table->string('streetAddress');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('programInterest');
            $table->string('admissionsAdvisor');

            $table->boolean('agreeSignature');
            $table->boolean('agreeSMS');

            $table->text('signatureTextInput');
            $table->date('dateSigned');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarship');
    }
};
