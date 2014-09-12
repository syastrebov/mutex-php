<?php

/**
 * PHP-Erlang erl
 * Сервис блокировок для обработки критических секций
 *
 * @category erl
 * @package  erl
 * @author   Sergey Yastrebov <serg.yastrebov@gmail.com>
 * @link     https://github.com/syastrebov/mutex-php
 */

namespace ErlMutex\Adapter;

use ErlMutex\Exception\Exception;

/**
 * Интерфейс адаптера
 *
 * Class AdapterInterface
 * @package ErlMutex\Adapter
 */
interface AdapterInterface
{
    /**
     * Подключиться к сервису блокировок
     *
     * @throws \ErlMutex\Exception\Exception
     * @return boolean
     */
    public function establishConnection();

    /**
     * Закрыть соединение с сервисом
     */
    public function closeConnection();

    /**
     * Получить указатель на блокировку
     *
     * @param string   $name    Имя указателя блокировки
     * @param int|bool $timeout Время жизни блокировки, микросекунды (по истечении времени блокировка снимается)
     *
     * @return string
     * @throws Exception
     */
    public function get($name, $timeout);

    /**
     * Установить блокировку
     *
     * @param string $name Имя указателя блокировки
     * @return bool
     */
    public function acquire($name);

    /**
     * Снять блокировку
     *
     * @param string $name Имя указателя блокировки
     * @return bool
     */
    public function release($name);

    /**
     * Доступно ли подключение к сервису
     *
     * @return bool
     */
    public function isAlive();
}