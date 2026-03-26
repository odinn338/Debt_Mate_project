<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');                        // اسم الدين
            $table->text('description')->nullable();        // وصف اختياري
            $table->decimal('amount', 10, 2);              // المبلغ الأصلي
            $table->decimal('paid_amount', 10, 2)->default(0); // المبلغ المدفوع
            $table->date('due_date')->nullable();           // تاريخ الاستحقاق
            $table->enum('status', ['pending', 'partial', 'paid', 'overdue'])->default('pending');
            $table->enum('type', ['owed_by_me', 'owed_to_me']); // علي أو ليا
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
