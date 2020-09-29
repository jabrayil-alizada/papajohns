<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%drivers}}`.
 */
class m200925_160358_create_drivers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('drivers', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'patronymic' => $this->string()->null(),
            'birth_date' => $this->date(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp()->null()
        ]);

        $timestamp = new Expression('NOW()');

        $this->batchInsert(
            'drivers',
            [
                'name',
                'surname',
                'patronymic',
                'birth_date',
                'updated_at',
                'created_at',
            ],
            [
                ["Иван", "Егоров", "Андреевич", '1990-01-01', $timestamp, $timestamp],
                ["Александр", "Петров", "Дмитриевич", '1993-01-02', $timestamp, $timestamp],
                ["Владимир", "Князев", "Владимирович", '1989-04-05', $timestamp, $timestamp],
                ["Анастасия", "Иванова", "Владиславовна", '1988-07-06', $timestamp, $timestamp],
                ["Константин", "Борисов", "Анатольевич", '1991-09-09', $timestamp, $timestamp],
                ["Герман", "Волков", "Сергеевич", '1984-05-17', $timestamp, $timestamp],
                ["Екатерина", "Морозова", "Игоревна", '1991-08-02', $timestamp, $timestamp],
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
