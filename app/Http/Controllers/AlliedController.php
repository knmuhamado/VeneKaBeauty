<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

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

            Log::warning(__('allied.api_response_failure'), [
                'status' => $response->status(),
                'url' => config('services.allied.url'),
            ]);

            return [];
        } catch (Throwable $e) {
            Log::error(__('allied.api_fetch_error'), [
                'error' => $e->getMessage(),
                'url' => config('services.allied.url'),
            ]);

            return [];
        }
    }
}
