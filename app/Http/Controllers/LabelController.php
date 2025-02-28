<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LabelRequest;
use App\Services\Interfaces\LabelServiceInterface;

class LabelController extends Controller
{
    protected $labelService;

    public function __construct(LabelServiceInterface $LabelService)
    {
        $this->labelService = $LabelService;
    }

    public function index(): View
    {
        $search = request('search');
        $labels = $this->labelService->getAll($search);
        return view('label.index', compact('labels', 'search'));
    }

    public function create(): View
    {
        return view('label.create');
    }

    public function store(LabelRequest $request): RedirectResponse
    {
        $this->labelService->create($request->validated());
        return redirect()->route('label.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Label $label): View
    {
        $this->labelService->authorize($label);
        return view('label.edit', compact('label'));
    }


    public function update(LabelRequest $request, Label $label): RedirectResponse
    {
        $this->labelService->update($label, $request->validated());
        return redirect()->route('label.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Label $Label): RedirectResponse
    {
        $this->labelService->delete($Label);
        return redirect()->route('label.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
