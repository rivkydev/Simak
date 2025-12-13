@component('mail::message')
# Reset Kata Sandi - SIMAK

Halo,  
Kami menerima permintaan untuk mengatur ulang kata sandi akun Anda pada **Sistem Manajemen Kelurahan (SIMAK) Kota Parepare**.

Klik tombol di bawah ini untuk melanjutkan proses reset kata sandi Anda:

@component('mail::button', ['url' => $actionUrl])
Atur Ulang Kata Sandi
@endcomponent

Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini. Tautan ini akan kedaluwarsa dalam 60 menit.

Terima kasih telah menggunakan layanan kami.

Salam hangat,  
TIM SIMAK - Kota Parepare

@slot('subcopy')
Jika Anda mengalami masalah saat mengklik tombol "Atur Ulang Kata Sandi", salin dan tempel URL di bawah ini ke browser Anda:

[{{ $actionUrl }}]({{ $actionUrl }})
@endslot
@endcomponent
