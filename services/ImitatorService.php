<?php

namespace app\services;

use app\services\exceptions\UnknownCityException;

class ImitatorService {

    public function getDistance(string $from, string $to) : int {
        if (
            mb_strtolower($from) === 'москва'
            &&
            mb_strtolower($to) === 'казань'
        ) {
            // Приблизительное расстояние в км
            return 820;
        } else {
            throw new UnknownCityException();
        }
    }

}