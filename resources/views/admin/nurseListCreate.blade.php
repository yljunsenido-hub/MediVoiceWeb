<x-app-layout>
    <div class="bg-white py-6 px-6 rounded-xl shadow-sm mb-6">

        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Add Nurse Employee
        </h3>

        <form action="{{ route('admin.nurse-list.store') }}" method="POST" class="mb-6">
            @csrf
            <div class="grid gap-6 md:grid-cols-2">
                <input type="text" name="first_name" placeholder="First Name" required class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2 shadow-sm">
                <input type=" text" name="middle_name" placeholder="Middle Name" required class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2 shadow-sm">
                <input type="text" name="last_name" placeholder="Last Name" required class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2 shadow-sm">
                <input type="email" name="email" placeholder="Email" required class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2 shadow-sm">
                <input type="text" name="contact" placeholder="Contact Number" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2 shadow-sm">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-6">
                Add Nurse
            </button>

        </form>


    </div>


</x-app-layout>