<?php
namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function login()
    {
        // Jika sudah login, arahkan ke dashboard
        if (session()->has('user_id')) {
            return redirect()->to('/');
        }
        return view('auth/login');
    }

    public function doLogin()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari pengguna berdasarkan email
        $user = $model->where('email', $email)->first();

        // Validasi email dan password
        if ($user && password_verify($password, $user['password'])) {
            // Simpan data pengguna di sesi
            session()->set([
                'user_id' => $user['user_id'],
                'name' => $user['name'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/')->with('success', 'Login berhasil!');
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->with('error', 'Email atau password salah.');
    }

    public function register()
    {
        // Jika sudah login, arahkan ke dashboard
        if (session()->has('user_id')) {
            return redirect()->to('/');
        }
        return view('auth/register');
    }

    public function doRegister()
    {
        $model = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT)
        ];

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]'
        ]);

        if (!$validation->run($data)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan pengguna
        $model->insert($data);
        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logout berhasil.');
    }
}