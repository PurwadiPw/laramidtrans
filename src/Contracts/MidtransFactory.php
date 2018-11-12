<?php
namespace Pw\Midtrans\Contracts;

interface MidtransFactory extends BaseFactory {
    public static function getSnapToken($data);
}