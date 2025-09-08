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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('campaign_id')->primary();
            $table->uuid('channel_id');
            $table->uuid('campaign_type_id');
            $table->string('campaign_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreign('channel_id')->references('channel_id')->on('sales_channels')->onDelete('cascade');
            $table->foreign('campaign_type_id')->references('campaign_type_id')->on('campaign_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
