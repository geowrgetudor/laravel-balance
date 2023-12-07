<?php

namespace Geow\Balance\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Geow\Balance\Models\Balance;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasBalance
{
    public function credits(): MorphMany
    {
        return $this->morphMany(Balance::class, 'balanceable');
    }

    protected function credit(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->credits()->sum('amount'),
        );
    }

    protected function creditCurrency(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->credits()->sum('amount') / 100,
        );
    }

    public function increaseCredit(int $amount, ?string $reason = null): Balance
    {
        return $this->createCredit($amount, $reason);
    }

    public function decreaseCredit(int $amount, ?string $reason = null): Balance
    {
        return $this->createCredit(-1 * abs($amount), $reason);
    }

    public function setCredit(int $amount, ?string $reason = null): Balance
    {
        return $this->createCredit($amount, $reason);
    }

    public function resetCredit(): void
    {
        $this->credits()->delete();
    }

    public function hasCredit(): bool
    {
        return $this->credit > 0;
    }

    protected function createCredit(int $amount, ?string $reason = null): Balance
    {
        return $this->credits()->create([
            'amount' => $amount,
            'reason' => $reason,
        ]);
    }
}
