<div
    class="shadow-lg rounded p-3 transition duration-300 ease-in-out group {{ $type == 'albom' ? 'no-hover-effect' : '' }} hover:bg-neutral-500 {{ $type == 'albom' ? 'hover:bg-white' : '' }}">
    <div class="group relative {{ $type == 'albom' ? 'no-hover-effect' : '' }}">
        <img class="w-full md:w-72 block rounded mx-auto" src="{{ asset('storage/' . $track->cover_file) }}"
            alt="" />
        @if ($type != 'albom')
            <div
                class="absolute rounded bg-opacity-0 group-hover:bg-opacity-60 w-full h-full top-0 flex items-center group-hover:opacity-100 transition justify-evenly">
                <button
                    class="hover:scale-110 text-white opacity-0 transform translate-y-3 group-hover:translate-y-0 group-hover:opacity-100 transition z-10"
                    onclick="event.preventDefault(); likeTrack({{ $track->id }})">
                    @if (Auth::user() && count($track->likes) > 0)
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                            <path fill="red"
                                d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-heart" viewBox="0 0 16 16">
                            <path
                                d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>
                    @endif
                </button>
                <button id="play-stop-button-{{ $track->id }}"
                    class="hover:scale-110 text-white opacity-0 transform translate-y-3 group-hover:translate-y-0 group-hover:opacity-100 transition z-10"
                    onclick="event.preventDefault(); togglePlayStop('{{ asset('storage/' . $track->music_file) }}', {{ $track->id }})">
                    <svg id="play-icon-{{ $track->id }}" xmlns="http://www.w3.org/2000/svg" width="40"
                        height="40" fill="currentColor" class="bi bi-play-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z" />
                    </svg>
                    <svg id="stop-icon-{{ $track->id }}" style="display: none;" xmlns="http://www.w3.org/2000/svg"
                        width="40" height="40" fill="currentColor" class="bi bi-stop-circle-fill"
                        viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.5 5A1.5 1.5 0 0 0 5 6.5v3A1.5 1.5 0 0 0 6.5 11h3A1.5 1.5 0 0 0 11 9.5v-3A1.5 1.5 0 0 0 9.5 5h-3z" />
                    </svg>
                </button>
                @if (Auth::user())
                    <button id="dropdownDefaultButton-{{ $track->id }}"
                        class="hover:scale-110 text-white opacity-0 transform translate-y-3 group-hover:translate-y-0 group-hover:opacity-100 transition z-10"
                        onclick="event.preventDefault(); toggleDropdown('dropdown-{{ $track->id }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path
                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                        </svg>
                    </button>
                @else
                    <button id="dropdownDefaultButton-{{ $track->id }}"
                        class="hover:scale-110 invisible text-white opacity-0 transform translate-y-3 group-hover:translate-y-0 group-hover:opacity-100 transition z-10"
                        onclick="event.preventDefault(); toggleDropdown('dropdown-{{ $track->id }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path
                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                        </svg>
                    </button>
                @endif
                <!-- Dropdown menu -->
                <div id="dropdown-{{ $track->id }}"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 absolute top-2/4 left-2/3 mt-2">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton-{{ $track->id }}">
                        <li>
                            @if ($type == 'albom')
                                <a href={{ route('ShawAlbom', ['id' => $track->id]) }}
                                    class="block px-4 py-2 hover:bg-gray-100">Открыть</a>
                            @else
                                <a href={{ route('ShawTrack', ['id' => $track->id]) }}
                                    class="block px-4 py-2 hover:bg-gray-100">Открыть</a>
                            @endif
                        </li>
                        @if (Auth::user() && (Auth::user()->is_admin == 1 || Auth::id() == $track->user->id))
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 text-red-700"
                                    onclick="event.preventDefault();
                                              document.getElementById('delete-track').submit();">Удалить</a>
                            </li>
                        @endif
                        <li>
                            <button id="add-to-playlist-button-{{ $track->id }}"
                                class="block px-4 py-2 hover:bg-gray-100"
                                onclick="event.preventDefault(); togglePlaylistDropdown('playlist-dropdown-{{ $track->id }}')">
                                Добавить в плейлист
                            </button>
                            <!-- Playlist dropdown menu -->
                            <div id="playlist-dropdown-{{ $track->id }}"
                                class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 absolute top-2/4 left-full mt-2">
                                <ul class="py-2 text-sm text-gray-700"
                                    aria-labelledby="add-to-playlist-button-{{ $track->id }}">
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Добавить
                                            плейлист</a>
                                    </li>
                                    @if (isset($myPlaylists) && $myPlaylists->count() > 0)
                                        @foreach ($myPlaylists as $playlist)
                                            <li>
                                                <a class="block px-4 py-2 hover:bg-gray-100"
                                                    onclick="event.preventDefault(); addTrackToPlaylist({{ $track->id }}, {{ $playlist->id }})">{{ $playlist->name }}</a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="block px-4 py-2 hover:bg-gray-100">Плейлистов не найдено</li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    </div>
    <div class="p-5">
        @if ($type == 'track')
            <h3 class="text-lg font-semibold leading-6 text-gray-900">{{ $track->name }}</h3>
            <p class="text-sm font-semibold leading-6 text-gray-900">{{ $artist->name }}</p>
        @else
            <a href={{ route('ShawAlbom', ['id' => $track->id]) }}>
                <h3 class="text-lg font-semibold leading-6 text-gray-900">{{ $track->name }}</h3>
            </a>
            <a href="">
                <p class="text-sm font-semibold leading-6 text-gray-900">{{ $artist->name }}</p>
            </a>
        @endif
    </div>
