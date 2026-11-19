<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class User extends Authenticatable
{
 use HasFactory;
 protected $table = 'tb_user';
 protected $primaryKey = 'id_user';
 protected $fillable = [
 'nama_lengkap', 'username', 'password', 'role', 'status_aktif',
 ];
 protected $hidden = ['password', 'remember_token'];

 public function kendaraan()
 {
 return $this->hasMany(Kendaraan::class, 'id_user', 'id_user');
 }

 public function transaksi()
 {
 return $this->hasMany(Transaksi::class, 'id_user', 'id_user');
 }
 
 public function logAktivitas()
 {
 return $this->hasMany(LogAktivitas::class, 'id_user', 'id_user');
 }
}
