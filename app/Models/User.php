<?php

namespace App\Models;

use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use App\Hesabe\Controllers\PaymentController;
use App\Models\Financial_transaction;
use App\Models\Price;
use App\Mail\PackageSubscribtion;
use Mail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'name',
        'phone',
        'password',
        'session_limit',
        'logintoken',
        'role_id',
        'email',
        'suspend',
        'finish',
        'high',
        'otp',
        'payed'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    static function upsertInstance($request)
    {
        if ($request->password) {
            $user = User::updateOrCreate(
                [
                    'id' => $request->id ?? null
                ],
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'high' => $request->high,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' => 2,
                ]
            );
        } else {
            $user = User::updateOrCreate(
                [
                    'id' => $request->id ?? null
                ],
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'high' => $request->high,
                    'email' => $request->email,
                ]
            );    

            $name = $user->name;
        }

        return $user;
    }

    static function payment($request)
    {
        $request->merge([
            'package_number' => Price::first()->id,
            'cost' => Price::first()->price
        ]);

        $date = \Carbon\Carbon::now();
        $request->merge([
            // 'merchantCode' => '842217',
            'merchantCode' => '88750523',
            'amount' => $request->cost,
            'currency' => 'KWD',
            'paymentType' => '1',
            'orderReferenceNumber' => $date->timestamp,
            'variable1' => $request->package_number,
            'variable2' => $request->cost,
            'variable3' => $request->id,
            'variable4' => null,
            'variable5' => null,
            'paymentType' => '0',
            'responseUrl' => 'https://inv.khereej.org/payment/save',
            'failureUrl' => 'https://inv.khereej.org/payment/save',
            'version' => '2.0',
            'isOrderReference' => '1'
        ]);

        // $payment_data = [
        //     'user_id' => $request->id,
        //     'package_number' => $request->package_number,
        //     'cost' => $request->cost,
        //     'time' => $date
        // ];

        $paymentController = new PaymentController();
        $url = $paymentController->formSubmit($request);

        // $request->session()->regenerate();
        // session()->put('payment.data', $payment_data);
        // Cache::put('payment.data', $payment_data, now()->addMinutes(30));
        // cookie('payment.data', json_encode($payment_data));

        // $credential = [
        //     'username' => Auth::user()->email,
        //     'password' => Auth::user()->password,
        // ];
        
        // Cache::put('credential', $credential, now()->addMinutes(30));
        
        header("Location: $url");
        exit;
    }

    static function saveData($request)
    {
        // if (!Auth::check()) {
        //     if (Cache::has('credential')) {
        //         $credential = Cache::get('credential');
        //     } else {
        //         return false;
        //     }

        //     $user = User::where('email', $credential['username'])->first();
        //     Auth::login($user);
        // }

        $paymentController = new PaymentController();
        $response = $paymentController->getPaymentResponse($request->data);

        $payment_data_cookie = json_decode(cookie('payment.data'));
        $payment_data_cache = Cache::get('payment.data');

        // $package_number = $payment_data_cache['package_number'] ?? $payment_data_cookie['package_number'] ?? getDataFromPayment('package_number');
        // $user_id = $payment_data_cache['user_id'] ?? $payment_data_cookie['user_id'] ?? getDataFromPayment('user_id');

        Financial_transaction::create([
            'resultCode' => $response->status ? 'CAPTURED' : 'NOT CAPTURED',
            'total_amount' => $response->response['amount'],
            'paymentToken' => $response->response['paymentToken'],
            'paymentId' => $response->response['paymentId'],
            'paidOn' => $response->response['paidOn'],
            'orderReferenceNumber' => $response->response['orderReferenceNumber'],
            'variable1' => $response->response['variable1'],
            'variable2' => $response->response['variable2'],
            'variable3' => $response->response['variable3'],
            'variable4' => $response->response['variable4'],
            'variable5' => $response->response['variable5'],
            'method' => $response->response['method'],
            'administrativeCharge' => $response->response['administrativeCharge'],
            'paid' => $response->status ? 1 : 0,
            'package_number' => $response->response['variable1'],
            'user_id' => $response->response['variable3'],
        ]);

        if ($response->status) {
            User::where('id', $response->response['variable3'])->update([
                'suspend' => 0,
                'payed' => 1,
            ]);

            header("Location: https://inv.khereej.org/payment/success");
            exit;

            // if($user->email){
            //     Mail::to($user->email)->send(new PackageSubscribtion($user->name));
            // }
        }

        // Cache::flush();
        // cookie()->forget('payment.data');
        // $request->session()->regenerate();

        header("Location: https://inv.khereej.org/payment/failure");
        exit;
    }

    public function getAvatarNameAttribute()
    {
        $name = Auth::user()->name;
        $nameParts = explode(' ', trim($name));
        $firstName = array_shift($nameParts);
        $lastName = array_pop($nameParts);

        $initials = (
            mb_substr(ucfirst($firstName), 0, 1) . ($lastName ?
            mb_substr(ucfirst($lastName), 0, 1) : mb_substr(ucfirst($firstName), 0, 1))
        );

        return $initials;
    }

    static function statusUpdate($request)
    {
        return User::where('id', $request->id)->update(['activation' => $request->activation]);
    }

    static function payUpdate($request)
    {
        return User::where('id', $request->id)->update(['payed' => $request->payed, 'suspend' => 0]);
    }
    
    static function otpUpdate($request)
    {
        return User::where('id', $request->id)->update(['otp' => $request->otp]);
    }

    static function limitUpdate($request)
    {
        return User::where('id', $request->id)->update(['session_limit' => $request->limit]);
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request['name'])) {
            $query->where('name', 'like', '%' . $request['name'] . '%')
                ->orWhere('phone', 'like', '%' . $request['name'] . '%');
        }

        return $query;
    }

    static function modifyPassword($request)
    {
        return User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
    }

    //Roles
    public function isAdmin()
    {
        return Auth::user()->role_id == ADMIN;
    }

    public function deleteInstance()
    {
        return $this->delete();
    }

    public function list()
    {
        return $this->hasMany(UserFav::class);
    }

    public function financials()
    {
        return $this->hasMany(Financial_transaction::class);
    }
}
