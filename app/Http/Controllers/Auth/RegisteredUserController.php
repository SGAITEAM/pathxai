<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:6'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::min(6)],
            //'g-recaptcha-response' => ['required', 'captcha'], // reCAPTCHA aktifse
            // TODO: reCAPTCHA doğrulamasını AÇ!
        ]);

        // Brand slug oluşturma
        $brand = $request->brand;
        $brandDb = $brand;
        $url = $this->generateUrlFromBrand($brand);

        // Kullanıcıyı oluştur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'brand' => $brandDb,
            'phone' => $request->phone,
            'url' => $url,
            'password' => Hash::make($request->password),
            'is_active' => 1,
            'is_paid' => 1,
        ]);

        // Mail gönder
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'brand' => $brandDb,
            'phone' => $request->phone,
            'url' => $url,
            'mesaj' => 'Yeni Kullanıcı Kaydı Gerçekleşti.'
        ];

        Mail::send('emails.newUserMail', $data, function ($message) {
            $message->from('merhaba@menumood.com', 'MenuMood');
            $message->to(['ascanipek@gmail.com', 'merhaba@menumood.com']);
            $message->to("merhaba@menumood.com");
            $message->subject("Yeni Üye");
        });

        Auth::login($user);
        event(new Registered($user));

        return redirect('/dashboard');
    }

    protected function generateUrlFromBrand($brand): string
    {
        $brand = trim($brand);
        $search = ['&','Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü','  ',' '];
        $replace = ['-','c','c','g','g','i','i','o','o','s','s','u','u','-','-'];
        $brand = str_replace($search, $replace, $brand);
        $brand = preg_replace('/[^A-Za-z0-9\-]/', '', $brand);
        $brand = strtolower(trim($brand, '-'));
        $array = array_filter(explode('-', $brand));
        return implode('-', $array);
    }
}