</div>

<audio id="track-player" controls style="display: none;">
    <source id="track-source" src="" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<form id="liked-form" action="{{ route('like.add') }}" method="POST"
    style="position: absolute; left: -1000px; top: -1000px;">
    <input type="text" name="track_id" id="track_id">
    @csrf
</form>

<form id="add-track-to-playlist-form" action="{{ route('addTrackToPlaylist') }}" method="POST"
    style="position: absolute; left: -1000px; top: -1000px;">
    <input type="hidden" name="track_id" id="track_id_for_playlist">
    <input type="hidden" name="albom_id" id="playlist_id_for_track">
    @csrf
</form>

<form id="delete-track" action="{{ route('deleteTrack') }}" method="POST"
    style="position: absolute; left: -1000px; top: -1000px;">
    @csrf
    @method('DELETE')
    <input type="text" name="track_id" id="track_id" value={{ $track->id }}>
</form>


<script>
    function addTrackToPlaylist(trackId, playlistId) {
        document.getElementById('track_id_for_playlist').value = trackId;
        document.getElementById('playlist_id_for_track').value = playlistId;
        document.getElementById('add-track-to-playlist-form').submit();
    }

    function likeTrack(trackId) {
        document.getElementById('track_id').value = trackId;
        document.getElementById('liked-form').submit();
    }

    function togglePlayStop(trackUrl, trackId) {
        var audio = document.getElementById('track-player');
        var source = document.getElementById('track-source');
        var playIcon = document.getElementById('play-icon-' + trackId);
        var stopIcon = document.getElementById('stop-icon-' + trackId);

        if (audio.paused) {
            source.src = trackUrl;
            audio.load();
            audio.play();
            playIcon.style.display = 'none';
            stopIcon.style.display = 'block';
        } else {
            audio.pause();
            playIcon.style.display = 'block';
            stopIcon.style.display = 'none';
        }
    }

    function toggleDropdown(dropdownId) {
        var dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle('hidden');
    }

    function togglePlaylistDropdown(playlistDropdownId) {
        var playlistDropdown = document.getElementById(playlistDropdownId);
        playlistDropdown.classList.toggle('hidden');
    }
</script>

<style>
    .group:hover img {
        filter: brightness(0.5);
    }

    .no-hover-effect:hover img {
        filter: none;
    }
</style>
