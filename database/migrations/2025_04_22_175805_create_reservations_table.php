<?php

use App\Models\Room;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('startDate')->index();
            $table->dateTime('endDate')->index();
            $table->string('email');
            $table->foreignIdFor(Room::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('phone');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->decimal('price', 8, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
