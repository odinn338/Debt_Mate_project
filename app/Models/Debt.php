<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'amount',
        'paid_amount',
        'due_date',
        'status',
        'type',
    ];

    protected $casts = [
        'due_date'    => 'date',
        'amount'      => 'decimal:2',
        'paid_amount' => 'decimal:2',
    ];

    // العلاقات
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // المبلغ المتبقي
    public function getRemainingAmountAttribute(): float
    {
        return $this->amount - $this->paid_amount;
    }

    // نسبة السداد
    public function getPaymentPercentageAttribute(): float
    {
        if ($this->amount == 0) return 0;
        return round(($this->paid_amount / $this->amount) * 100, 1);
    }

    // هل متأخر؟
    public function isOverdue(): bool
    {
        return $this->due_date && $this->due_date->isPast() && $this->status !== 'paid';
    }

    // تحديث الـ status تلقائياً بعد كل دفعة
    public function updateStatus(): void
    {
        if ($this->paid_amount >= $this->amount) {
            $this->status = 'paid';
        } elseif ($this->paid_amount > 0) {
            $this->status = 'partial';
        } elseif ($this->isOverdue()) {
            $this->status = 'overdue';
        } else {
            $this->status = 'pending';
        }
        $this->save();
    }
}
