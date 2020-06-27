<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <div class="absolute">
        <svg viewBox="0 0 24 24" class="w-5 h-5 mt-2 ml-2">
            <path fill-rule="evenodd" d="M20.2 18.1l-1.4 1.3-5.5-5.2 1.4-1.3 5.5 5.2zM7.5 12c-2.7 0-4.9-2.1-4.9-4.6s2.2-4.6 4.9-4.6 4.9 2.1 4.9 4.6S10.2 12 7.5 12zM7.5.8C3.7.8.7 3.7.7 7.3s3.1 6.5 6.8 6.5c3.8 0 6.8-2.9 6.8-6.5S11.3.8 7.5.8z" clip-rule="evenodd"/>
        </svg>
    </div>

    <input
        type="text"
        wire:model.debounce.300ms="search"
        class="w-64 mr-6 bg-gray-800 border border-gray-400 pl-8 pr-3 py-1 rounded-full text-sm focus:outline-none focus:border-blue-500 focus:shadow"
        placeholder="Search..."
        id="searchTerm"
        x-ref="search"
        @keydown.window="
            if (event.keyCode === 191) {
                event.preventDefault()
                $refs.search.focus()
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    >

    <div wire:loading class="spinner top-0 right-0 mr-10 mt-4"></div>

    @if (strlen($search) > 2)
    <div
        class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4"
        x-show.tansition.opacity="isOpen"
    >
        <ul>
            @if (count($searchResults) > 0)
                @foreach ($searchResults as $result)
                    <li class="border-b border-gray-700">
                        <a
                            href="{{ route('movies.show', $result['id']) }}"
                            class="hover:bg-gray-700 p-3 flex items-center"
                            @if ($loop->last) @keydown.tab="isOpen = false" @endif
                        >

                            @if ($result['poster_path'])
                                <img
                                    src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}"
                                    alt="{{ $result['title'] }}"
                                    class="w-8">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                            @endif


                            <span class="ml-4">{{ $result['title'] }}</span>
                        </a>
                    </li>
                @endforeach
            @else
                <div class="px-3 py-3">No Results for {{ $search }}</div>
            @endif

        </ul>
    </div>
    @endif
</div>
