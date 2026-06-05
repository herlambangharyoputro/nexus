@extends('layouts.app')

@section('title', 'Demo')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Demo')

@section('content')

    {{-- ═══════════════════════════════════════════════════════
         Welcome Alert
         ═══════════════════════════════════════════════════════ --}}
    <div class="alert alert-info mb-6">
        <div>
            <strong>Selamat datang di Nexus Admin!</strong> &nbsp;
            Halaman ini menampilkan base bundle Nexus (CSS, JS, layout, partials, icons).
            Coba interaksi: collapse sidebar, klik tombol toast, buka modal,
            atau sort tabel.
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         STAT CARDS GRID (4 columns)
         ═══════════════════════════════════════════════════════ --}}
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon bg-primary-soft text-primary">
                    @include('icons.shopping-bag')
                </div>
                <span class="stat-change up">+12.5%</span>
            </div>
            <div>
                <div class="stat-value">Rp 124.5M</div>
                <div class="stat-label">Total Pendapatan</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon bg-green-soft text-green">
                    @include('icons.users')
                </div>
                <span class="stat-change up">+8.2%</span>
            </div>
            <div>
                <div class="stat-value">2,847</div>
                <div class="stat-label">Pengguna Aktif</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon bg-amber-soft text-amber">
                    @include('icons.package')
                </div>
                <span class="stat-change down">-2.1%</span>
            </div>
            <div>
                <div class="stat-value">1,329</div>
                <div class="stat-label">Total Pesanan</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon bg-purple-soft text-purple">
                    @include('icons.home')
                </div>
                <span class="stat-change up">+0.4%</span>
            </div>
            <div>
                <div class="stat-value">3.24%</div>
                <div class="stat-label">Konversi</div>
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════════════
         CHARTS GRID (2fr 1fr): chart placeholder + activity feed
         ═══════════════════════════════════════════════════════ --}}
    <div class="charts-grid">

        {{-- Chart Card --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Penjualan 30 Hari Terakhir</div>
                <button class="btn btn-ghost btn-sm">Export</button>
            </div>
            <div class="card-body">
                <div class="chart-wrap d-flex items-center justify-center bg-canvas rounded">
                    <div class="text-center text-muted">
                        <div class="text-3xl mb-2">📊</div>
                        <div class="text-sm">Chart placeholder</div>
                        <div class="text-xs mt-1">Hook chart library (Chart.js, ApexCharts) di sini</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Activity Feed --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Aktivitas Terbaru</div>
            </div>
            <div class="card-body">

                <div class="activity-item">
                    <div class="activity-dot bg-green"></div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>Andi P.</strong> melakukan pembayaran Rp 2.4M
                        </div>
                        <div class="activity-time">2 menit lalu</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-dot bg-primary"></div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>Budi S.</strong> mendaftar sebagai pengguna baru
                        </div>
                        <div class="activity-time">12 menit lalu</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-dot bg-amber"></div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>Citra D.</strong> mengirim 3 pesan dukungan
                        </div>
                        <div class="activity-time">28 menit lalu</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-dot bg-red"></div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>Dani K.</strong> membatalkan pesanan #1029
                        </div>
                        <div class="activity-time">1 jam lalu</div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════════════
         DATA TABLE — Daftar Pengguna
         ═══════════════════════════════════════════════════════ --}}
    <div class="card mb-6">

        <div class="card-header">
            <div class="card-title">Daftar Pengguna</div>
            <button class="btn btn-primary btn-sm" data-modal-open="addUserModal">
                + Tambah Pengguna
            </button>
        </div>

        <div class="p-5">
            {{-- Table controls --}}
            <div class="table-controls">
                <div class="search-box">
                    @include('icons.search')
                    <input type="text" placeholder="Cari pengguna...">
                </div>
                <div class="table-actions">
                    <button class="btn btn-outline btn-sm">Filter</button>
                    <button class="btn btn-outline btn-sm">Export</button>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="data-table" data-sort-table>
                    <thead>
                        <tr>
                            <th data-sort="id">ID</th>
                            <th data-sort="nama">Nama</th>
                            <th data-sort="email">Email</th>
                            <th data-sort="role">Role</th>
                            <th data-sort="status">Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $dummyUsers = [
                                ['id'=>'#1001', 'nama'=>'Andi Pratama',   'email'=>'andi@example.com',   'role'=>'Admin',   'status'=>'aktif',     'color'=>'green'],
                                ['id'=>'#1002', 'nama'=>'Budi Santoso',   'email'=>'budi@example.com',   'role'=>'Editor',  'status'=>'aktif',     'color'=>'green'],
                                ['id'=>'#1003', 'nama'=>'Citra Dewi',     'email'=>'citra@example.com',  'role'=>'Viewer',  'status'=>'pending',   'color'=>'amber'],
                                ['id'=>'#1004', 'nama'=>'Dani Kurniawan', 'email'=>'dani@example.com',   'role'=>'Editor',  'status'=>'suspended', 'color'=>'red'],
                                ['id'=>'#1005', 'nama'=>'Eka Putri',      'email'=>'eka@example.com',    'role'=>'Admin',   'status'=>'aktif',     'color'=>'green'],
                            ];

                            // Helper untuk avatar initials
                            $initials = fn($nama) => collect(explode(' ', trim($nama)))
                                ->map(fn($p) => strtoupper(substr($p, 0, 1)))
                                ->take(2)
                                ->implode('');
                        @endphp

                        @foreach ($dummyUsers as $u)
                            <tr>
                                <td><span class="text-muted">{{ $u['id'] }}</span></td>
                                <td>
                                    <div class="d-flex items-center gap-3">
                                        <div class="avatar avatar-sm">{{ $initials($u['nama']) }}</div>
                                        <span class="font-medium">{{ $u['nama'] }}</span>
                                    </div>
                                </td>
                                <td><span class="text-muted">{{ $u['email'] }}</span></td>
                                <td>{{ $u['role'] }}</td>
                                <td>
                                    <span class="badge badge-{{ $u['color'] }}">
                                        {{ ucfirst($u['status']) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-ghost btn-sm">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="pagination">
                <span class="pagination-info">Menampilkan 1–5 dari 24 pengguna</span>
                <div class="pagination-btns">
                    <button class="pg-btn" disabled>‹</button>
                    <button class="pg-btn active">1</button>
                    <button class="pg-btn">2</button>
                    <button class="pg-btn">3</button>
                    <button class="pg-btn">›</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         BOTTOM ROW: Toast Trigger Card + Form Card
         ═══════════════════════════════════════════════════════ --}}
    <div class="d-grid grid-cols-2 gap-4">

        {{-- Toast trigger card --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Demo Toast</div>
            </div>
            <div class="card-body">
                <p class="text-muted text-sm mb-4">
                    Klik tombol untuk munculin notifikasi toast. Toast akan auto-hilang
                    dalam 3.2 detik.
                </p>

                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-success btn-sm"
                            onclick="Toast.show('Data berhasil disimpan!', 'success')">
                        Success Toast
                    </button>
                    <button class="btn btn-danger btn-sm"
                            onclick="Toast.show('Gagal menyimpan data', 'error')">
                        Error Toast
                    </button>
                    <button class="btn btn-outline btn-sm"
                            onclick="Toast.show('Memuat data...', 'info')">
                        Info Toast
                    </button>
                </div>

                <div class="mt-5 pt-4 border-t">
                    <div class="text-sm font-semibold mb-2">Badges</div>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge badge-blue">Default</span>
                        <span class="badge badge-green">Active</span>
                        <span class="badge badge-amber">Pending</span>
                        <span class="badge badge-red">Banned</span>
                        <span class="badge badge-purple">VIP</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form card --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Pengaturan Cepat</div>
            </div>
            <div class="card-body">
                <form onsubmit="event.preventDefault(); Toast.show('Pengaturan disimpan!', 'success');">

                    <div class="form-grid">

                        <div class="form-group full">
                            <label class="form-label" for="demo-name">Nama Tampilan</label>
                            <input id="demo-name" class="form-input" type="text"
                                   value="Andi Pratama" placeholder="Nama Anda">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="demo-email">Email</label>
                            <input id="demo-email" class="form-input" type="email"
                                   value="andi@nexus.com">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="demo-role">Role</label>
                            <select id="demo-role" class="form-select">
                                <option>Admin</option>
                                <option>Editor</option>
                                <option>Viewer</option>
                            </select>
                        </div>

                        <div class="form-group full">
                            <label class="form-label">Notifikasi Email</label>
                            <div class="d-flex items-center gap-3">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="text-sm text-muted">Terima ringkasan harian</span>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-end gap-2 mt-5">
                        <button type="reset" class="btn btn-outline">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════════════
         PROGRESS DEMO CARD (full-width)
         ═══════════════════════════════════════════════════════ --}}
    <div class="card mt-4">
        <div class="card-header">
            <div class="card-title">Progress Project</div>
        </div>
        <div class="card-body">
            <div class="d-flex flex-col gap-4">

                <div>
                    <div class="d-flex justify-between mb-2">
                        <span class="text-sm font-medium">Frontend Integration</span>
                        <span class="text-sm text-muted">85%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill bg-primary" style="width: 85%"></div>
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-between mb-2">
                        <span class="text-sm font-medium">Backend API</span>
                        <span class="text-sm text-muted">60%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill bg-green" style="width: 60%"></div>
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-between mb-2">
                        <span class="text-sm font-medium">Documentation</span>
                        <span class="text-sm text-muted">30%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill bg-amber" style="width: 30%"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         MODAL — Tambah Pengguna
         ═══════════════════════════════════════════════════════ --}}
    <div id="addUserModal" class="modal-overlay">
        <div class="modal">

            <div class="modal-header">
                <div class="modal-title">Tambah Pengguna Baru</div>
                <button class="modal-close" data-modal-close aria-label="Close">&times;</button>
            </div>

            <div class="modal-body">
                <p class="text-muted text-sm mb-4">
                    Isi form di bawah untuk menambah pengguna baru ke sistem.
                </p>

                <div class="form-grid">
                    <div class="form-group full">
                        <label class="form-label" for="new-user-name">Nama Lengkap</label>
                        <input id="new-user-name" class="form-input" type="text"
                               placeholder="contoh: Andi Pratama">
                        <span class="form-hint">Akan ditampilkan di sidebar dan komentar.</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="new-user-email">Email</label>
                        <input id="new-user-email" class="form-input" type="email"
                               placeholder="email@domain.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="new-user-role">Role</label>
                        <select id="new-user-role" class="form-select">
                            <option>Viewer</option>
                            <option>Editor</option>
                            <option>Admin</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-end gap-2 mt-5">
                    <button class="btn btn-outline" data-modal-close>Batal</button>
                    <button class="btn btn-primary" id="saveUserBtn">Simpan</button>
                </div>
            </div>

        </div>
    </div>

@endsection


{{-- ═══════════════════════════════════════════════════════
     PAGE-SPECIFIC SCRIPTS
     ═══════════════════════════════════════════════════════ --}}
@push('scripts')
<script>
    // Handler untuk save user modal
    $(document).on('click', '#saveUserBtn', function () {
        const name = $('#new-user-name').val();
        if (!name) {
            Toast.show('Nama wajib diisi', 'error');
            return;
        }
        Toast.show('Pengguna "' + name + '" berhasil ditambahkan', 'success');
        Modal.close();
        $('#addUserModal input').val('');
    });
</script>
@endpush