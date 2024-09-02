<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class NASA
{
    private string $base_url = 'https://api.nasa.gov';


    protected Collection $data;

    /**
     * Feed date limit is only for 7 days
     *
     * @param string $start_date
     * @param $end_date
     */
    public function __construct(string $start_date = '2024-09-01', string $end_date= '2024-09-07')
    {
        $this->data = HTTP::baseUrl($this->base_url)
            ->get("/neo/rest/v1/feed", [
                "start_date" => $start_date,
                "end_date" => $end_date,
                "detailed" => false,
                "api_key" => config('services.nasa.key'),
            ])->collect();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return collect($this->data['near_earth_objects'])->flatten(1);
    }

    /**
     * @return Collection
     */
    public function dailyCount(): Collection
    {
        return collect($this->data['near_earth_objects'])->map(function ($item,$key) {
            return $item[$key] = count($item);
        });
    }
    /**
     * @return Collection
     */
    public function fastest(): Collection
    {
        return $this->getAll()->sortByDesc(function ($neo) {
            return $neo['close_approach_data'][0]['relative_velocity']['kilometers_per_hour'];
        });
    }

    /**
     * Closest Asteroid (Respective Asteroid ID & its distance)
     *
     * @return Collection
     */
    public function closest(): Collection
    {
        return $this->getAll()->sortBy(function ($neo) {
            return $neo['close_approach_data'][0]['miss_distance']['kilometers'];
        });
    }

    /**
     * Average Size of the Asteroids in kilometers
     *
     * @return float|int
     */
    public function average()
    {
        return $this->getAll()->avg(function ($neo) {
            return $neo['estimated_diameter']['kilometers']['estimated_diameter_max'];
        });
    }
}
