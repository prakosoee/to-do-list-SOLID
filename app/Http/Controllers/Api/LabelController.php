<?php

namespace App\Http\Controllers\Api;

use App\Models\Label;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LabelRequest;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\LabelServiceInterface;

class LabelController extends Controller
{
    protected LabelServiceInterface $labelService;

    public function __construct(
        LabelServiceInterface $labelService
        )
    {
        $this->labelService = $labelService;
    }

    public function index(): JsonResponse
    {
        $labels = $this->labelService->getAll();
        return response()->json([
            'success' => true,
            'data' => $labels,
        ], Response::HTTP_OK);
    }
    
    public function store(LabelRequest $request): JsonResponse
    {
        $label = $this->labelService->create($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Label berhasil ditambahkan!',
            'data' => $label,
        ], Response::HTTP_CREATED);
    }

    public function show(Label $label): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $label,
        ], Response::HTTP_OK);
    }

    public function update(LabelRequest $request, Label $label): JsonResponse
    {
        $this->labelService->update($label, $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Label berhasil diperbarui!',
            'data' => $label->fresh(),
        ], Response::HTTP_OK);
    }

    public function destroy(Label $label): JsonResponse
    {
        $this->labelService->delete($label);
        return response()->json([
            'success' => true,
            'message' => 'Label berhasil dihapus!',
        ], Response::HTTP_OK);
    }
}
