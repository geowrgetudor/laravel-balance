<?php

namespace Geow\Balance\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Balance extends Model
{
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->guarded[] = $this->primaryKey;
        $this->table = config('balances.table');
    }

    protected function amountCurrency(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->amount / 100,
        );
    }

    public function balanceable(): MorphTo
    {
        return $this->morphTo();
    }
}
