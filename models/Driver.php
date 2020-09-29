<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class Driver extends ActiveRecord {

    public $driver_name;

    public $driver_id;

    public $bus_name;

    public $avg_speed;

    public static function tableName()
    {
        return '{{drivers}}';
    }

    public function getDrivers(
        int $offset = 0,
        int $limit = 10,
        int $id = null
    ) {
        $query = $this::find()
            ->select([
                'drivers.id as driver_id',
                'drivers.name AS driver_name',
                'drivers.surname',
                'drivers.patronymic',
                'drivers.birth_date',
                'buses.name AS bus_name',
                'buses.avg_speed as avg_speed'
            ])
            ->join('INNER JOIN', 'drivers_buses_map', 'drivers_buses_map.driver_id = drivers.id')
            ->join('INNER JOIN', 'buses', 'drivers_buses_map.bus_id = buses.id')
            ->orderBy("avg_speed DESC");

        if ($id) {
            $query = $query->where(["drivers.id" => $id]);
        }

        return $query->offset($offset)
            ->limit($limit)
            ->all();
    }
}