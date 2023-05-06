<?php

namespace Tender\Tests\Mocks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tender\HasCurrencies;

class TestProduct extends Model
{
    use HasCurrencies;
    use HasFactory;

    protected $table = 'products';
}
