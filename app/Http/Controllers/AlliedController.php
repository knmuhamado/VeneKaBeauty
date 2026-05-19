<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AlliedController extends Controller
{
    public function index()
    {
        $response = $this->fetchData();

        $viewData = [];
        $viewData['byCategory'] = collect($response['data'] ?? [])->groupBy('category');
        $viewData['storeLink'] = $response['additionalData']['storePlantsLink'] ?? '#';

        return view('allied.index')->with('viewData', $viewData);
    }

    private function fetchData(): array
    {
        try {
            $response = Http::timeout(10)->get(config('services.allied.url'));

            if ($response->successful()) {
                return $response->json() ?? [];
            }

            Log::warning('AlliedController: respuesta no exitosa de la API', [
                'status' => $response->status(),
                'url' => config('services.allied.url'),
            ]);

            return [];
        } catch (\Throwable $e) {
            Log::error('AlliedController: fallo al consumir API aliada', [
                'error' => $e->getMessage(),
                'url' => config('services.allied.url'),
            ]);

            return [];
        }
    }
}
