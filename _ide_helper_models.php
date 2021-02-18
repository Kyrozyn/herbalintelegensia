<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\historistok
 *
 * @property int $id
 * @property string|null $tanggal_waktu
 * @property int $perubahan
 * @property int $jumlah_stok
 * @property int $produk_id
 * @property-read \App\Models\produk $produk
 * @method static \Illuminate\Database\Eloquent\Builder|historistok newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|historistok newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|historistok query()
 * @method static \Illuminate\Database\Eloquent\Builder|historistok whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|historistok whereJumlahStok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|historistok wherePerubahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|historistok whereProdukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|historistok whereTanggalWaktu($value)
 */
	class historistok extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\invoice
 *
 * @property int $id
 * @property int $kendaraan_id
 * @property string $rute
 * @property-read \App\Models\kendaraan $kendaraan
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\pemesanan[] $pemesanans
 * @property-read int|null $pemesanans_count
 * @method static \Illuminate\Database\Eloquent\Builder|invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereKendaraanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereRute($value)
 */
	class invoice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\kendaraan
 *
 * @property int $id
 * @property string $plat_no
 * @property string $nama_kendaraan
 * @property int $kapasitas
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\invoice[] $invoice
 * @property-read int|null $invoice_count
 * @method static \Illuminate\Database\Eloquent\Builder|kendaraan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|kendaraan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|kendaraan query()
 * @method static \Illuminate\Database\Eloquent\Builder|kendaraan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kendaraan whereKapasitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kendaraan whereNamaKendaraan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kendaraan wherePlatNo($value)
 */
	class kendaraan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\pelanggan
 *
 * @property int $id
 * @property string $nama_pelanggan
 * @property string $alamat
 * @property string $lat
 * @property string $long
 * @property string $no_telp
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\pemesanan[] $pemesanan
 * @property-read int|null $pemesanan_count
 * @method static \Illuminate\Database\Eloquent\Builder|pelanggan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|pelanggan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|pelanggan query()
 * @method static \Illuminate\Database\Eloquent\Builder|pelanggan whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pelanggan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pelanggan whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pelanggan whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pelanggan whereNamaPelanggan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pelanggan whereNoTelp($value)
 */
	class pelanggan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\pemesanan
 *
 * @property int $id
 * @property int $produk_id
 * @property int $pelanggan_id
 * @property string $tanggal_pemesanan
 * @property string $keterangan
 * @property int $jumlah
 * @property string $status
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\invoice[] $invoice
 * @property-read int|null $invoice_count
 * @property-read \App\Models\pelanggan $pelanggan
 * @property-read \App\Models\produk $produk
 * @method static \Illuminate\Database\Eloquent\Builder|pemesanan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|pemesanan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|pemesanan query()
 * @method static \Illuminate\Database\Eloquent\Builder|pemesanan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pemesanan whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pemesanan whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pemesanan wherePelangganId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pemesanan whereProdukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pemesanan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pemesanan whereTanggalPemesanan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|pemesanan whereUserId($value)
 */
	class pemesanan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\produk
 *
 * @property int $id
 * @property string $nama
 * @property string $deskripsi
 * @property int $harga
 * @property int $jumlah_stok
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\historistok[] $historistok
 * @property-read int|null $historistok_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\pemesanan[] $pemesanan
 * @property-read int|null $pemesanan_count
 * @method static \Illuminate\Database\Eloquent\Builder|produk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|produk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|produk query()
 * @method static \Illuminate\Database\Eloquent\Builder|produk whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|produk whereHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|produk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|produk whereJumlahStok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|produk whereNama($value)
 */
	class produk extends \Eloquent {}
}

