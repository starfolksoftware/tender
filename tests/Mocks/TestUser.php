<?php

namespace Tender\Tests\Mocks;

use Illuminate\Foundation\Auth\User;

class TestUser extends User
{
    protected $table = 'users';
}