<?php

namespace App\View\Composers;

use App\Services\TaskFormOptionsService;
use Illuminate\View\View;

class TaskFormOptionsComposer
{
    public function __construct(
        private readonly TaskFormOptionsService $taskFormOptions,
    ) {
    }

    public function compose(View $view): void
    {
        $view->with($this->taskFormOptions->forView($view->name()));
    }
}
