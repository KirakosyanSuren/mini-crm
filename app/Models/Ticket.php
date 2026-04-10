<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'customer_id',
        'subject',
        'description',
        'status',
        'manager_response_at'
    ];

    public function customer (): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('tickets')
            ->useDisk('public');
    }

    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeByCustomer(Builder $query, string $email, ?string $phone): Builder
    {
        return $query->whereHas('customer', function ($q) use ($email, $phone) {
            $q->where('email', $email)
                ->orWhere('phone', $phone);
        });
    }

    public function scopeStatisticPeriod(Builder $query, Carbon $date): Builder
    {
        return $query->where('created_at', '>=', $date);
    }
}
