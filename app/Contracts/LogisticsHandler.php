<?php

namespace App\Contracts;

interface LogisticsHandler
{
    public function createShipment(array $shipmentData, array $orderProducts, string $payment_mode);
}
