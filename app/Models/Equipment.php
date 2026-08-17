<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments'; 

    protected $fillable = [
        'category_id', 'code', 'name', 'stock', 'condition', 'description',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function loanItems(): HasMany
    {
        return $this->hasMany(LoanItem::class);
    }

    // Unit yang sedang dipinjam saat ini (belum dikembalikan)
    public function unitsOnLoan(): int
    {
        return $this->loanItems()
            ->whereHas('loan', fn ($q) => $q->where('status', 'dipinjam'))
            ->sum('quantity');
    }

    public function availableStock(): int
    {
        return max(0, $this->stock - $this->unitsOnLoan());
    }
}
