<?php

namespace app\controllers;

use app\services\DriverService;
use app\services\ImitatorService;
use yii\rest\Controller;

class DriverController extends Controller
{

    protected $driverService;

    protected $imitatorService;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->driverService = new DriverService();
        $this->imitatorService = new ImitatorService();
    }

    public function actionDrivers(string $from, string $to, int $page) {
        return $this->_baseDriverAction($from, $to, $page);
    }

    public function actionDriver(int $id, string $from, string $to, int $page) {
        return $this->_baseDriverAction($from, $to, $page, $id);
    }

    protected function _baseDriverAction(string $from, string $to, int $page, int $id = null) {
        try {
            $distance = $this->imitatorService->getDistance($from, $to);
        } catch (\Exception $e) {
            $distance = 0;
        }

        return $this->driverService
            ->getDriversWithTravelTime($distance, $page, $id);
    }

}