<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 my-2 dark:bg-gray-800 dark:text-white">
        <h2 class="text-2xl font-bold mb-4">Create Task</h2>
    
        <form action="{{ route('task.store') }}" method="POST">
            @csrf
    
            <!-- Judul -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold dark:text-gray-300">Title</label>
                <input type="text" id="title" name="title" 
                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:text-white" 
                    placeholder="Masukkan judul tugas" required>
            </div>
    
            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold dark:text-gray-300">Description</label>
                <textarea id="description" name="description" 
                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:text-white" 
                    rows="3" placeholder="Deskripsi tugas" required></textarea>
            </div>
    
            <!-- Kategori -->
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-bold dark:text-gray-300">Category</label>
                <select id="category_id" name="category_id" 
                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:text-white" required>
                    <option value="">Choose Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Label -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold dark:text-gray-300">Label</label>
                <div class="grid grid-cols-2 gap-2 mt-2">
                    @foreach ($labels as $label)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="labels[]" value="{{ $label->id }}" 
                                class="form-checkbox text-blue-500 dark:text-blue-300">
                            <span>{{ $label->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
    
            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold dark:text-gray-300">Status</label>
                <select id="status" name="status" 
                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:text-white" required>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
    
            <!-- Tanggal Deadline -->
            <div class="mb-4">
                <label for="due_date" class="block text-gray-700 font-bold dark:text-gray-300">Tanggal Deadline</label>
                <input type="date" id="due_date" name="due_date" 
                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:text-white" required>
            </div>
    
            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <a href="{{ route('task.index') }}" 
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2 hover:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600">Batal</a>
                <button type="submit" 
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
