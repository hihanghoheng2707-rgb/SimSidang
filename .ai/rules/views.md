---
paths:
  - 'resources/views/**/*.blade.php'
---

# Views

## Form tidak boleh bersarang (nested form)
Setiap `<form>` harus ditutup dengan `</form>` sebelum `<form>` berikutnya dibuka di Blade yang sama. Parser HTML mengabaikan tag `<form>` di dalam `<form>` lain — akibatnya semua input bersarang ikut tersubmit ke form luar, bukan form tujuan. Bug ini menimpa plotting mahasiswa di `admin/schedules/edit.blade.php` (fix 2026-09-05).

## Tombol non-submit di dalam form harus type=\"button\"
Setiap <button> di dalam <form> yang berfungsi interaksi (mis. hasil dropdown Alpine searchable-select, tombol close modal) WALIB diberi type=\"button\". Tanpa itu HTML default type=\"submit\" aktif dan mengklik tombol akan submit form (sering dengan field kosong) lalu reload, membuat interaksi tampak \"tidak terjadi\". Bug ini menimpa plotting mahasiswa di admin/schedules (fix 2026-08-17, commit 0c324d6).
