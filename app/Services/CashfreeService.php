<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CashfreeService
{
    private $appId;
    private $secretKey;
    private $baseUrl;
    private $apiVersion;

    public function __construct()
    {
        $this->appId = config('cashfree.app_id');
        $this->secretKey = config('cashfree.secret_key');
        $this->baseUrl = config('cashfree.base_url');
        $this->apiVersion = '2025-01-01';
    }

    public function createPaymentLink($linkData)
    {
        $url = $this->baseUrl . '/links';
        
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'x-api-version' => $this->apiVersion,
            'x-client-id' => $this->appId,
            'x-client-secret' => $this->secretKey,
        ];

        try {
            $response = Http::withHeaders($headers)->post($url, $linkData);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Cashfree payment link creation failed', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);
            
            return ['error' => $response->body(), 'status' => $response->status()];
        } catch (\Exception $e) {
            Log::error('Cashfree API error: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    public function getPaymentLink($linkId)
    {
        $url = $this->baseUrl . '/links/' . $linkId;
        
        $headers = [
            'Accept' => 'application/json',
            'x-api-version' => $this->apiVersion,
            'x-client-id' => $this->appId,
            'x-client-secret' => $this->secretKey,
        ];

        try {
            $response = Http::withHeaders($headers)->get($url);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            return null;
        } catch (\Exception $e) {
            Log::error('Cashfree payment link fetch error: ' . $e->getMessage());
            return null;
        }
    }
}