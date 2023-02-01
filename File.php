<?php

class File
{
    /**
     * @param array $delivery
     * $delivery = [
     *       [
     *          'botId' => 1,
     *          'shop' => 2,
     *          'client' => 3,
     *          'product' => 1234,
     *          'quantity' => 4,
     *       ],
     *       [
     *          'botId' => 1,
     *          'shop' => 2,
     *          'client' => 1,
     *          'product' => 1234,
     *          'quantity' => 4,
     *       ]
     * ];
     * @return void
     */
    public static function saveClientDelivery(array $delivery): void
    {
        try {
            $filename = "deliveries.csv";
            $string = '';

            foreach ($delivery as $row) {
                $botId = $row['botId'] ?? '';
                $shop = $row['shop'] ?? '';
                $client = $row['client'] ?? '';
                $product = $row['product'] ?? '';
                $quantity = $row['quantity'] ?? '';

                $string .= "$botId,$shop,$client,$product,$quantity" . PHP_EOL;
            }

            file_put_contents($filename, $string, FILE_APPEND);
        }catch (Exception $exception){
            echo 'Failed to put data in file: '. $exception->getMessage();
        }
    }
}
