<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use App\Models\Order;
use GuzzleHttp\Client;
use App\Mail\OrderShipped;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Aws\S3\MultipartUploader;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\OrderResource;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CustomOrderRequest;
use App\Http\Requests\ProductOrderRequest;
use Aws\Exception\MultipartUploadException;
use Illuminate\Session\Middleware\StartSession;

class OrderController extends Controller
{
    
    public function sendCodeOnEmail(Request $request)
    {
        if (!Order::where('email', $request->input('email'))->exists()) {
            return response('Заказ с почтой ' . $request->input('email') . ' нет.', 200);
        }
        $code = Str::random(10);
        session([$request->input('email') => $code]);
        try {
            Mail::to($request->input('email'))->send(new OrderShipped($code));
            return response()->noContent();
        } catch (\Exception $e) {
            return response("Некорректная почта.", 200);
        }
        return response("Ошибка. Почта не отправлена.", 200);
    }

    public function index(Request $request)
    {
        if (session($request->input('email')) == $request->input('code')) {
            return OrderResource::collection(
                Order::with('products', 'materials')
                    ->where('email', $request->get('email'))
                    ->get()
            );
        } else {
            return response()->noContent();
        }
    }

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
            $products[$product['id']] = ['number_products' => $product['selectedNumber']];
        }
        $order->products()->attach($products);
        return  $request->token;
    }

    public function makeCustomOrder(ProductOrderRequest $request)
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
        foreach ($request->input('selected_products') as $material) {
            $materials[$material['id']] = ['number_materials' => $material['setupNumber']];
        }
        $order->materials()->attach($materials);

        return  $request->token;
    }
}
