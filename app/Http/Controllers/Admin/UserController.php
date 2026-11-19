<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
 public function index()
 {
 // Gunakan pagination supaya query tetap efisien untuk data besar
 $users = User::latest()->paginate(10);
 return view('admin.user.index', compact('users'));
 }

 public function create()
 {
 return view('admin.user.create');
 }

 public function store(Request $request)
 {
 $request->validate([
 'nama_lengkap' => 'required|string|max:100',
 'username' => 'required|string|unique:tb_user,username',
 'password' => 'required|min:6',
 'role' => 'required|in:admin,petugas,owner',
 ]);

 User::create([
 'nama_lengkap' => $request->nama_lengkap,
 'username' => $request->username,
 'password' => Hash::make($request->password),
 'role' => $request->role,
 'status_aktif' => 1,
 ]);

 return redirect()->route('admin.user.index')->with('success', 'User berhasil
ditambahkan.');
 }

 public function edit(User $user)
 {
 return view('admin.user.edit', compact('user'));
 }

  public function update(Request $request, User $user)
 {
 $request->validate([
 'nama_lengkap' => 'required|string|max:100',
 'username' => 'required|string|unique:tb_user,username,' . $user->id_user . ',id_user',
 'role' => 'required|in:admin,petugas,owner',
 'status_aktif' => 'required|boolean',
 ]);

 $data = $request->only('nama_lengkap', 'username', 'role', 'status_aktif');

 if ($request->filled('password')) {
 $data['password'] = Hash::make($request->password);
 }

 $user->update($data);

 return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
 }
 
 public function destroy(User $user)
 {
 $user->delete();
 return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
 }
}