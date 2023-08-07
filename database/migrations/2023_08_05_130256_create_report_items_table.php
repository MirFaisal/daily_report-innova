<?php

use App\Models\ReportDate;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ReportDate::class, 'report_date_id');
            $table->text('content');
            $table->integer('supervised_by')->nullable();
            $table->integer('supervised_at')->nullable();
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(User::class, 'created_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_items');
    }
};