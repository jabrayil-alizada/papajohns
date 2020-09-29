<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%buses}}`.
 */
class m200925_153130_create_buses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('buses', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'avg_speed' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp()->null()
        ]);

        $timestamp = new Expression('NOW()');

        $this->batchInsert(
            'buses',
            [
                'name',
                'avg_speed',
                'updated_at',
                'created_at',
            ],
            [
                ["Mercedes 1995", 85, $timestamp, $timestamp],
                ["BMW 1995", 85, $timestamp, $timestamp],
                ["Audi 2004", 110, $timestamp, $timestamp],
                ["Mercedes 1987", 70, $timestamp, $timestamp],
                ["BMW 1990", 80, $timestamp, $timestamp],
                ["Ford 2005", 120, $timestamp, $timestamp],
                ["Ford 2007", 125, $timestamp, $timestamp],
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
