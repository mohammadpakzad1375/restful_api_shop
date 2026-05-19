<?php

use Morilog\Jalali\Jalalian;

function jalaliDate($date, $format = '%A, %d %B %y'): string
{
    return Jalalian::forge($date)->format($format);
}
