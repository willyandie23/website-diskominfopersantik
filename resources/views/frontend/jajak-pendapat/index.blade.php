{{-- resources/views/frontend/jajak-pendapat/index.blade.php --}}
@extends('frontend.layouts.app')
@section('title', 'Jajak Pendapat - DISKOMINFOPERSANTIK')

@push('css')
<style>
    .polling-section {
        padding: 80px 0;
        background: #f8fafc;
    }
    .section-heading {
        text-align: center;
        margin-bottom: 50px;
    }
    .section-heading h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 10px;
    }
    .section-heading p {
        color: #6b7280;
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .polling-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid #e5e7eb;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .polling-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }
    .polling-question {
        font-size: 1.05rem;
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
    .vote-option input[type="radio"] { display: none; }
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
    .vote-option input[type="radio"]:checked + label {
        border-color: var(--primary);
        background: rgba(79, 70, 229, 0.05);
        color: var(--primary);
    }
    .vote-option label:hover {
        border-color: #a5b4fc;
        background: #f5f3ff;
    }
    .vote-option .vote-icon { font-size: 1.3rem; }
    .btn-vote {
        background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 12px 32px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 3px 12px rgba(79, 70, 229, 0.3);
    }
    .btn-vote:hover {
        background: linear-gradient(135deg, #4338ca, #1d4ed8);
        transform: translateY(-1px);
        color: #fff;
    }
    .btn-vote:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    /* Chart section */
    .chart-wrapper {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f3f4f6;
    }
    .chart-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }
    .chart-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
    }
    .chart-canvas-wrapper {
        width: 200px;
        height: 200px;
    }
    .chart-legend {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.88rem;
        color: #374151;
    }
    .legend-dot {
        width: 14px;
        height: 14px;
        border-radius: 4px;
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
    .alert-success-vote { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
    .alert-error-vote { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-state i { font-size: 3rem; color: #d1d5db; margin-bottom: 1rem; }
    .empty-state h5 { color: #6b7280; font-weight: 600; }
    .empty-state p { color: #9ca3af; font-size: 0.9rem; }

    @media (max-width: 768px) {
        .polling-section { padding: 50px 0; }
        .vote-options { flex-direction: column; }
        .chart-container { flex-direction: column; align-items: center; }
        .chart-canvas-wrapper { width: 180px; height: 180px; }
    }
</style>
@endpush

@section('content')
<!-- Banner / Page Title -->
{{-- <div class="dz-bnr-inr dz-bnr-inr-sm text-center" style="background: linear-gradient(135deg, #4f46e5 0%, #2563eb 50%, #0ea5e9 100%); min-height: 120px;">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <h1 class="text-white">Jajak Pendapat</h1>
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Jajak Pendapat</li>
                </ul>
            </nav>
        </div>
    </div>
</div> --}}

<!-- Polling Section -->
<section class="polling-section">
    <div class="container">
        <div class="section-heading" data-aos="fade-up">
            <h2>Jajak Pendapat</h2>
            <p>Berikan penilaian Anda terhadap kinerja kami. Setiap suara Anda sangat berharga untuk peningkatan layanan.</p>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert-vote alert-success-vote" data-aos="fade-up">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert-vote alert-error-vote" data-aos="fade-up">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @if($pertanyaans->count() > 0)
            @foreach($pertanyaans as $index => $item)
                <div class="polling-card" id="pertanyaan-{{ $item->id }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <!-- Total Votes Badge -->
                    <div class="total-votes">
                        <i class="fas fa-users"></i> {{ $item->votes_count }} suara
                    </div>

                    <!-- Pertanyaan -->
                    <div class="polling-question">{!! $item->pertanyaan !!}</div>

                    <!-- Form Vote -->
                    <form action="{{ route('frontend.jajak-pendapat.store') }}" method="POST" class="vote-form">
                        @csrf
                        <input type="hidden" name="pertanyaan_id" value="{{ $item->id }}">

                        <div class="vote-options">
                            <div class="vote-option">
                                <input type="radio" name="nilai_vote" value="1" id="vote-{{ $item->id }}-1" required>
                                <label for="vote-{{ $item->id }}-1">
                                    <span class="vote-icon">😐</span> Biasa Saja
                                </label>
                            </div>
                            <div class="vote-option">
                                <input type="radio" name="nilai_vote" value="2" id="vote-{{ $item->id }}-2">
                                <label for="vote-{{ $item->id }}-2">
                                    <span class="vote-icon">👍</span> Bagus
                                </label>
                            </div>
                            <div class="vote-option">
                                <input type="radio" name="nilai_vote" value="3" id="vote-{{ $item->id }}-3">
                                <label for="vote-{{ $item->id }}-3">
                                    <span class="vote-icon">🌟</span> Sangat Bagus
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn-vote">
                            <i class="fas fa-paper-plane me-1"></i> Kirim Vote
                        </button>
                    </form>

                    <!-- Chart Hasil -->
                    @if($item->votes_count > 0)
                        <div class="chart-wrapper">
                            <div class="chart-title"><i class="fas fa-chart-pie me-1"></i> Hasil Polling</div>
                            <div class="chart-container">
                                <div class="chart-canvas-wrapper">
                                    <canvas id="chart-{{ $item->id }}"></canvas>
                                </div>
                                <div class="chart-legend">
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#facc15;"></span>
                                        <span>Biasa Saja</span>
                                        <span class="legend-value">{{ $item->votes_biasa_count }} ({{ $item->votes_count > 0 ? round(($item->votes_biasa_count / $item->votes_count) * 100) : 0 }}%)</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#34d399;"></span>
                                        <span>Bagus</span>
                                        <span class="legend-value">{{ $item->votes_bagus_count }} ({{ $item->votes_count > 0 ? round(($item->votes_bagus_count / $item->votes_count) * 100) : 0 }}%)</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#4f46e5;"></span>
                                        <span>Sangat Bagus</span>
                                        <span class="legend-value">{{ $item->votes_sangat_bagus_count }} ({{ $item->votes_count > 0 ? round(($item->votes_sangat_bagus_count / $item->votes_count) * 100) : 0 }}%)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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
    @foreach($pertanyaans as $item)
        @if($item->votes_count > 0)
        (function() {
            const ctx = document.getElementById('chart-{{ $item->id }}').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Biasa Saja', 'Bagus', 'Sangat Bagus'],
                    datasets: [{
                        data: [{{ $item->votes_biasa_count }}, {{ $item->votes_bagus_count }}, {{ $item->votes_sangat_bagus_count }}],
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
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            cornerRadius: 8,
                            padding: 10,
                            titleFont: { size: 13, weight: '600' },
                            bodyFont: { size: 12 },
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

    // Disable button setelah submit
    document.querySelectorAll('.vote-form').forEach(form => {
        form.addEventListener('submit', function() {
            const btn = this.querySelector('.btn-vote');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mengirim...';
            btn.disabled = true;
        });
    });
</script>
@endpush