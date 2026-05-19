@extends('frontend.layouts.app')

@section('title')
    CCTV - DISKOMINFOSANTIK
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}" />
    <style>
        #map {
            width: 100%;
            height: 750px;
            border: 2px solid #0d6efd;
        }

        .video-popup {
            min-width: 320px;
        }

        .hls-video {
            width: 100%;
            max-width: 480px;
            background: #000;
        }
    </style>
@endpush

@section('content')
    <div class="page-content bg-white">
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery + Leaflet -->
    <script src="{{ asset('leaflet/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('src/leaflet-search.js') }}"></script>

    <!-- HLS.js -->
    <script src="{{ asset('hls/hls.js') }}"></script>

    <!-- Your custom script (we'll improve it) -->
    <script src="{{ asset('hls/new.js') }}"></script>
@endpush
