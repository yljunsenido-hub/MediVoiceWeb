@props([
'action' => url()->current(),
'placeholder' => 'Search...',
'name' => 'search'
])

<form method="GET" action="{{ $action }}" class="w-full">

    <label
        class="mx-auto relative min-w-sm max-w-xl flex flex-col md:flex-row items-center justify-center py-1.5 px-1.5 rounded-xl gap-2">

        <input
            id="search-bar"
            type="text"
            name="{{ $name }}"
            value="{{ request($name) }}"
            placeholder="{{ $placeholder }}"
            class="px-4 py-1.5 text-sm w-full rounded-md flex-1 outline-none bg-white border border-slate-500">

        <button
            type="submit"
            class="w-full md:w-auto px-4 py-2 bg-slate-800 text-white active:scale-95 duration-100  overflow-hidden relative rounded-lg transition-all">

            <div class="relative">

                <div class="flex items-center justify-center h-3 w-3 absolute inset-1/2 -translate-x-1/2 -translate-y-1/2">
                    <svg class="opacity-0 animate-spin w-full h-full"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>

                <div class="flex items-center">
                    <span class="text-xs font-semibold whitespace-nowrap truncate mx-auto">
                        Search
                    </span>
                </div>

            </div>

        </button>

    </label>
</form>