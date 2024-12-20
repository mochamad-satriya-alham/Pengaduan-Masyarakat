<?php

namespace App\Http\Controllers;

// use App\Models\Login;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SessionController extends Controller
{

    public function loginProses(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //cek jika pengguna sudah ada di database
        $user = User::where('email', $request->email)->first();

        if($user) {
            //jika pengguna ditemukan,coba autentifikasi
            if(Auth::attempt($request->only('email','password'))) {
                
                if($user->role === 'HEAD_STAF') {
                    return redirect()->route('landing_page')->with('success', 'login berhasil');
                } elseif ($user->role ==='STAFF') {
                    return redirect()->route('staff.report')->with('success', 'login berhasil');
                } elseif ($user->role === 'GUEST') {
                    return redirect()->route('landing_page')->with('success', 'login berhasil');
                }    
            } else {
                //jika pengguna belum terdaftaf buat akun sebagai guest
                $guestData = [
                    'email' => $request->email,
                    'password' => bcrypt($request->password),//hash password
                ];

                $guestUser = User::create($guestData);

                //autenfikasi pengguna baru sebagai guest
                Auth::login($guestUser);

                return redirect()->route('landing_page')->with('success', 'Akun anda terdaftar sebagai guest,login berhasil');
            }
        }
    }
    

    public function landing(){
        return view('article.landing');
    }


    public function index(Request $request)
        {
            // Membuat instance dari client Guzzle untuk melakukan HTTP request
            $client = new \GuzzleHttp\Client();
            $url = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';

            // Melakukan permintaan GET untuk mengambil data provinsi
            $response = $client->request('GET', $url);

            // Mengambil isi dari response dalam bentuk string
            $content = $response->getBody()->getContents();
            $dataArray = json_decode($content, true);
            $reports = Report::query();

             // Jika request memiliki parameter 'cari', filter laporan berdasarkan provinsi
            if ($request->has('cari')) {
               // Menyaring laporan yang provinsinya sama dengan parameter 'cari' yang dikirim
            $reports = $reports->where('province', $request->cari);
            }

            // Menjalankan query dan mengambil semua laporan yang sudah difilter
            $reports = $reports->get();

            // Mengembalikan tampilan 'landing' dengan data provinsi dan laporan
            // Menggunakan array ['provinces' => $dataArray] untuk mengirimkan data provinsi ke view
            // compact('reports') digunakan untuk mengirimkan variabel $reports ke view
            return view('article.landing', ['provinces' => $dataArray], compact('reports'));
        }

        public function logout()
        {
            Auth::logout();
            return redirect()->route('login')->with('success', 'Anda Telah Logout');
        }


}