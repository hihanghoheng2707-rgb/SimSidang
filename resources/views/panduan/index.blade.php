@extends('layouts.app')

@section('title', 'Panduan Penggunaan — SISIDANG')

@section('content')
<div x-data="{ activeTab: '{{ auth()->user()->role }}' }">
    <div class="mb-6">
        <h1 class="text-xl font-bold text-gray-800 dark:text-white/90 sm:text-2xl">Panduan Penggunaan SISIDANG</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Langkah-langkah penggunaan sistem sesuai peran Anda.</p>
    </div>

    {{-- Tabs --}}
    <div class="mb-6 border-b border-gray-200 dark:border-gray-800">
        <nav class="flex gap-2 -mb-px" aria-label="Tab panduan">
            <button @click="activeTab = 'mahasiswa'"
                    class="px-4 py-2.5 text-sm font-medium border-b-2 transition whitespace-nowrap"
                    :class="activeTab === 'mahasiswa' ? 'border-brand-500 text-brand-600 dark:text-brand-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'">
                Mahasiswa
            </button>
            <button @click="activeTab = 'dosen'"
                    class="px-4 py-2.5 text-sm font-medium border-b-2 transition whitespace-nowrap"
                    :class="activeTab === 'dosen' ? 'border-brand-500 text-brand-600 dark:text-brand-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'">
                Dosen
            </button>
            <button @click="activeTab = 'admin'"
                    class="px-4 py-2.5 text-sm font-medium border-b-2 transition whitespace-nowrap"
                    :class="activeTab === 'admin' ? 'border-brand-500 text-brand-600 dark:text-brand-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'">
                Admin
            </button>
        </nav>
    </div>

    {{-- Tab: Mahasiswa --}}
    <div x-show="activeTab === 'mahasiswa'" x-cloak>
        <div class="space-y-6">

            {{-- Step 1 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">1</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Login ke Sistem</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Buka halaman login dan masukkan <strong>NIM</strong> Anda sebagai username. Password diberikan oleh admin/sekretariat.</p>
                        <div class="mt-3 rounded-lg bg-gray-50 p-3 text-xs text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                            <strong>Contoh:</strong> Buka <code class="rounded bg-gray-200 px-1.5 py-0.5 dark:bg-gray-700">/login</code>, isi NIM <code class="rounded bg-gray-200 px-1.5 py-0.5 dark:bg-gray-700">2021001</code>, lalu klik <strong>Masuk</strong>.
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">2</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Unggah Laporan</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Klik menu <strong>Transaksi → Unggah Laporan</strong> di sidebar.</li>
                            <li>Isi judul laporan pada kolom yang tersedia.</li>
                            <li>Pilih file PDF laporan (maksimal <strong>10 MB</strong>).</li>
                            <li>Klik <strong>Unggah</strong> dan tunggu hingga proses selesai.</li>
                        </ol>
                        <div class="mt-3 rounded-lg bg-blue-50 p-3 text-xs text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                            <strong>Catatan:</strong> Hanya file PDF yang diterima. Pastikan file tidak terkunci/broken sebelum diunggah.
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">3</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Lihat Status Laporan</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Klik menu <strong>Transaksi → Laporan Saya</strong> di sidebar.</li>
                            <li>Daftar semua laporan Anda akan muncul beserta statusnya.</li>
                        </ol>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400">pending</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">= Belum sidang</span>
                            <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-500/15 dark:text-blue-400">sidang_berjalan</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">= Sedang sidang</span>
                            <span class="inline-flex items-center gap-1 rounded-full bg-orange-100 px-2.5 py-0.5 text-xs font-medium text-orange-700 dark:bg-orange-500/15 dark:text-orange-400">revisi</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">= Ada catatan revisi</span>
                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700 dark:bg-green-500/15 dark:text-green-400">selesai</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">= Semua resolved</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 4 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">4</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Balas Catatan Revisi</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Setelah sidang, dosen akan memberikan catatan revisi per poin. Anda perlu menanggapi setiap poin:</p>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Buka detail laporan dari menu <strong>Laporan Saya</strong>.</li>
                            <li>Lihat daftar catatan revisi dari dosen (berwarna oranye = open, hijau = resolved).</li>
                            <li>Pada setiap poin, tulis keterangan perbaikan di kolom <strong>Keterangan Mahasiswa</strong>.</li>
                            <li>Opsional: lampirkan bukti perbaikan (PDF, DOCX, JPEG, PNG; maks <strong>5 MB</strong> per file).</li>
                            <li>Klik <strong>Kirim</strong> untuk mengirimkan balasan.</li>
                            <li>Dosen akan menandai poin sebagai <strong>resolved</strong> jika perbaikan sudah sesuai.</li>
                        </ol>
                        <div class="mt-3 rounded-lg bg-green-50 p-3 text-xs text-green-600 dark:bg-green-500/10 dark:text-green-400">
                            <strong>Tips:</strong> Jika ada beberapa poin revisi, balas satu per satu. Anda juga bisa mengupload lampiran baru jika dosen meminta perbaikan ulang.
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 5 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">5</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Lihat Hasil Penilaian</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Jika dosen sudah mengisi penilaian, menu <strong>Penilaian</strong> akan muncul di sidebar.</li>
                            <li>Klik untuk melihat ringkasan skor dari dosen pembimbing dan dosen penguji.</li>
                            <li>Anda bisa mencetak lembar penilaian dalam format PDF.</li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Tab: Dosen --}}
    <div x-show="activeTab === 'dosen'" x-cloak>
        <div class="space-y-6">

            {{-- Step 1 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">1</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Login ke Sistem</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Buka halaman login dan masukkan <strong>NIDN</strong> Anda sebagai username.</p>
                    </div>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">2</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Lihat Jadwal Sidang</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Setelah login, Anda langsung diarahkan ke daftar submission yang terjadwal untuk hari ini di ruang sidang yang sesuai.</p>
                        <div class="mt-3 rounded-lg bg-gray-50 p-3 text-xs text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                            <strong>Catatan:</strong> Hanya submission pada jadwal yang Anda ditugaskan yang akan muncul. Klik kolom tertentu untuk melihat detail.
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">3</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Baca Laporan Mahasiswa</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Buka detail submission dari daftar jadwal.</li>
                            <li>Klik tombol <strong>Unduh PDF</strong> untuk mengunduh file laporan mahasiswa.</li>
                            <li><strong>Atau</strong> klik tombol <strong>Baca dengan AI</strong> untuk mendapatkan ringkasan otomatis dari dokumen.</li>
                        </ol>
                        <div class="mt-3 rounded-lg bg-purple-50 p-3 text-xs text-purple-600 dark:bg-purple-500/10 dark:text-purple-400">
                            <strong>Fitur AI:</strong> Sistem akan menganalisis PDF dan menghasilkan ringkasan Bab 1, 3, 4, 5 beserta rekomendasi revisi. Hasil di-cache selama 24 jam. Klik <strong>Refresh Analisa</strong> untuk analisa ulang.
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 4 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">4</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Buat Catatan Revisi</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Pada detail submission, klik tombol <strong>Buat Catatan Revisi</strong>.</li>
                            <li>Tulis satu per satu poin revisi. Setiap poin berisi catatan perbaikan yang spesifik.</li>
                            <li>Anda bisa <strong>Simpan Draft</strong> terlebih dahulu jika belum selesai menulis semua poin.</li>
                            <li>Klik <strong>Simpan</strong> untuk mengirimkan catatan revisi ke mahasiswa.</li>
                        </ol>
                        <div class="mt-3 rounded-lg bg-yellow-50 p-3 text-xs text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400">
                            <strong>Tip:</strong> Buat poin revisi yang spesifik dan terukur. Misalnya: "Perbaiki penulisan rumus di Bab 3.2" lebih baik daripada "Perbaiki Bab 3".
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 5 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">5</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Tandai Poin Selesai (Resolve)</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Setelah mahasiswa membalas, buka kembali detail submission.</li>
                            <li>Lihat balasan mahasiswa (keterangan + lampiran).</li>
                            <li>Jika perbaikan sudah sesuai, klik tombol <strong>Resolve</strong> pada poin tersebut.</li>
                            <li>Poin yang sudah resolved akan berubah warna hijau.</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Step 6 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">6</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Isi Form Penilaian</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Klik menu <strong>Penilaian</strong> di sidebar, lalu pilih submission yang akan dinilai.</li>
                            <li>Pilih peran Anda: <strong>Dosen Pembimbing</strong> atau <strong>Dosen Penguji</strong>.</li>
                            <li>Isi skor untuk setiap item penilaian sesuai template yang berlaku.</li>
                            <li>Skor total akan dihitung otomatis: <code class="rounded bg-gray-200 px-1 py-0.5 dark:bg-gray-700">Σskor / A × B</code>.</li>
                            <li>Klik <strong>Simpan</strong> untuk menyelesaikan penilaian.</li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Tab: Admin --}}
    <div x-show="activeTab === 'admin'" x-cloak>
        <div class="space-y-6">

            {{-- Step 1 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">1</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Login ke Sistem</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Masukkan username admin yang telah didaftarkan.</p>
                    </div>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">2</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Kelola Master Data</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Akses menu <strong>Master Data</strong> di sidebar untuk mengelola:</p>
                        <div class="mt-3 grid gap-3 sm:grid-cols-2">
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-800 dark:bg-gray-800">
                                <div class="text-sm font-medium text-gray-800 dark:text-white/90">Pengguna</div>
                                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tambah/edit/hapus akun mahasiswa, dosen, admin. Set NIM/NIDN, prodi, dan role.</div>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-800 dark:bg-gray-800">
                                <div class="text-sm font-medium text-gray-800 dark:text-white/90">Fakultas</div>
                                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">Kelola data fakultas (nama, kode).</div>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-800 dark:bg-gray-800">
                                <div class="text-sm font-medium text-gray-800 dark:text-white/90">Program Studi</div>
                                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">Kelola prodi, hubungkan ke fakultas.</div>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-800 dark:bg-gray-800">
                                <div class="text-sm font-medium text-gray-800 dark:text-white/90">Jenis Sidang</div>
                                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tipe sidang: TA, KP, Milestone Design, dll.</div>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-800 dark:bg-gray-800 sm:col-span-2">
                                <div class="text-sm font-medium text-gray-800 dark:text-white/90">Template Penilaian</div>
                                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">Atur item penilaian per prodi × jenis sidang. Tentukan nilai penyebut (A), nilai pengali (B), dan daftar item penilaian.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">3</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Kelola Jadwal Sidang</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Buka menu <strong>Transaksi → Jadwal</strong>.</li>
                            <li>Klik <strong>Tambah Jadwal</strong> untuk membuat jadwal baru (isi tanggal, jam, ruangan, jenis sidang, dosen).</li>
                            <li><strong>Atau</strong> klik <strong>Impor dari Excel</strong> untuk impor jadwal secara massal.</li>
                            <li>Download template Excel terlebih dahulu, isi data, lalu unggah.</li>
                        </ol>
                        <div class="mt-3 rounded-lg bg-red-50 p-3 text-xs text-red-600 dark:bg-red-500/10 dark:text-red-400">
                            <strong>Peringatan:</strong> Sistem akan otomatis mendeteksi konflik jadwal. Jika seorang dosen sudah terjadwal di waktu yang sama, jadwal baru akan ditolak.
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 4 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">4</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Plot Mahasiswa ke Jadwal</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Buka detail jadwal yang sudah dibuat.</li>
                            <li>Klik <strong>Plot Mahasiswa</strong> atau cari NIM di kolom pencarian.</li>
                            <li>Pilih mahasiswa yang akan diplot ke jadwal tersebut.</li>
                            <li>Sistem akan memastikan mahasiswa tidak bentrok dengan jadwal lain.</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Step 5 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">5</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Pantau Submission & Kelola Pembimbing</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Buka menu <strong>Transaksi → Submission</strong> untuk melihat semua submission mahasiswa.</li>
                            <li>Klik detail submission untuk melihat informasi lengkap.</li>
                            <li>Tambahkan atau ubah <strong>Dosen Pembimbing</strong> pada submission yang dipilih.</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Step 6 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">6</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Export Rekap & Cetak Penilaian</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Buka menu <strong>Reporting</strong> di sidebar.</li>
                            <li><strong>Rekap</strong>: Lihat ringkasan status semua submission. Export ke Excel atau PDF.</li>
                            <li><strong>Rekap Nilai</strong>: Lihat rekap penilaian per submission. Export ke Excel.</li>
                            <li><strong>Cetak Penilaian</strong>: Cetak lembar penilaian dalam format PDF (dengan QR tanda tangan elektronik).</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Step 7 --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-start gap-4">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">7</div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Gunakan Asisten Virtual</h3>
                        <ol class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-400 list-decimal list-inside">
                            <li>Buka menu <strong>Asisten</strong> di sidebar.</li>
                            <li>Klik <strong>Chat Baru</strong> untuk memulai percakapan.</li>
                            <li>Tanyakan tentang progres mahasiswa, beban dosen, revisi terjebak, atau ringkasan jadwal.</li>
                            <li>Asisten akan menjawab berdasarkan data agregat sistem (read-only).</li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
