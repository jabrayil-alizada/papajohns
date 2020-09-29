<?php

namespace app\services;

use app\models\Driver;

class DriverService {

    const MAX_TRAVEL_TIME = 8;

    public function getDriversWithTravelTime(
        float $distance,
        int $page = 1,
        int $id = null
    ) {
        $limit = 10;

        if ($page > 1) {
            $offset = ($page - 1) * $limit;
        } else {
            $offset = 0;
        }

        $drivers = (new Driver())
            ->getDrivers(
                $offset,
                $limit,
                $id
            );

        $result = [];

        $today = new \DateTimeImmutable('now');

        foreach($drivers as $driver) {

            $travelTime = $this->_calcTravelTime(
                $distance,
                $driver["avg_speed"]
            );

            if ($travelTime <= self::MAX_TRAVEL_TIME) {
                $result[] = [
                    "id" => $driver["driver_id"],
                    "name" => $driver["surname"] . ' ' . $driver["driver_name"] . ' ' . $driver["patronymic"],
                    "birth_date" => $driver["birth_date"],
                    "age" => $this->_calcAge(
                        $today,
                        (new \DateTimeImmutable($driver["birth_date"]))
                    ),
                    "travel_time" => $travelTime
                ];
            }

        }

        return $result;
    }

    protected function _calcAge(
        \DateTimeImmutable $today,
        \DateTimeImmutable $birthDate
    ) {
        return $today->diff($birthDate)->format('%Y');
    }

    /**
     * $distance in kilometers
     * $avgSpeed kilometers per hour
     *
     * @param float $distance
     * @param float $avgSpeed
     * @return float|int
     */
    protected function _calcTravelTime(float $distance, float $avgSpeed) {
        return round($distance / $avgSpeed, 3);
    }

}