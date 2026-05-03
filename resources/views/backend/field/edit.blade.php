@extends('backend.layouts.app')

@section('title', 'Admin - Edit Bidang')

@push('styles')
<style>
    :root {
        --primary-green: #10b981;
        --dark-green: #0f4c3a;
    }

    .page-header-bidang {
        background: linear-gradient(135deg, var(--dark-green) 0%, #166534 50%, var(--primary-green) 100%);
        border-radius: 20px;
        padding: 32px 36px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px -10px rgba(16, 185, 129, 0.3);
        z-index: 1;
    }

    .page-header-bidang::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 240px;
        height: 240px;
        background: rgba(255, 255, 255, 0.09);
        border-radius: 50%;
        filter: blur(25px);
        z-index: -1;
    }

    .page-header-bidang h4 {
        color: #fff;
        font-weight: 700;
        font-size: 1.55rem;
        margin-bottom: 6px;
    }

    .bidang-form-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: #fff;
        margin-top: -20px; /* sedikit naik agar overlap bagus */
    }

    .form-label-modern {
        font-weight: 600;
        color: #1e293b;
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

    .form-control-modern {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control-modern:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
    }

    /* Button Kembali - DIPERBAIKI */
    .btn-back {
        background: rgba(255, 255, 255, 0.25);
        color: #fff;
        font-weight: 600;
        border: 2px solid rgba(255, 255, 255, 0.4);
        border-radius: 12px;
        padding: 10px 24px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        z-index: 10;
        position: relative;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.35);
        transform: translateY(-2px);
        color: #fff;
    }

    .btn-update {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
    }

    /* CKEditor */
    .ck-editor__editable {
        min-height: 320px;
        border-radius: 12px !important;
    }
</style>
@endpush

@section('content')

    <!-- Header -->
    <div class="page-header-bidang d-flex justify-content-between align-items-center flex-wrap gap-4">
        <div style="position: relative; z-index: 2;">
            <h4><i class="fas fa-edit me-3"></i>Edit Bidang</h4>
            <p class="text-white/80 mb-0">Perbarui informasi nama dan deskripsi bidang.</p>
        </div>
        
        <!-- Button Kembali yang sudah diperbaiki -->
        <a href="{{ route('field.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="bidang-form-card card">
        <div class="card-body p-8">
            <form action="{{ route('bidang.update', $bidang) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="nama_bidang" class="form-label-modern">
                        Nama Bidang <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="nama_bidang" 
                           id="nama_bidang"
                           class="form-control form-control-modern @error('nama_bidang') is-invalid @enderror"
                           value="{{ old('nama_bidang', $bidang->nama_bidang) }}" 
                           required>
                    @error('nama_bidang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="deskripsi_bidang" class="form-label-modern">
                        Deskripsi Bidang
                    </label>
                    <textarea name="deskripsi_bidang" 
                              id="deskripsi_bidang"
                              class="form-control form-control-modern @error('deskripsi_bidang') is-invalid @enderror"
                              rows="8">{{ old('deskripsi_bidang', $bidang->deskripsi_bidang) }}</textarea>
                    @error('deskripsi_bidang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex align-items-center gap-3 mt-6">
                    <button type="submit" class="btn-update">
                        <i class="fas fa-save"></i> Update Bidang
                    </button>
                    <a href="{{ route('field.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi_bidang'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline',
                    'bulletedList', 'numberedList',
                    'outdent', 'indent', '|',
                    'link', 'blockQuote', 'insertTable',
                    'undo', 'redo'
                ]
            },
            language: 'id'
        })
        .catch(error => console.error(error));
</script>
@endpush