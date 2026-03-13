<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Repositories\ProductRepository;
use Carbon\Carbon;


class DashboardController extends Controller
{   
    /**
     * Display the dashboard.
     *
     * @param ProductRepository $productRepository
     * @return \Illuminate\View\View
    */

    public function index()
    {
        $user = Auth::user();

        $userData = (object)[
            'name' => 'Demo Kullanıcı',
            'brand' => 'Demo Marka',
            'lang' => 'tr',
            'email' => 'demo@example.com',
            'phone' => '+90 555 555 5555',
            'date' => now()->subDays(5),
            'expire' => now()->addDays(9),
            'is_order' => false,
            'can_order' => true,
            'paid' => false,
            'logo' => '/img/logo-mail-tiny.png',
            'diff' => 9,
        ];
        $countProd = 0;
        $countCat = 0;

        return view('dashboard.dashboard', compact('userData', 'countProd', 'countCat'));

    }

}
