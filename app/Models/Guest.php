<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'institution',
        'purpose',
        'visit_date',
        'visit_time',
        'phone',
        'email',
        'guest_category_id',
        'photo',
        'signature',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'visit_time' => 'datetime:H:i',
    ];

    public function category()
    {
        return $this->belongsTo(GuestCategory::class, 'guest_category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeSearch(Builder $query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('institution', 'LIKE', "%{$search}%")
                ->orWhere('purpose', 'LIKE', "%{$search}%")
                ->orWhereHas('category', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('name', 'LIKE', "%{$search}%");
                });
        });
    }

    public function scopeFilterByCategory(Builder $query, $categoryId)
    {
        if ($categoryId) {
            return $query->where('guest_category_id', $categoryId);
        }
        return $query;
    }

    public function scopeFilterByDate(Builder $query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereBetween('visit_date', [$startDate, $endDate]);
        } elseif ($startDate) {
            return $query->where('visit_date', '>=', $startDate);
        } elseif ($endDate) {
            return $query->where('visit_date', '<=', $endDate);
        }
        return $query;
    }

    public static function getTodayVisitors()
    {
        return self::whereDate('visit_date', Carbon::today())->count();
    }

    public static function getWeeklyVisitors()
    {
        return self::whereBetween('visit_date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
    }

    public static function getMonthlyVisitors()
    {
        return self::whereMonth('visit_date', Carbon::now()->month)
            ->whereYear('visit_date', Carbon::now()->year)
            ->count();
    }

    public static function getVisitorsByInstitution($limit = 10)
    {
        return self::selectRaw('institution, COUNT(*) as total')
            ->whereNotNull('institution')
            ->where('institution', '!=', '')
            ->groupBy('institution')
            ->orderBy('total', 'desc')
            ->limit($limit)
            ->get();
    }

    public static function getDailyVisitorsChart($days = 30)
    {
        return self::selectRaw('DATE(visit_date) as date, COUNT(*) as total')
            ->where('visit_date', '>=', Carbon::now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    public function getSignatureUrlAttribute(): ?string
    {
        if (!$this->signature)
            return null;
        if (Str::startsWith($this->signature, 'data:image'))
            return $this->signature;
        return Storage::disk('public')->url($this->signature);
    }
}
