<?php

namespace Geow\Balance\Traits;

use Geow\Balance\Models\Balance;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Number;

trait HasBalance
{
    protected ?string $currency = null;

    /**
     * Get the currency for this balance instance.
     * Returns the configured default currency if not explicitly set.
     */
    protected function getCurrency(): string
    {
        return $this->currency ?? config('balance.default_currency', 'USD');
    }

    public function credits(): MorphMany
    {
        return $this->morphMany(Balance::class, 'balanceable');
    }

    public function withCurrency(string $currency): self
    {
        $clone = clone $this;
        $clone->currency = $currency;

        return $clone;
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
            get: fn () => Number::currency($this->credits()->sum('amount') / 100, $this->getCurrency(), App::getLocale()),
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
