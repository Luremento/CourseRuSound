<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>

<body>
@include('components.header')
<main class="py-4">
    <div class="w-full flex flex-wrap justify-center">
        @yield('content')


    </div>
</main>
<audio id="track-player" controls style="display: none;">
    <source id="track-source" src="" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<script>
    // var audio = document.getElementById('track-player');
    // var trackInfoBlock = document.getElementById('track-info-block');
    // var playPauseIcon = document.getElementById('play-pause-icon');
    //
    // function rewind10Seconds() {
    //     audio.currentTime -= 10;
    // }
    //
    // function skip10Seconds() {
    //     audio.currentTime += 10;
    // }
    //
    // function togglePlayPause() {
    //     if (audio.paused) {
    //         audio.play();
    //         playPauseIcon.innerHTML = `<rect x="4" y="3" width="3" height="18" rx="1.5" />
    //                                    <rect x="13" y="3" width="3" height="18" rx="1.5" />`;
    //     } else {
    //         audio.pause();
    //         playPauseIcon.innerHTML = `<rect x="4" y="3" width="3" height="18" rx="1.5" />
    //                                    <rect x="13" y="3" width="3" height="18" rx="1.5" />`;
    //     }
    // }
    //
    // document.addEventListener('DOMContentLoaded', function() {
    //     var progressBar = document.getElementById('progress-bar');
    //     var currentTime = document.getElementById('current-time');
    //     var duration = document.getElementById('duration');
    //
    //     // Скрыть блок информации о треке при загрузке страницы
    //     trackInfoBlock.classList.add('hidden');
    //
    //     audio.addEventListener('play', function() {
    //         var currentTrackInfo = JSON.parse(localStorage.getItem('currentTrack'));
    //         if (currentTrackInfo) {
    //             updateTrackInfo(currentTrackInfo.name, currentTrackInfo.artist, currentTrackInfo.photo, currentTrackInfo.trackNumber);
    //             trackInfoBlock.classList.remove('hidden');
    //         }
    //         playPauseIcon.innerHTML = `<rect x="4" y="3" width="3" height="18" rx="1.5" />
    //                                    <rect x="13" y="3" width="3" height="18" rx="1.5" />`;
    //     });
    //
    //     audio.addEventListener('pause', function() {
    //         playPauseIcon.innerHTML = `<rect x="4" y="3" width="3" height="18" rx="1.5" />
    //                                    <rect x="13" y="3" width="3" height="18" rx="1.5" />`;
    //     });
    //
    //     audio.addEventListener('timeupdate', function() {
    //         var progress = (audio.currentTime / audio.duration) * 100;
    //         progressBar.style.width = progress + '%';
    //         currentTime.textContent = formatTime(audio.currentTime);
    //         duration.textContent = formatTime(audio.duration);
    //     });
    //
    //     audio.addEventListener('ended', function() {
    //         playPauseIcon.innerHTML = `<rect x="4" y="3" width="3" height="18" rx="1.5" />
    //                                    <rect x="13" y="3" width="3" height="18" rx="1.5" />`;
    //         trackInfoBlock.classList.add('hidden');
    //     });
    //
    //     // Инициализация информации о текущем треке при загрузке страницы
    //     var initialTrackInfo = JSON.parse(localStorage.getItem('currentTrack'));
    //     if (initialTrackInfo) {
    //         updateTrackInfo(initialTrackInfo.name, initialTrackInfo.artist, initialTrackInfo.photo, initialTrackInfo.trackNumber);
    //     }
    //
    //     function updateTrackInfo(name, artist, photo, trackNumber) {
    //         document.getElementById('track-name').textContent = name;
    //         document.getElementById('track-artist').textContent = artist;
    //         document.getElementById('track-image').src = photo;
    //         document.getElementById('track-number').textContent = 'Track: ' + trackNumber;
    //     }
    //
    //     function formatTime(time) {
    //         var minutes = Math.floor(time / 60);
    //         var seconds = Math.floor(time % 60);
    //         return (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    //     }
    // });
</script>
</body>

</html>
