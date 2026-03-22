<aside class="w-64 bg-slate-800 text-white h-screen fixed top-0 left-0 border-r border-gray-300 shadow-md">
    <nav class="mt-4 space-y-2 px-4">

        <a href="{{ route('admin.dashboard') }}"
            class="block py-2 px-3 rounded hover:bg-slate-700
           {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : '' }}">
            Dashboard
        </a>

        <!-- Users Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="w-full text-left block py-2 px-3 rounded hover:bg-slate-700
                {{ request()->routeIs('admin.elder', 'admin.nurse', 'admin.caregiver') ? 'bg-blue-600 text-white' : '' }}">
                User Lists
                <span class="float-right">&#9662;</span> <!-- Down arrow -->
            </button>

            <div x-show="open" @click.away="open = false"
                class="mt-1 ml-2 space-y-1 pl-2">
                <a href="{{ route('admin.elder') }}"
                    class="block py-2 px-3 rounded hover:bg-slate-700
                   {{ request()->routeIs('admin.elder') ? 'bg-blue-600 text-white' : '' }}">
                    Elders
                </a>
                <a href="{{ route('admin.nurse') }}"
                    class="block py-2 px-3 rounded hover:bg-slate-700
                   {{ request()->routeIs('admin.nurse') ? 'bg-blue-600 text-white' : '' }}">
                    Nurse
                </a>
                <a href="{{ route('admin.caregiver') }}"
                    class="block py-2 px-3 rounded hover:bg-slate-700
                   {{ request()->routeIs('admin.caregiver') ? 'bg-blue-600 text-white' : '' }}">
                    Caregiver
                </a>
            </div>
        </div>

        <!-- Employee Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="w-full text-left block py-2 px-3 rounded hover:bg-slate-700
                {{ request()->routeIs('admin.nurse-list', 'admin.caregiver-list') ? 'bg-blue-600 text-white' : '' }}">
                Employee Lists
                <span class="float-right">&#9662;</span> <!-- Down arrow -->
            </button>

            <div x-show="open" @click.away="open = false"
                class="mt-1 ml-2 space-y-1 pl-2">
                <a href="{{ route('admin.nurse-list') }}"
                    class="block py-2 px-3 rounded hover:bg-slate-700
                   {{ request()->routeIs('admin.nurse-list') ? 'bg-blue-600 text-white' : '' }}">
                    Nurse
                </a>
                <a href="{{ route('admin.caregiver-list') }}"
                    class="block py-2 px-3 rounded hover:bg-slate-700
                   {{ request()->routeIs('admin.caregiver-list') ? 'bg-blue-600 text-white' : '' }}">
                    Caregivers
                </a>
            </div>
        </div>

        <a href="{{ route('admin.employee-request') }}"
            class="block py-2 px-3 rounded hover:bg-slate-700
           {{ request()->routeIs('admin.employee-request') ? 'bg-blue-600 text-white' : '' }}">
            Employee Request
        </a>

    </nav>
</aside>