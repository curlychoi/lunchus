<?php

namespace App\Exceptions;

use Exception;

class AlreadyRegisterTodayRestaurantException extends Exception
{
    protected $code = 400;
}
