<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%drivers_buses_map}}`.
 */
class m200925_164443_create_drivers_buses_map_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('drivers_buses_map', [
            'id' => $this->primaryKey(),
            'driver_id' => $this->integer()->notNull(),
            'bus_id' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp()->null()
        ]);

        $this->addForeignKey(
            'fk-drivers-driver_id',
            'drivers_buses_map',
            'driver_id',
            'drivers',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-buses-bus_id',
            'drivers_buses_map',
            'bus_id',
            'buses',
            'id',
            'CASCADE'
        );

        $timestamp = new Expression('NOW()');

        $this->batchInsert(
            'drivers_buses_map',
            [
                'driver_id',
                'bus_id',
                'updated_at',
                'created_at',
            ],
            [
                [1, 1, $timestamp, $timestamp],
                [2, 2, $timestamp, $timestamp],
                [2, 5, $timestamp, $timestamp],
                [3, 4, $timestamp, $timestamp],
                [4, 5, $timestamp, $timestamp],
                [5, 3, $timestamp, $timestamp],
                [5, 6, $timestamp, $timestamp],
                [6, 1, $timestamp, $timestamp],
                [6, 2, $timestamp, $timestamp],
                [6, 3, $timestamp, $timestamp],
                [6, 7, $timestamp, $timestamp],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down() {
        return false;
    }
}
