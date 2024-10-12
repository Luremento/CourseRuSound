<div class="flex items-center shadow justify-between p-4 bg-white rounded-md">
    <div>
        <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase">
            {{ $name }}
        </h6>
        <span class="text-xl font-semibold">{{ $number }}</span>
        @if ($percent != 'None')
            <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                {{ $percent }}%
            </span>
        @endif
    </div>
    <div>
        <span>
            {{ $svg }}
        </span>
    </div>
</div>
