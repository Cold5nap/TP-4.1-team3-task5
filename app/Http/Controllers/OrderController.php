<?php

namespace App\Http\Controllers;

use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CustomOrderRequest;
use App\Http\Requests\ProductOrderRequest;

class OrderController extends Controller
{
    protected function checkRecaptcha($token, $ip)
    {
        $response = (new Client)->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret'   => config('recaptcha.secret'),
                'response' => $token,
                'remoteip' => $ip,
            ],
        ]);
        $response = json_decode((string)$response->getBody(), true);
        return $response['success'];
    }

    public function makeProductOrder(ProductOrderRequest $request)
    {
        if (config('recaptcha.enabled') && !$this->checkRecaptcha($request->token, $request->ip())) {
            return response()->json([
                'error' => 'Captcha is invalid.',
            ], Response::HTTP_BAD_REQUEST);
        }

        $order = new Order();
        $order->date = $request->input('date');
        $order->address = $request->input('address');
        $order->name_surname  = $request->input('name_surname');
        $order->phone_number = $request->input('phone_number');
        $order->email = $request->input('email');
        $order->description = $request->input('description');
        $order->is_paid = false;
        $order->status = 'Принят на рассмотрение.';
        $order->save();
        
        $products = [];
        foreach ($request->input('selected_products') as $product) {
            $products[$product['id']] = ['number_product' => $product['selectedNumber']];
        }
        $order->products()->attach($products);

        return  'Успешно произведен.';
    }

    public function makeCustomOrder(CustomOrderRequest $request)
    {
        if (config('recaptcha.enabled') && !$this->checkRecaptcha($request->token, $request->ip())) {
            return response()->json([
                'error' => 'Captcha is invalid.',
            ], Response::HTTP_BAD_REQUEST);
        }

        $order = new Order();
        $order->date = $request->input('date');
        $order->address = $request->input('address');
        $order->name_surname  = $request->input('name_surname');
        $order->phone_number = $request->input('phone_number');
        $order->email = $request->input('email');
        $order->description = $request->input('description');
        $order->is_paid = false;
        $order->status = 'Принят на рассмотрение.';
        $order->save();
        
        $materials = [];
        foreach ($request->input('selected_materials') as $material) {
            $materials[$material['id']] = ['number_material' => $material['setupNumber']];
        }
        $order->materials()->attach($materials);

        return  'Успешно произведен.';
    }
}
