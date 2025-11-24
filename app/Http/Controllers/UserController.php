<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // 🔍 Search by name atau email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 🗂 Filter berdasarkan role (opsional, misal ada kolom role)
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $dataUser = $query->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString(); // biar query search tetap terbawa saat pagination

        return view('pages.admin.user.index', compact('dataUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:3',
            // Memastikan email unik di tabel users
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Redirek dan sukses
            return redirect()->route('user.index')->with('success', '✅ User berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Error
            return redirect()->back()->withInput()->with('error', '❌ Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|min:3',
            // Unique email, kecuali untuk user dengan ID saat ini
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);

        try {
            $data = [
                'name'  => $request->name,
                'email' => $request->email,
            ];

            // Jika password diisi, update password
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);
            // Menambahkan pesan sukses yang hilang
            return redirect()->route('user.index')->with('success', '✅ Data User berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', '❌ Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            User::findOrFail($id)->delete();
            return redirect()->route('user.index')->with('success', '✅ User berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', '❌ Gagal menghapus user: ' . $e->getMessage());
        }
    }

    public function login()
    {
        // Logika login, jika ada
    }
}
