<?php

namespace App\Http\Controllers\Concerns;

use App\Contracts\DeletableIfUnused;
use Illuminate\Http\RedirectResponse;

trait DestroysUnusedResource
{
    protected function destroyUnusedAndRedirect(
        DeletableIfUnused $model,
        string $successMessage,
        string $errorMessage,
        string $indexRoute,
    ): RedirectResponse {
        if ($model->deleteIfUnused()) {
            flash($successMessage)->success();
        } else {
            flash($errorMessage)->error();
        }

        return redirect()->route($indexRoute);
    }
}
