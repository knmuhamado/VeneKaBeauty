<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AlliedController extends Controller
{
    public function index()
    {
        $phones = $this->fetchPhones();
        return view('allied.index', compact('phones'));
    }

    private function fetchPhones(): array
    {
        if (config('services.allied_store.driver', 'local') === 'api') {
            try {
                $response = Http::timeout(10)->get(config('services.allied_store.url'));
                return $response->successful() ? $response->json() : $this->localData();
            } catch (\Throwable $e) {
                return $this->localData();
            }
        }

        return $this->localData();
    }

    private function localData(): array
    {
        return [
            [
                'id'       => 1,
                'name'     => 'Nokia 1100',
                'memory'   => '12',
                'ram'      => '16',
                'battery'  => '5000',
                'brand'    => 'Apple',
                'price'    => 15000,
                'quantity' => 2,
                'image'    => 'phones/iTXjAQK3VnZ5yL5mAoDD5qoUzAnYxdJRUanLQglS.jpg',
            ],
            [
                'id'       => 2,
                'name'     => 'Iphone 15',
                'memory'   => '12',
                'ram'      => '16',
                'battery'  => '5000',
                'brand'    => 'Apple',
                'price'    => 10000,
                'quantity' => 8,
                'image'    => 'phones/HdgGJbitFVXWN6FOZKtm5IW4wbtWJEqswEL9y4sz.jpg',
            ],
            [
                'id'       => 3,
                'name'     => 'Xiomi ming',
                'memory'   => '256',
                'ram'      => '64',
                'battery'  => '3000',
                'brand'    => 'Xiaomi',
                'price'    => 15000,
                'quantity' => 20,
                'image'    => 'phones/KvMFXFd6GQhGMz4Gg0MNqu9G1ujbOg40oa96Y2OK.jpg',
            ],
        ];
    }
}