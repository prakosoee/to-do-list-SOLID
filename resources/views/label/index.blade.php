<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            Label
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">

        <!-- Search and Add User (Static) -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <form method="GET" action="{{ route('label.index') }}" class="w-full md:w-1/3 mb-4 md:mb-0 flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Label..." 
                    class="w-full px-4 py-2 rounded-md border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 dark:bg-blue-400 dark:hover:bg-blue-500">
                    Search
                </button>
            </form>                       
            <a href='{{ route('label.create') }}'>
                 <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 dark:bg-blue-400 dark:hover:bg-blue-500">
                Add New Label
            </button>
            </a>
           
        </div>

        <!-- User Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow dark:bg-gray-900">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal dark:bg-zinc-700 dark:text-gray-300">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                @forelse ($labels as $l)
                <tbody class="text-gray-600 text-sm dark:text-gray-300">
                    <tr class="border-b border-gray-200 hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-800">
                        <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6 text-left">{{ $l->name }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center dark:hover:text-gray-300">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('label.edit', $l->id) }}">
                                    <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                </a>
                                <!-- Tombol Delete -->
                                <form id="deleteLabelForm-{{ $l->id }}" action="{{ route('label.destroy', $l->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <!-- Tombol Delete -->
                                    <button type="button" data-label-id="{{ $l->id }}" onclick="openModal(this)"
                                        class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>

                                <!-- Modal Konfirmasi -->
                                <div id="modelConfirm" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
                                    <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">
                                        <div class="flex justify-end p-2">
                                            <button onclick="closeModal()" type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-6 pt-0 text-center">
                                            <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">Are you sure you want to delete this label?</h3>
                                            <form id="deleteLabelForm" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                                                    Yes, I'm sure
                                                </button>
                                                <button type="button" onclick="closeModal()"
                                                    class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center">
                                                    No, cancel
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Script -->
                                <script type="text/javascript">
                                    function openModal(button) {
                                        let labelId = button.getAttribute('data-label-id');
                                        let form = document.getElementById('deleteLabelForm');

                                        // Update action form dengan ID yang benar
                                        form.action = `/label/${labelId}`;

                                        // Tampilkan modal
                                        document.getElementById('modelConfirm').style.display = 'block';
                                        document.body.classList.add('overflow-y-hidden');
                                    }

                                    function closeModal() {
                                        document.getElementById('modelConfirm').style.display = 'none';
                                        document.body.classList.remove('overflow-y-hidden');
                                    }
                                </script>
                                
                            </div>
                        </td>
                    </tr>
                </tbody>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500 dark:text-gray-300">
                        No labels found.
                    </td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</x-app-layout>
