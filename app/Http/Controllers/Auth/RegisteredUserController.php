<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'nullable'
        ]);

        $user = $this->createData($request);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function createData(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return $user;
    }

    public function registerApi(Request $request, LoginController $loginController){
        DB::beginTransaction();
        try {
            //code...
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'no_telp' => ['required'],
                'pekerjaan' => ['required'],
                'provinsi_id' => ['required'],
                'kota_id' => ['required'],
                'kecamatan_id' => ['required'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'jenis' => ['required', Rule::in('ayah','ibu')]
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $dataOrangTua = [
                'user_id' => $user->id,
                'nama_ayah' => $request->jenis == 'ayah' ? $request->name : null,
                'nama_ibu' => $request->jenis == 'ibu' ? $request->name : null,
                'pekerjaan_ayah' => $request->jenis == 'ayah' ? $request->pekerjaan : null,
                'pekerjaan_ibu'=> $request->jenis == 'ibu' ? $request->pekerjaan : null,
                'no_ayah' => $request->jenis == 'ayah' ? $request->no_telp : null,
                'no_ibu' => $request->jenis == 'ibu' ? $request->no_telp : null,
                'email_ayah' => $request->jenis == 'ayah' ? $request->email : null,
                'email_ibu' => $request->jenis == 'ibu' ? $request->email : null,
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'kecamatan_id' => $request->kecamatan_id,
            ];

            $dataOrangTua = array_filter($dataOrangTua);

            OrangTua::create($dataOrangTua);
            
            event(new Registered($user));
            $requestData = new Request([
                'email' => $request->email,
                'password' => $request->password
            ]);
            $loginResponse = $loginController->loginApi($requestData);
            DB::commit();
            return $loginResponse;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => 'Gagal membuat user'
            ]);
        }

    }
}
