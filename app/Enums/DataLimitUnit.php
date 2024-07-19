<?php

namespace App\Enums;

enum DataLimitUnit: string
{
    case Bytes = 'Bytes';
    case KB = 'KB';
    case MB = 'MB';
    case GB = 'GB';
}
