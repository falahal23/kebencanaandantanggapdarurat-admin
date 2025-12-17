<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// ← WAJIB

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $dataUser = $query->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.user.index', compact('dataUser'));
    }

    public function create()
    {
        return view('pages.admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:6',
            'role'            => 'required|string',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $data             = $request->only('name', 'email', 'role');
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] =
            $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'User berhasil dibuat');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $id,
            'password'        => 'nullable|min:6',
            'role'            => 'required|string',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'email', 'role');

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $data['profile_picture'] =
            $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }

    public function login()
    {
        // opsional
    }
}
