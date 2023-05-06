<?php

namespace Tender\Tests\Mocks;

use Illuminate\Database\Eloquent\Model;
use Tender\TeamHasCurrencies;

class TeamModel extends Model
{
    use TeamHasCurrencies;

    protected $table = 'teams';
}
