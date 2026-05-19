@extends('backend.layouts.app')

@section('title', 'Admin - Dashboard')

@push('css')
    <style>
        .stat-card {
            transition: all 0.25s ease;
            border-radius: .75rem;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
        }

        .stat-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(15, 23, 42, 0.03);
        }

        .stat-label {
            font-size: .8rem;
            letter-spacing: .05em;
            text-transform: uppercase;
            color: #6c757d;
            margin-bottom: .25rem;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
        }

        .card-header-borderless {
            border-bottom: 0;
            padding-bottom: 0;
        }
    </style>
@endpush

@section('content')

    <div class="row">
        {{-- Statistik Cards --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Unduhan</div>
                        <p class="stat-value text-info mb-0">{{ number_format($totalDownloads) }}</p>
                        <small class="text-muted">Semua file yang diunduh pengguna.</small>
                    </div>
                    <div class="stat-icon text-info">
                        <i class="fas fa-download fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Galeri</div>
                        <p class="stat-value text-success mb-0">{{ number_format($totalGalleries) }}</p>
                        <small class="text-muted">Jumlah album dan foto yang tersedia.</small>
                    </div>
                    <div class="stat-icon text-success">
                        <i class="fas fa-images fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Berita</div>
                        <p class="stat-value text-primary mb-0">{{ number_format($totalNews) }}</p>
                        <small class="text-muted">Artikel berita yang telah dipublikasikan.</small>
                    </div>
                    <div class="stat-icon text-primary">
                        <i class="fas fa-newspaper fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Pengunjung</div>
                        <p class="stat-value text-warning mb-0">{{ number_format($totalVisitors) }}</p>
                        <small class="text-muted">Pengunjung yang terekam sistem.</small>
                    </div>
                    <div class="stat-icon text-warning">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chart Pengunjung --}}
        <div class="col-12 mt-2">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white card-header-borderless d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Statistik Pengunjung 30 Hari Terakhir</h5>
                        <small class="text-muted">Performa trafik harian website Anda.</small>
                    </div>
                </div>
                <div class="card-body pt-3">
                    <div style="height: 320px;">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('visitorChart').getContext('2d');

            const labels = @json($chartLabels);
            const dataValues = @json($chartData);

            // Gradient background
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(13, 110, 253, 0.25)');
            gradient.addColorStop(1, 'rgba(13, 110, 253, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pengunjung',
                        data: dataValues,
                        borderColor: '#0d6efd',
                        backgroundColor: gradient,
                        borderWidth: 2.5,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#0d6efd',
                        tension: 0.35,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#111827',
                            titleColor: '#f9fafb',
                            bodyColor: '#e5e7eb',
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                title: function(items) {
                                    return 'Tanggal: ' + items[0].label;
                                },
                                label: function(item) {
                                    return 'Pengunjung: ' + item.formattedValue;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9'
                            },
                            ticks: {
                                stepSize: 1,
                                color: '#6b7280'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6b7280'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
