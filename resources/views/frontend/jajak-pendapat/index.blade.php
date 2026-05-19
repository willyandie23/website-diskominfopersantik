{{-- resources/views/frontend/jajak-pendapat/index.blade.php --}}
@extends('frontend.layouts.app')
@section('title', 'Jajak Pendapat - DISKOMINFOSANTIK')
@push('css')
    <style>
        /* Hero Heading */
        .polling-hero {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%);
            padding: 80px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .polling-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .polling-hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        .polling-hero .section-heading {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .polling-hero .section-heading h2 {
            font-size: 2.4rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 14px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        .polling-hero .section-heading p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.05rem;
            max-width: 620px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .polling-hero .heading-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 30px;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Polling Content */
        .polling-section {
            padding: 60px 0 80px;
            background: #f8fafc;
        }

        .polling-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e5e7eb;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .polling-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .polling-question {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
            line-height: 1.6;
            padding-bottom: 1rem;
            border-bottom: 2px dashed #e5e7eb;
        }

        .vote-options {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .vote-option {
            flex: 1;
            min-width: 140px;
        }

        .vote-option input[type="radio"] {
            display: none;
        }

        .vote-option label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
            font-weight: 600;
            color: #374151;
            text-align: center;
        }

        .vote-option input[type="radio"]:checked+label {
            border-color: var(--primary);
            background: rgba(37, 99, 235, 0.05);
            color: var(--primary);
        }

        .vote-option label:hover {
            border-color: #93c5fd;
            background: #eff6ff;
        }

        .vote-option .vote-icon {
            font-size: 1.3rem;
        }

        .btn-vote {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 32px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 3px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-vote:hover {
            background: linear-gradient(135deg, #1e3a8a, #1d4ed8);
            transform: translateY(-1px);
            color: #fff;
        }

        .btn-vote:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Two-column layout */
        .polling-row {
            display: flex;
            gap: 2rem;
            align-items: stretch;
        }

        .polling-left {
            flex: 1;
            min-width: 0;
        }

        .polling-right {
            flex: 0 0 320px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1.5rem;
            background: #f9fafb;
            border-radius: 12px;
            border: 1px solid #f3f4f6;
        }

        /* Chart */
        .chart-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .chart-canvas-wrapper {
            width: 180px;
            height: 180px;
            margin: 0 auto 1rem;
        }

        .chart-legend {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.82rem;
            color: #374151;
        }

        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 3px;
            flex-shrink: 0;
        }

        .legend-value {
            font-weight: 700;
            margin-left: auto;
            padding-left: 12px;
        }

        .total-votes {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 1rem;
        }

        /* Alert */
        .alert-vote {
            border-radius: 12px;
            padding: 14px 20px;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .alert-success-vote {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .alert-error-vote {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .empty-state h5 {
            color: #6b7280;
            font-weight: 600;
        }

        .empty-state p {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .polling-hero {
                padding: 60px 0 40px;
            }

            .polling-hero .section-heading h2 {
                font-size: 1.8rem;
            }

            .polling-section {
                padding: 40px 0 60px;
            }

            .polling-row {
                flex-direction: column;
            }

            .polling-right {
                flex: none;
                width: 100%;
                margin-top: 1.5rem;
            }

            .vote-options {
                flex-direction: column;
            }
        }
    </style>
@endpush
@section('content')
    <!-- Hero Heading -->
    <section class="polling-hero">
        <div class="container">
            <div class="section-heading" data-aos="fade-up">
                <span class="heading-badge"><i class="fas fa-poll"></i> Suara Anda Berarti</span>
                <h2>Jajak Pendapat</h2>
                <p>Berikan penilaian Anda terhadap kinerja kami. Setiap suara Anda sangat berharga untuk peningkatan
                    layanan.</p>
            </div>
        </div>
    </section>

    <!-- Polling Content -->
    <section class="polling-section">
        <div class="container">
            <!-- Alerts -->
            @if (session('success'))
                <div class="alert-vote alert-success-vote" data-aos="fade-up">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert-vote alert-error-vote" data-aos="fade-up">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @if ($pertanyaans->count() > 0)
                @foreach ($pertanyaans as $index => $item)
                    <div class="polling-card" id="pertanyaan-{{ $item->id }}" data-aos="fade-up"
                        data-aos-delay="{{ $index * 100 }}">
                        <div class="polling-row">
                            <!-- Kiri: Pertanyaan & Vote -->
                            <div class="polling-left">
                                <div class="total-votes">
                                    <i class="fas fa-users"></i> {{ $item->votes_count }} suara
                                </div>
                                <div class="polling-question">{!! $item->pertanyaan !!}</div>
                                <form action="{{ route('frontend.jajak-pendapat.store') }}" method="POST"
                                    class="vote-form">
                                    @csrf
                                    <input type="hidden" name="pertanyaan_id" value="{{ $item->id }}">
                                    <div class="vote-options">
                                        <div class="vote-option">
                                            <input type="radio" name="nilai_vote" value="1"
                                                id="vote-{{ $item->id }}-1" required>
                                            <label for="vote-{{ $item->id }}-1">
                                                <span class="vote-icon">😐</span> Biasa Saja
                                            </label>
                                        </div>
                                        <div class="vote-option">
                                            <input type="radio" name="nilai_vote" value="2"
                                                id="vote-{{ $item->id }}-2">
                                            <label for="vote-{{ $item->id }}-2">
                                                <span class="vote-icon">👍</span> Bagus
                                            </label>
                                        </div>
                                        <div class="vote-option">
                                            <input type="radio" name="nilai_vote" value="3"
                                                id="vote-{{ $item->id }}-3">
                                            <label for="vote-{{ $item->id }}-3">
                                                <span class="vote-icon">🌟</span> Sangat Bagus
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-vote">
                                        <i class="fas fa-paper-plane me-1"></i> Kirim Vote
                                    </button>
                                </form>
                            </div>

                            <!-- Kanan: Chart Hasil -->
                            @if ($item->votes_count > 0)
                                <div class="polling-right">
                                    <div class="chart-title"><i class="fas fa-chart-pie me-1"></i> Hasil Polling</div>
                                    <div class="chart-canvas-wrapper">
                                        <canvas id="chart-{{ $item->id }}"></canvas>
                                    </div>
                                    <div class="chart-legend">
                                        <div class="legend-item">
                                            <span class="legend-dot" style="background:#facc15;"></span>
                                            <span>Biasa Saja</span>
                                            <span class="legend-value">{{ $item->votes_biasa_count }}
                                                ({{ $item->votes_count > 0 ? round(($item->votes_biasa_count / $item->votes_count) * 100) : 0 }}%)
                                            </span>
                                        </div>
                                        <div class="legend-item">
                                            <span class="legend-dot" style="background:#34d399;"></span>
                                            <span>Bagus</span>
                                            <span class="legend-value">{{ $item->votes_bagus_count }}
                                                ({{ $item->votes_count > 0 ? round(($item->votes_bagus_count / $item->votes_count) * 100) : 0 }}%)</span>
                                        </div>
                                        <div class="legend-item">
                                            <span class="legend-dot" style="background:#4f46e5;"></span>
                                            <span>Sangat Bagus</span>
                                            <span class="legend-value">{{ $item->votes_sangat_bagus_count }}
                                                ({{ $item->votes_count > 0 ? round(($item->votes_sangat_bagus_count / $item->votes_count) * 100) : 0 }}%)</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state" data-aos="fade-up">
                    <i class="fas fa-poll"></i>
                    <h5>Belum ada pertanyaan polling</h5>
                    <p>Saat ini belum ada pertanyaan yang tersedia. Silakan kunjungi kembali nanti.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        @foreach ($pertanyaans as $item)
            @if ($item->votes_count > 0)
                (function() {
                    const ctx = document.getElementById('chart-{{ $item->id }}').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Biasa Saja', 'Bagus', 'Sangat Bagus'],
                            datasets: [{
                                data: [{{ $item->votes_biasa_count }}, {{ $item->votes_bagus_count }},
                                    {{ $item->votes_sangat_bagus_count }}
                                ],
                                backgroundColor: ['#facc15', '#34d399', '#4f46e5'],
                                borderColor: ['#fbbf24', '#10b981', '#4338ca'],
                                borderWidth: 2,
                                hoverOffset: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: '#1f2937',
                                    cornerRadius: 8,
                                    padding: 10,
                                    titleFont: {
                                        size: 13,
                                        weight: '600'
                                    },
                                    bodyFont: {
                                        size: 12
                                    },
                                    callbacks: {
                                        label: function(context) {
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = Math.round((context.parsed / total) * 100);
                                            return ` ${context.label}: ${context.parsed} suara (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                })();
            @endif
        @endforeach

        document.querySelectorAll('.vote-form').forEach(form => {
            form.addEventListener('submit', function() {
                const btn = this.querySelector('.btn-vote');
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mengirim...';
                btn.disabled = true;
            });
        });
    </script>
@endpush
