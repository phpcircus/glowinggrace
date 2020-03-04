<?php

namespace App\Http\Actions;

use App\Http\Actions\PreparesDataForService;
use PerfectOblivion\ActionServiceResponder\Actions\Action as BaseAction;

class Action extends BaseAction
{
    use PreparesDataForService;
}
