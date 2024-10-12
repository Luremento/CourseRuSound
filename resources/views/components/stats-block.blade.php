<div class="flex items-center shadow justify-between p-4 bg-white rounded-md">
    <div>
        <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase">
            {{ $name }}
        </h6>
        <span class="text-xl font-semibold">{{ $number }}</span>
        <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
            {{ $percent }}%
        </span>
    </div>
    <div>
        <span>
            <svg class="w-12 h-12 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
        </span>
    </div>
</div>
