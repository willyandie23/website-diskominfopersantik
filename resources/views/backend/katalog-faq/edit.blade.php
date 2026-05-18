@extends('backend.layouts.app')

@section('title', 'Admin - Edit FAQ')

@push('styles')
<style>
    .ck-editor__editable { min-height: 380px !important; }
    .form-section {
        background: #f8fafc;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        border: 1px solid #e2e8f0;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit FAQ</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('katalog-faq.update', $katalogFaq) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-section">
                        <label for="title" class="form-label fw-semibold">Pertanyaan <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control form-control-lg @error('title') is-invalid @enderror" 
                               value="{{ old('title', $katalogFaq->title) }}" placeholder="Contoh: Apa itu layanan ... ?">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-section">
                        <label for="deskripsi" class="form-label fw-semibold">Jawaban <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $katalogFaq->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-3">
                        <a href="{{ route('katalog-faq.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-warning px-5 text-white">
                            <i class="fas fa-save me-1"></i> Update FAQ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#deskripsi'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'link', 'blockQuote', '|', 'undo', 'redo'],
                language: 'id'
            })
            .catch(error => console.error(error));
    });
</script>
@endpush