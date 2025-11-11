<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\City;
use App\Models\Locations;

class LocationSeeder extends Seeder
{
    private const LOCATIONS_PER_CITY = 50;
    private string $apiKey;

    public function run(): void
    {
        $this->apiKey = config('services.google_maps.api_key');

        if (empty($this->apiKey)) {
            $this->command->error('Google Maps API key not found. Please set GOOGLE_MAPS_API_KEY in your .env file.');
            return;
        }

        $cities = City::all();

        if ($cities->isEmpty()) {
            $this->command->warn('No cities found in the database.');
            return;
        }

        $this->command->info("Starting to seed locations for {$cities->count()} cities...");

        foreach ($cities as $city) {
            $this->command->info("Processing: {$city->name}");
            $this->seedLocationsForCity($city);
        }

        $this->command->info('Location seeding completed!');
    }

    private function seedLocationsForCity(City $city): void
    {
        $locations = $this->fetchLocationsFromGoogle($city);

        if (empty($locations)) {
            $this->command->warn("No locations found for {$city->name}");
            return;
        }

        $savedCount = 0;
        
        foreach ($locations as $locationData) {
            try {
                Locations::updateOrCreate(
                    [
                        'city_id' => $city->id,
                        'name' => $locationData['name'],
                    ],
                    [
                        'latitude' => $locationData['latitude'],
                        'longitude' => $locationData['longitude'],
                        'description' => $locationData['description'] ?? null,
                        'phone_number' => $locationData['phone_number'] ?? null,
                        'address' => $locationData['address'] ?? null,
                    ]
                );
                $savedCount++;
            } catch (\Exception $e) {
                $this->command->error("Failed to save location: {$locationData['name']} - {$e->getMessage()}");
            }
        }

        $this->command->info("Saved {$savedCount} locations for {$city->name}");
    }

    private function fetchLocationsFromGoogle(City $city): array
    {
        $locations = [];
        $nextPageToken = null;
        $radius = 5000;

        while (count($locations) < self::LOCATIONS_PER_CITY) {
            $response = $this->makeGooglePlacesRequest($city, $radius, $nextPageToken);

            if (!$response['success']) {
                break;
            }

            foreach ($response['results'] as $place) {
                $locations[] = $this->formatLocationData($place, $city);

                if (count($locations) >= self::LOCATIONS_PER_CITY) {
                    break 2;
                }
            }

            $nextPageToken = $response['next_page_token'] ?? null;
            
            if (!$nextPageToken) {
                if (count($locations) < self::LOCATIONS_PER_CITY && $radius < 50000) {
                    $radius += 5000;
                    $nextPageToken = null;
                } else {
                    break;
                }
            } else {
                sleep(2);
            }
        }

        return $locations;
    }

    private function makeGooglePlacesRequest(City $city, int $radius, ?string $pageToken = null): array
    {
        $params = [
            'location' => "{$city->latitude},{$city->longitude}",
            'radius' => $radius,
            'key' => $this->apiKey,
        ];

        $touristTypes = [
            'tourist_attraction',
            'museum',
            'art_gallery',
            'park',
            'church',
            'synagogue',
            'hindu_temple',
            'mosque',
            'amusement_park',
            'aquarium',
            'zoo',
            'stadium',
            'shopping_mall',
            'restaurant',
            'cafe',
        ];

        $params['type'] = $touristTypes[array_rand($touristTypes)];

        if ($pageToken) {
            $params['pagetoken'] = $pageToken;
        }

        try {
            $response = Http::withOptions(['verify' => false])->timeout(30)
                ->get('https://maps.googleapis.com/maps/api/place/nearbysearch/json', $params);

            $data = $response->json();

            if ($response->successful() && isset($data['status']) && $data['status'] === 'OK') {
                return [
                    'success' => true,
                    'results' => $data['results'] ?? [],
                    'next_page_token' => $data['next_page_token'] ?? null,
                ];
            }

            $this->command->error("Google API Error: " . ($data['status'] ?? 'Unknown error'));
            return ['success' => false, 'results' => []];

        } catch (\Exception $e) {
            $this->command->error("Request failed: {$e->getMessage()}");
            return ['success' => false, 'results' => []];
        }
    }

    private function formatLocationData(array $place, City $city): array
    {
        $details = $this->fetchPlaceDetails($place['place_id'] ?? null);

        return [
            'name' => $place['name'] ?? 'Unknown Location',
            'latitude' => $place['geometry']['location']['lat'] ?? $city->latitude,
            'longitude' => $place['geometry']['location']['lng'] ?? $city->longitude,
            'description' => $details['description'] ?? null,
            'phone_number' => $details['phone_number'] ?? null,
            'address' => $place['vicinity'] ?? $details['address'] ?? null,
        ];
    }

    private function fetchPlaceDetails(?string $placeId): array
    {
        if (!$placeId) {
            return [];
        }

        try {
            $response = Http::withOptions(['verify' => false])->timeout(10)->get('https://maps.googleapis.com/maps/api/place/details/json', [
                'place_id' => $placeId,
                'fields' => 'formatted_phone_number,editorial_summary,formatted_address',
                'key' => $this->apiKey,
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['status']) && $data['status'] === 'OK') {
                $result = $data['result'] ?? [];
                
                return [
                    'phone_number' => $result['formatted_phone_number'] ?? null,
                    'description' => $result['editorial_summary']['overview'] ?? null,
                    'address' => $result['formatted_address'] ?? null,
                ];
            }
        } catch (\Exception $e) {
        }

        return [];
    }
}