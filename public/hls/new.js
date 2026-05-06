// ==================== CCTV MAP - AUTO REFRESH (FINAL) ====================

let map;
const hlsInstances = {};
const refreshIntervals = {};

document.addEventListener('DOMContentLoaded', function () {

    map = L.map('map', {
        scrollWheelZoom: false,
        center: [-1.875633, 113.417374],
        zoom: 13
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const cctvIcon = L.icon({
        iconUrl: '/cctv.png',
        iconSize: [26, 27],
        popupAnchor: [0, -15]
    });

    const cameras = [
        { name: "Samsat",  lat: -1.890875, lng: 113.392933, stream: "/stream/samsat.m3u8",   videoId: "videosamsat" },
        { name: "Durian",  lat: -1.87215,  lng: 113.418067, stream: "/stream/durian.m3u8",   videoId: "videodurian" },
        { name: "Sala",    lat: -1.884982, lng: 113.405695, stream: "/stream/sala.m3u8",     videoId: "videosala" },
        { name: "Depag",   lat: -1.887667, lng: 113.4133,   stream: "/stream/depag.m3u8",    videoId: "videodepag" },
        { name: "Bukit",   lat: -1.893518, lng: 113.468682, stream: "/stream/bukit.m3u8",    videoId: "videobukit" },
        { name: "UPT",     lat: -1.900658, lng: 113.285363, stream: "/stream/upt.m3u8",      videoId: "videoupt" },
        // { name: "Samba", lat: -1.874711, lng: 113.424158, stream: "/stream/samba.m3u8", videoId: "videosamba" } // aktifkan nanti
    ];

    cameras.forEach(camera => {
        const popupHtml = `
            <div style="text-align:center; min-width:320px;">
                <strong>${camera.name} CCTV</strong><br><br>
                <video id="${camera.videoId}" width="300" autoplay muted controls style="background:#000; border-radius:4px;"></video>
                <div style="margin-top:8px; font-size:12px;" id="status-${camera.videoId}">Menunggu stream...</div>
            </div>
        `;

        const marker = L.marker([camera.lat, camera.lng], { icon: cctvIcon })
            .bindPopup(popupHtml, { maxWidth: 360, className: 'video-popup' })
            .addTo(map);

        marker.on('popupopen', () => initHLSPlayer(camera));
        marker.on('popupclose', () => destroyHLSPlayer(camera.videoId));
    });
});

// ==================== CORE FUNCTION ====================

function initHLSPlayer(camera) {
    const videoId = camera.videoId;
    const video = document.getElementById(videoId);
    const statusEl = document.getElementById(`status-${videoId}`);

    if (!video) return;

    destroyHLSPlayer(videoId);

    if (Hls.isSupported()) {
        const hls = new Hls({
            enableWorker: true,
            lowLatencyMode: true,
            backBufferLength: 30,
            maxBufferLength: 60,
            liveSyncDurationCount: 3,
            liveMaxLatencyDurationCount: 5
        });

        hlsInstances[videoId] = hls;

        function loadStream() {
            const freshUrl = `${camera.stream}?t=${Date.now()}`;
            console.log(`🔄 Refresh stream: ${camera.name}`);
            
            statusEl.textContent = '🔄 Loading...';
            statusEl.style.color = 'orange';
            
            hls.loadSource(freshUrl);
            hls.attachMedia(video);
        }

        loadStream();

        // Auto refresh tiap 45 detik (lebih responsif)
        refreshIntervals[videoId] = setInterval(loadStream, 45000);

        hls.on(Hls.Events.MANIFEST_PARSED, () => {
            video.play().catch(() => {});
            statusEl.textContent = '✅ LIVE';
            statusEl.style.color = 'lime';
        });

        hls.on(Hls.Events.ERROR, (event, data) => {
            if (data.fatal) {
                statusEl.textContent = '❌ Reconnecting...';
                statusEl.style.color = 'red';
                setTimeout(loadStream, 2000);
            }
        });

    } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        video.src = `${camera.stream}?t=${Date.now()}`;
        video.play();
    }
}

function destroyHLSPlayer(videoId) {
    if (hlsInstances[videoId]) {
        hlsInstances[videoId].destroy();
        delete hlsInstances[videoId];
    }
    if (refreshIntervals[videoId]) {
        clearInterval(refreshIntervals[videoId]);
        delete refreshIntervals[videoId];
    }
}