@props([
    'route',
    'message' => 'Are you sure you want to delete this record?',
    'buttonClass' => 'text-red-700 hover:underline font-medium',
    'confirmClass' => 'px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700'
])

<div x-data="{ open: false }" class="inline">

    <button type="button"
        @click="open = true"
        class="{{ $buttonClass }}">
        Delete
    </button>

    <div x-show="open"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        x-cloak>

        <div class="bg-white rounded-2xl shadow-xl w-96 p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-2">
                Confirm Deletion
            </h2>

            <p class="text-gray-600 mb-6">
                {{ $message }}
            </p>

            <div class="flex justify-end gap-3">

                <button @click="open = false"
                    class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                    Cancel
                </button>

                <form action="{{ $route }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="{{ $confirmClass }}">
                        Yes, Delete
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>