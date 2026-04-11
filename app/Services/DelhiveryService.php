<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use NguyenHuy\Delhivery\Delhivery;
use App\Contracts\LogisticsHandler;


class DelhiveryService implements LogisticsHandler
{
    /**
     * Create a new shipment.
     */
    /**
     * Summary of createShipment
     * @param array $shipmentData
     * @param array<list<array<{product_title: string, quantity: int, price: float}>> $orderProducts
     * @param string<"COD"|"Prepaid"> $payment_mode
     * @return void
     */
    public function createShipment(array $shipmentData, array $orderProducts, string $payment_mode)
    {
        $total_items = count($orderProducts);
        $waybill_records = DB::table('delhivery_waybills')->take($total_items)->pluck('waybill_number', 'id')->toArray();
        $waybills = array_values($waybill_records);
        $waybill_ids = array_keys($waybill_records);

        $shipment_data = [];

        foreach($orderProducts as $key=> $product) {
            $waybill = $waybills[$key];
            $shipment_data[$key] = [
                'mps_children' => $total_items,
                'master_id' => $waybill,
                'waybill' => $waybill,
                'shipment_type' => 'MPS',
                'name' => $shipmentData['name'],
                'add' => $shipmentData['address'],
                'address_type' => 'home',
                'pin' => $shipmentData['pin_code'],
                'city' => $shipmentData['city'],
                'state' => $shipmentData['state'],
                'phone' => $shipmentData['phone_number'],
                'order' => "ORDER-".$shipmentData['id'],
                'payment_mode' => $payment_mode,
                'products_desc' => $product['product_title'],
                'total_amount' => $product['price'] * $product['quantity'],
                'quantity' => $product['quantity'],
                'shipment_width' => 100,
                'shipment_height' => 100,
                'weight' => 50,
                'shipping_mode' => 'Surface',
                'plastic_packaging' => true
            ];
    
            if($payment_mode === 'COD') {
                $shipment_data[$key]['mps_amount'] = $shipmentData['total_price'];
                $shipment_data[$key]['cod_amount'] = $product['price'] * $product['quantity'];
            }
        }
        // dd($shipment_data);
        DB::table('delhivery_waybills')->whereIn('id', $waybill_ids)->delete();

        $orderDetails = [
            // refer above url for required parameters 
            'shipments' => $shipment_data,
            'pickup_location' => ['name' => 'Shandhani Apartment'],
        ];

        $response =  Delhivery::order()->create($orderDetails);
        
        if($response->get('success')) {
            // Need to store shipment details and add shipment charges to the order
        }
    }
}
