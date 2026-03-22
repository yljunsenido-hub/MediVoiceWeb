<x-app-layout>
    <div class="p-6">

        <h2 class="text-2xl font-bold mb-4">Employee Requests</h2>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Role</th>
                    <th class="border p-2">Employee No</th>
                    <th class="border p-2">First Name</th>
                    <th class="border p-2">Last Name</th>
                    <th class="border p-2">Age</th>
                    <th class="border p-2">Contact Number</th>
                    <th class="border p-2">Shift</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>

            <tbody>

                {{-- Nurse Requests --}}
                @foreach($nurseRequests as $id => $request)
                <tr>
                    <td class="border p-2 text-center">Nurse</td>
                    <td class="border p-2 text-center">{{ $request['employeeNumber'] }}</td>
                    <td class="border p-2 text-center">{{ $request['firstName'] }}</td>
                    <td class="border p-2 text-center">{{ $request['lastName'] }}</td>
                    <td class="border p-2 text-center">{{ $request['age'] }}</td>
                    <td class="border p-2 text-center">{{ $request['contactNumber'] }}</td>
                    <td class="border p-2 text-center">{{ $request['shift'] }}</td>
                    <td class="border p-2 text-center">{{ $request['email'] }}</td>
                    <td class="border p-2 text-center flex justify-center gap-2">

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
                @endforeach

                {{-- Caregiver Requests --}}
                @foreach($caregiverRequests as $id => $request)
                <tr>
                    <td class="border p-2 text-center">Caregiver</td>
                    <td class="border p-2 text-center">{{ $request['employeeNumber'] }}</td>
                    <td class="border p-2 text-center">{{ $request['firstName'] }}</td>
                    <td class="border p-2 text-center">{{ $request['lastName'] }}</td>
                    <td class="border p-2 text-center">{{ $request['age'] }}</td>
                    <td class="border p-2 text-center">{{ $request['contactNumber'] }}</td>
                    <td class="border p-2 text-center">{{ $request['shift'] }}</td>
                    <td class="border p-2 text-center">{{ $request['email'] }}</td>
                    <td class="border p-2 text-center flex justify-center gap-2">

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
                @endforeach

                @if(empty($nurseRequests) && empty($caregiverRequests))
                <tr>
                    <td colspan="6" class="text-center p-4">No requests found</td>
                </tr>
                @endif

            </tbody>
        </table>

    </div>
</x-app-layout>