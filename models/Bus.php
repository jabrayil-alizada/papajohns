<?php

namespace app\models;

use yii\db\ActiveRecord;

class Bus extends ActiveRecord {

    public static function tableName()
    {
        return '{{buses}}';
    }
}