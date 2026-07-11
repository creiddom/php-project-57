<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use App\Services\UnusedResourceDeletionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LabelController extends Controller
{
    public function __construct(
        private readonly UnusedResourceDeletionService $deletionService,
    ) {
        $this->authorizeResource(Label::class, 'label');
    }

    public function index(): View
    {
        $labels = Label::query()
            ->withCount('tasks')
            ->orderBy('name')
            ->get();

        return view('Label.index', compact('labels'));
    }

    public function create(): View
    {
        $label = new Label();

        return view('Label.create', compact('label'));
    }

    public function store(StoreLabelRequest $request): RedirectResponse
    {
        Label::query()->create($request->validated());

        flash(__('messages.label.created'))->success();

        return redirect()->route('labels.index');
    }

    public function edit(Label $label): View
    {
        return view('Label.edit', compact('label'));
    }

    public function update(UpdateLabelRequest $request, Label $label): RedirectResponse
    {
        $label->update($request->validated());

        flash(__('messages.label.modified'))->success();

        return redirect()->route('labels.index');
    }

    public function destroy(Label $label): RedirectResponse
    {
        return $this->deletionService->destroyAndRedirect(
            $label,
            __('messages.label.deleted'),
            __('messages.label.deleted.error'),
            'labels.index',
        );
    }
}
