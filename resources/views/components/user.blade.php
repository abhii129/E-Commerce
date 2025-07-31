<div class="flex items-center p-3 rounded-lg bg-gradient-to-r from-blue-50 via-white to-blue-50 shadow-sm gap-3 max-w-xs">
    <div class="flex-shrink-0">
        <svg class="w-9 h-9 text-blue-500 bg-blue-100 rounded-full p-1.5 shadow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.5" fill="currentColor" class="text-blue-200" />
            <path fill="none" stroke="currentColor" stroke-width="1.5" d="M3 21.5c0-4.142 8-4.142 8 0M21 21.5c0-4.142-8-4.142-8 0"/>
        </svg>
    </div>
    <div>
        @if(auth()->check())
            <div class="font-semibold text-blue-700 leading-none">{{ auth()->user()->name }}</div>
            <div class="text-xs text-blue-400 mt-0.5">Logged In</div>
        @else
            <div class="font-semibold text-gray-500 leading-none">Guest</div>
            <div class="text-xs text-gray-400 mt-0.5">Not signed in</div>
        @endif
    </div>
</div>
