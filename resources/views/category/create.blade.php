<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 my-2 dark:bg-gray-800 dark:text-white">
        <h2 class="text-2xl font-bold mb-4">Create Category</h2>
    
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
    
            <!-- Nama Kategori -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold dark:text-gray-300">Category Name</label>
                <input type="text" id="name" name="name" 
                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                    placeholder="Enter category name" required>
            </div>
    
            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <a href="{{ route('category.index') }}" 
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2 hover:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-800">Cancel</a>
                <button type="submit" 
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800">Save</button>
            </div>
        </form>
    </div>
</x-app-layout>
