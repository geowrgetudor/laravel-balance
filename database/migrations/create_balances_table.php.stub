<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->morphs('balanceable');
            $table->integer('amount');
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }
};
