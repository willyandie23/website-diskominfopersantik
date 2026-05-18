<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard breadcrumb (Parent for all)
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Beranda', route('dashboard'));
});

// Banner breadcrumbs
Breadcrumbs::for('banner.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Banner', route('banner.index'));
});
Breadcrumbs::for('banner.create', function (BreadcrumbTrail $trail) {
    $trail->parent('banner.index');
    $trail->push('Tambah Banner', route('banner.create'));
});
Breadcrumbs::for('banner.edit', function (BreadcrumbTrail $trail, $bannerId) {
    $trail->parent('banner.index');
    $trail->push('Edit Banner', route('banner.edit', $bannerId));
});

// Download breadcrumbs
Breadcrumbs::for('download.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Unduhan', route('download.index'));
});
Breadcrumbs::for('unduhan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('download.index');
    $trail->push('Tambah Unduhan', route('unduhan.create'));
});
Breadcrumbs::for('unduhan.edit', function (BreadcrumbTrail $trail, $unduhanId) {
    $trail->parent('download.index');
    $trail->push('Edit Unduhan', route('unduhan.edit', $unduhanId));
});

// Gallery breadcrumbs
Breadcrumbs::for('gallery.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Galeri', route('gallery.index'));
});
Breadcrumbs::for('galeri.create', function (BreadcrumbTrail $trail) {
    $trail->parent('gallery.index');
    $trail->push('Tambah Galeri', route('galeri.create'));
});
Breadcrumbs::for('galeri.edit', function (BreadcrumbTrail $trail, $galleryId) {
    $trail->parent('gallery.index');
    $trail->push('Edit Galeri', route('galeri.edit', $galleryId));
});

// Identity breadcrumbs
Breadcrumbs::for('identity.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Identitas Website', route('identity.index'));
});

// News breadcrumbs
Breadcrumbs::for('news.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Berita', route('news.index'));
});
Breadcrumbs::for('berita.create', function (BreadcrumbTrail $trail) {
    $trail->parent('news.index');
    $trail->push('Tambah Berita', route('berita.create'));
});
Breadcrumbs::for('berita.edit', function (BreadcrumbTrail $trail, $newsId) {
    $trail->parent('news.index');
    $trail->push('Edit Berita', route('berita.edit', $newsId));
});

// Field breadcrumbs
Breadcrumbs::for('field.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Bidang Kantor', route('field.index'));
});
Breadcrumbs::for('bidang.create', function (BreadcrumbTrail $trail) {
    $trail->parent('field.index');
    $trail->push('Tambah Bidang Kantor', route('bidang.create'));
});
Breadcrumbs::for('bidang.edit', function (BreadcrumbTrail $trail, $fieldId) {
    $trail->parent('field.index');
    $trail->push('Edit Bidang Kantor', route('bidang.edit', $fieldId));
});

// Organizations breadcrumbs
Breadcrumbs::for('structure-organization.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Daftar Organisasi', route('structure-organization.index'));
});
Breadcrumbs::for('struktur-organisasi.create', function (BreadcrumbTrail $trail) {
    $trail->parent('structure-organization.index');
    $trail->push('Buat Organisasi', route('struktur-organisasi.create'));
});
Breadcrumbs::for('struktur-organisasi.edit', function (BreadcrumbTrail $trail, $organizationId) {
    $trail->parent('structure-organization.index');
    $trail->push('Edit Organisasi', route('struktur-organisasi.edit', $organizationId));
});

// Requests breadcrumbs
Breadcrumbs::for('requests.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Daftar Pengajuan', route('requests.index'));
});
Breadcrumbs::for('requests.show', function (BreadcrumbTrail $trail, $requestId) {
    $trail->parent('requests.index');
    $trail->push('Detail Pengajuan', route('requests.show', $requestId));
});

// Cases breadcrumbs
Breadcrumbs::for('cases.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Daftar Keluhan', route('cases.index'));
});
Breadcrumbs::for('cases.show', function (BreadcrumbTrail $trail, $caseId) {
    $trail->parent('cases.index');
    $trail->push('Detail Keluhan', route('cases.show', $caseId));
});

// Agenda breadcrumbs
Breadcrumbs::for('agenda.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Agenda', route('agenda.index'));
});
Breadcrumbs::for('agenda.create', function (BreadcrumbTrail $trail) {
    $trail->parent('agenda.index');
    $trail->push('Buat Agenda', route('agenda.create'));
});
Breadcrumbs::for('agenda.edit', function (BreadcrumbTrail $trail, $agendaId) {
    $trail->parent('agenda.index');
    $trail->push('Edit Agenda', route('agenda.edit', $agendaId));
});

// Katalog Layanan breadcrumbs
Breadcrumbs::for('katalog-layanan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Katalog Layanan', route('katalog-layanan.index'));
});
Breadcrumbs::for('katalog-layanan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('katalog-layanan.index');
    $trail->push('Tambah Layanan', route('katalog-layanan.create'));
});
Breadcrumbs::for('katalog-layanan.edit', function (BreadcrumbTrail $trail, $layananId) {
    $trail->parent('katalog-layanan.index');
    $trail->push('Edit Layanan', route('katalog-layanan.edit', $layananId));
});
Breadcrumbs::for('katalog-layanan.show', function (BreadcrumbTrail $trail, $layananId) {
    $trail->parent('katalog-layanan.index');
    $trail->push('Detail Layanan', route('katalog-layanan.show', $layananId));
});

# Katalog FAQ breadcrumbs
Breadcrumbs::for('katalog-faq.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Katalog FAQ', route('katalog-faq.index'));
});
Breadcrumbs::for('katalog-faq.create', function (BreadcrumbTrail $trail) {
    $trail->parent('katalog-faq.index');
    $trail->push('Tambah FAQ', route('katalog-faq.create'));
});
Breadcrumbs::for('katalog-faq.edit', function (BreadcrumbTrail $trail, $faqId) {
    $trail->parent('katalog-faq.index');
    $trail->push('Edit FAQ', route('katalog-faq.edit', $faqId));
});

# Pertanyaan breadcrumbs
Breadcrumbs::for('pertanyaan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Pertanyaan', route('pertanyaan.index'));
});
Breadcrumbs::for('pertanyaan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('pertanyaan.index');
    $trail->push('Tambah Pertanyaan', route('pertanyaan.create'));
});
Breadcrumbs::for('pertanyaan.edit', function (BreadcrumbTrail $trail, $pertanyaanId) {
    $trail->parent('pertanyaan.index');
    $trail->push('Edit Pertanyaan', route('pertanyaan.edit', $pertanyaanId));
});

// Profile breadcrumbs
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', route('profile.edit'));
});