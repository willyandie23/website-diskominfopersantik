<!-- resources/views/backend/logs/index.blade.php -->

@extends('backend.layouts.app')
@section('title', 'Log Aktivitas')

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Filter Card -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Modul</label>
                            <select id="filter-module" class="form-select">
                                <option value="">Semua Modul</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Aksi</label>
                            <select id="filter-action" class="form-select">
                                <option value="">Semua Aksi</option>
                                <option value="create">Create</option>
                                <option value="update">Update</option>
                                <option value="delete">Delete</option>
                                <option value="login">Login</option>
                                <option value="logout">Logout</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Dari Tanggal</label>
                            <input type="date" id="filter-date-from" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Sampai Tanggal</label>
                            <input type="date" id="filter-date-to" class="form-control">
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button id="btn-filter" class="btn btn-primary">
                                <i class="ti ti-filter"></i> Filter
                            </button>
                            <button id="btn-reset" class="btn btn-outline-secondary">
                                <i class="ti ti-refresh"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">
                        <i class="ti ti-history text-primary me-2"></i>Log Aktivitas Sistem
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-logs" class="table table-striped table-hover align-middle" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Waktu</th>
                                    <th>User</th>
                                    <th>Modul</th>
                                    <th>Aksi</th>
                                    <th>IP Address</th>
                                    <th width="8%" class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title"><i class="ti ti-info-circle me-2"></i>Detail Log</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modal-detail-body">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table;

            function loadData() {
                var params = {
                    module_name: $('#filter-module').val(),
                    action: $('#filter-action').val(),
                    date_from: $('#filter-date-from').val(),
                    date_to: $('#filter-date-to').val()
                };

                $.ajax({
                    url: "{{ route('app-log.index') }}",
                    type: 'GET',
                    data: params,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        if (table) {
                            table.destroy();
                        }

                        $('#table-logs tbody').empty();

                        var rows = '';
                        $.each(response.data, function(index, item) {
                            var actionColor = getActionColor(item.action);
                            rows += `<tr>
                        <td>${index + 1}</td>
                        <td>${item.created_at}</td>
                        <td>${item.user_name}</td>
                        <td><span class="badge bg-info-subtle text-info">${item.module_name}</span></td>
                        <td><span class="badge bg-${actionColor}-subtle text-${actionColor}">${item.action}</span></td>
                        <td><code>${item.ip_address}</code></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary btn-detail" data-id="${item.id}">
                                <i class="ti ti-eye"></i>
                            </button>
                        </td>
                    </tr>`;
                        });

                        $('#table-logs tbody').html(rows);

                        table = $('#table-logs').DataTable({
                            paging: true,
                            searching: true,
                            ordering: true,
                            order: [
                                [1, 'desc']
                            ],
                            pageLength: 25,
                            language: {
                                emptyTable: 'Tidak ada data log.',
                                search: 'Cari:',
                                lengthMenu: 'Tampilkan _MENU_ data',
                                info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                                paginate: {
                                    previous: '‹',
                                    next: '›'
                                }
                            }
                        });

                        // Populate module filter (first load only)
                        if ($('#filter-module option').length <= 1) {
                            var modules = [...new Set(response.data.map(item => item.module_name))];
                            modules.sort().forEach(function(mod) {
                                $('#filter-module').append(
                                    `<option value="${mod}">${mod}</option>`);
                            });
                        }
                    }
                });
            }

            // Initial load
            loadData();

            // Filter
            $('#btn-filter').on('click', function() {
                loadData();
            });

            // Reset
            $('#btn-reset').on('click', function() {
                $('#filter-module').val('');
                $('#filter-action').val('');
                $('#filter-date-from').val('');
                $('#filter-date-to').val('');
                loadData();
            });

            // Detail Modal
            $(document).on('click', '.btn-detail', function() {
                var id = $(this).data('id');
                var modal = new bootstrap.Modal(document.getElementById('modalDetail'));
                $('#modal-detail-body').html(
                    '<div class="text-center py-4"><div class="spinner-border text-primary"></div></div>'
                );
                modal.show();

                $.ajax({
                    url: "{{ url('admin/app-log') }}/" + id,
                    type: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        var html = `
                    <table class="table table-bordered mb-0">
                        <tr><th width="30%">Waktu</th><td>${response.created_at}</td></tr>
                        <tr><th>User</th><td>${response.user_name}</td></tr>
                        <tr><th>Guard</th><td>${response.guard_name || '-'}</td></tr>
                        <tr><th>Modul</th><td><span class="badge bg-info">${response.module_name}</span></td></tr>
                        <tr><th>Aksi</th><td><span class="badge bg-${getActionColor(response.action)}">${response.action}</span></td></tr>
                        <tr><th>IP Address</th><td><code>${response.ip_address}</code></td></tr>
                        <tr><th>Nilai Lama</th><td><pre class="mb-0 bg-light p-2 rounded" style="max-height:200px;overflow:auto;font-size:12px;">${formatJson(response.old_value)}</pre></td></tr>
                        <tr><th>Nilai Baru</th><td><pre class="mb-0 bg-light p-2 rounded" style="max-height:200px;overflow:auto;font-size:12px;">${formatJson(response.new_value)}</pre></td></tr>
                    </table>
                `;
                        $('#modal-detail-body').html(html);
                    }
                });
            });

            function getActionColor(action) {
                var colors = {
                    'create': 'success',
                    'update': 'warning',
                    'delete': 'danger',
                    'login': 'primary',
                    'logout': 'secondary'
                };
                return colors[action] || 'info';
            }

            function formatJson(value) {
                if (!value) return '<span class="text-muted">-</span>';
                try {
                    return JSON.stringify(JSON.parse(value), null, 2);
                } catch (e) {
                    return value;
                }
            }
        });
    </script>
@endpush
