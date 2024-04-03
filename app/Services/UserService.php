<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        $users = $this->repository->getAll();
        return $users;
    }

    public function createData($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email:rfc|unique:users',
            'role' => 'nullable',
            'verified' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            toastr()->error('Perngguna gagal ditambah </br> Periksa kembali data anda');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::transaction(function () use ($request) {
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make('password'),
                    'email_verified_at' => !blank($request->verified) ? now() : null
                ];
                $user = $this->repository->createData($data);
                $this->repository->assignRole($user, $request->role ?? []);
            });
            // return redirect()->route('manage-user.index')->with('success', 'Pengguna baru berhasil disimpan');
        } catch (\Throwable $th) {
            toastr()->error('Terdapat masalah di Server');
            return redirect()->route('manage-user.index');
        }
    }

    public function deleteData($id)
    {
        $user = $this->repository->deleteData($id);
        return $user;
    }
}
