<?php
namespace App\Traits;

trait FormatCart {
    public function format($id, $name, $amount, $price, $picture) {
        return [
            'id' => $id,
            'name' => $name,
            'qty' => $amount,
            'price' => $price,
            'weight' => config('setting.default_weight'),
            'options' => [
                'picture' => $picture,
            ]
        ];
    }
}
