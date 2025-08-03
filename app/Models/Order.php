<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_id',
        'name',
        'email',
        'whatsapp_number',
        'number_of_participants',
        'pickup_location',
        'start_date',
        'end_date',
        'message',
        'status'
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'deleted_at'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'number_of_participants' => 'integer'
    ];

    /**
     * Relationship with Service
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get formatted start date
     */
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date ? $this->start_date->format('d M Y') : '';
    }

    /**
     * Get formatted end date
     */
    public function getFormattedEndDateAttribute()
    {
        return $this->end_date ? $this->end_date->format('d M Y') : '';
    }

    /**
     * Get duration in days
     */
    public function getDurationAttribute()
    {
        if ($this->start_date && $this->end_date) {
            return $this->start_date->diffInDays($this->end_date) + 1;
        }
        return 0;
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        $statusMap = [
            'pending' => 'Pending',
            'confirmed' => 'Dikonfirmasi',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];

        return $statusMap[$this->status] ?? $this->status;
    }

    /**
     * Get WhatsApp number in international format
     */
    public function getCleanWhatsappNumberAttribute()
    {
        // Remove all non-numeric characters
        $cleanNumber = preg_replace('/[^0-9]/', '', $this->whatsapp_number);

        // If starts with 08, replace with 628
        if (substr($cleanNumber, 0, 2) === '08') {
            $cleanNumber = '628' . substr($cleanNumber, 2);
        }
        // If starts with 8 (without 0), add 62
        elseif (substr($cleanNumber, 0, 1) === '8') {
            $cleanNumber = '62' . $cleanNumber;
        }
        // If starts with +62, remove +
        elseif (substr($cleanNumber, 0, 3) === '+62') {
            $cleanNumber = substr($cleanNumber, 1);
        }
        // If doesn't start with 62, assume it's Indonesian number and add 62
        elseif (substr($cleanNumber, 0, 2) !== '62') {
            $cleanNumber = '62' . $cleanNumber;
        }

        return $cleanNumber;
    }
}
