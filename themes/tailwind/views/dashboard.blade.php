<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Table to display the list of users -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th
                                        class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Example User Row -->
                                @foreach ($users as $user)
                                <tr>
                                    <td class="py-4 px-6 whitespace-nowrap text-sm font-medium text-gray-900">{{
                                        $user->name }}</td>
                                    <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}
                                    </td>
                                    <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('chat', $user->id) }}"
                                            class="text-blue-500 hover:text-blue-700">Chat</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
