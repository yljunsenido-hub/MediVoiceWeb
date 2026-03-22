@props([
'title',
'value',
'color' => 'border-slate-600',
'hoverBg' => 'hover:bg-slate-800',
'hoverText' => 'group-hover:text-white',
'iconBg' => 'bg-blue-100',
'iconColor' => 'text-blue-600'
])

<div class="group bg-white rounded-2xl p-6 border-l-8 {{ $color }} w-full
            shadow-md transition-all duration-300 ease-in-out
            hover:-translate-y-2 hover:shadow-2xl hover:scale-[1.02]
            {{ $hoverBg }} cursor-pointer">

    <div class="flex items-center justify-between">

        <div>
            <p class="text-sm font-medium text-gray-700 uppercase tracking-wide
                      transition-colors duration-300 {{ $hoverText }}">
                {{ $title }}
            </p>

            <h2 class="text-4xl font-bold text-slate-800 mt-2
                       transition-colors duration-300 {{ $hoverText }}">
                {{ $value }}
            </h2>
        </div>

        <div class="{{ $iconBg }} p-3 rounded-full
                    transition-all duration-300
                    group-hover:scale-110 group-hover:rotate-6
                    group-hover:bg-white">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 {{ $iconColor }} transition-colors duration-300 group-hover:text-slate-800"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 12c2.761 0 5-2.239 5-5S14.761 2 12 2 7 4.239 7 7s2.239 5 5 5zm0 2c-3.866 0-7 3.134-7 7h14c0-3.866-3.134-7-7-7z" />
            </svg>

        </div>

    </div>
</div>