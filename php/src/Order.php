<?php

namespace NodePHPTest;

class Order
{
    public static function save($order)
    {

        $nextID = 1;
        $orders = [];
        $file = file_get_contents(__DIR__ . '/../orders.json');

        if(!empty($file)) {
            $orders = json_decode(($file));
            $nextID = count($orders) + 1;
        }

        $order['id'] = $nextID;
        $orders[] = $order;
        file_put_contents(__DIR__ . '/../orders.json', json_encode($orders), LOCK_EX);
    }

    public static function getAll()
    {
        $orders = [];
        $file = file_get_contents(__DIR__ . '/../orders.json');

        if(!empty($file)) {
            $orders = json_decode(($file));
        }

        return $orders;
    }
}