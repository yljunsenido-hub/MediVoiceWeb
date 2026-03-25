<x-app-layout>
    <div class="p-6">

        <h2 class="text-2xl font-bold mb-4">Employee Requests</h2>

        <div class="relative overflow-x-auto bg-white shadow-sm rounded-lg border border-gray-200 mt-4">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-gray-700">Role</th>
                        <th class="px-6 py-3 font-semibold text-gray-700">Employee No</th>
                        <th class="px-6 py-3 font-semibold text-gray-700">First Name</th>
                        <th class="px-6 py-3 font-semibold text-gray-700">Last Name</th>
                        <th class="px-6 py-3 font-semibold text-gray-700">Age</th>
                        <th class="px-6 py-3 font-semibold text-gray-700">Contact Number</th>
                        <th class="px-6 py-3 font-semibold text-gray-700">Shift</th>
                        <th class="px-6 py-3 font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-3 font-semibold text-gray-700 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- Nurse Requests --}}
                    @foreach($nurseRequests as $id => $request)
                    @if($request)
                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100 transition">
                        <td class="px-6 py-4 ">Nurse</td>
                        <td class="px-6 py-4 ">{{ $request['employeeNumber'] }}</td>
                        <td class="px-6 py-4 ">{{ $request['firstName'] }}</td>
                        <td class="px-6 py-4 ">{{ $request['lastName'] }}</td>
                        <td class="px-6 py-4 ">{{ $request['age'] }}</td>
                        <td class="px-6 py-4 ">{{ $request['contactNumber'] }}</td>
                        <td class="px-6 py-4 ">{{ $request['shift'] }}</td>
                        <td class="px-6 py-4 ">{{ $request['email'] }}</td>
                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                            <form method="POST" action="{{ route('admin.employee-request.approve', ['role'=>'nurse','id'=>$id]) }}">
                                @csrf
                                <button class="bg-green-500 text-white px-3 py-1 rounded">Accept</button>
                            </form>
                            <form method="POST" action="{{ route('admin.employee-request.reject', ['role'=>'nurse','id'=>$id]) }}">
                                @csrf
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Reject</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach

                    {{-- Caregiver Requests --}}
                    @foreach($caregiverRequests as $id => $request)
                    @if($request)
                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100 transition">
                        <td class="px-6 py-4 text-center">Caregiver</td>
                        <td class="px-6 py-4 text-center">{{ $request['employeeNumber'] }}</td>
                        <td class="px-6 py-4 text-center">{{ $request['firstName'] }}</td>
                        <td class="px-6 py-4 text-center">{{ $request['lastName'] }}</td>
                        <td class="px-6 py-4 text-center">{{ $request['age'] }}</td>
                        <td class="px-6 py-4 text-center">{{ $request['contactNumber'] }}</td>
                        <td class="px-6 py-4 text-center">{{ $request['shift'] }}</td>
                        <td class="px-6 py-4 text-center">{{ $request['email'] }}</td>
                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                            <form method="POST" action="{{ route('admin.employee-request.approve', ['role'=>'caregiver','id'=>$id]) }}">
                                @csrf
                                <button class="bg-green-500 text-white px-3 py-1 rounded">Accept</button>
                            </form>
                            <form method="POST" action="{{ route('admin.employee-request.reject', ['role'=>'caregiver','id'=>$id]) }}">
                                @csrf
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Reject</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach

                    @if(empty($nurseRequests) && empty($caregiverRequests))
                    <tr>
                        <td colspan="9" class="text-center p-4">No requests found</td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>