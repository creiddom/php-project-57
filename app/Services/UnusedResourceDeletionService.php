<?php

namespace App\Services;

use App\Models\Label;
use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;

class UnusedResourceDeletionService
{
    public function deleteIfUnused(Label|TaskStatus $model): bool
    {
        if ($model->tasks()->exists()) {
            return false;
        }

        return $model->delete();
    }

    public function destroyAndRedirect(
        Label|TaskStatus $model,
        string $successMessage,
        string $errorMessage,
        string $indexRoute,
    ): RedirectResponse {
        if ($this->deleteIfUnused($model)) {
            flash($successMessage)->success();
        } else {
            flash($errorMessage)->error();
        }

        return redirect()->route($indexRoute);
    }
}
