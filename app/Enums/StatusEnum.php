<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Done()
 * @method static static NotDone()
 */
final class StatusEnum extends Enum
{
    const DONE = 'Done';
    const TO_DO = 'To Do';
}
