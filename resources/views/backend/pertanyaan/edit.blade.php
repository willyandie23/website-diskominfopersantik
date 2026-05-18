@extends('backend.layouts.app')
@section('title', 'Admin - Edit Pertanyaan')

@push('css')
<style>
    .page-header-card { background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%); border-radius: 12px; padding: 1.5rem 2rem; margin-bottom: 1.5rem; box-shadow: 0 4px 20px rgba(79, 70, 229, 0.3); }
    .page-header-card h4 { font-size: 1.3rem; font-weight: 700; margin: 0; }
    .form-card { border: none; border-radius: 14px; box-shadow: 0 2px 16px rgba(0,0,0,0.07); overflow: hidden; }
    .form-card .card-header { background: #fff; border-bottom: 2px solid #f3f4f6; padding: 1.1rem 1.5rem; }
    .form-card .card-header h5 { font-size: 1rem; font-weight: 700; color: #1f2937; }
    .form-card .card-body { padding: 1.5rem; }
</style>
@endpush

@section('content')
<div class="page-header-card text-white">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
        <h4 class="text-white"><i class="fas fa-edit me-2"></i>Edit Pertanyaan</h4>
        <a href="{{ route('pertanyaan.index') }}" class="btn btn-light btn-sm fw-semibold px-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="form-card card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2 text-primary"></i>Form Edit Pertanyaan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pertanyaan.update', $pertanyaan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="pertanyaan_text" class="form-label fw-semibold">Pertanyaan <span class="text-danger">*</span></label>
                <textarea name="pertanyaan" id="pertanyaan_text" class="form-control @error('pertanyaan') is-invalid @enderror" rows="4">{{ old('pertanyaan', $pertanyaan->pertanyaan) }}</textarea>
                @error('pertanyaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $pertanyaan->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_active">Aktif</label>
                </div>
                <small class="text-muted">Pertanyaan aktif akan ditampilkan di halaman voting.</small>
            </div>

            <div class="mb-3 p-3 rounded-3" style="background:#f8fafc;">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Pertanyaan ini memiliki <strong>{{ $pertanyaan->votes()->count() }}</strong> votes terkait.
                </small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-1"></i> Update
                </button>
                <a href="{{ route('pertanyaan.index') }}" class="btn btn-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    CKEDITOR.replace('pertanyaan_text', {
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'tools', items: ['Maximize'] }
        ],
        height: 200
    });
</script>
@endpush