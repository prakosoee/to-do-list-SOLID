<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 my-2 dark:bg-gray-800 dark:text-white">
        <h2 class="text-2xl font-bold mb-4">Edit Task</h2>

        <form action="{{ route('task.update', $task->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Judul -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold dark:text-gray-300">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" 
                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                    required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold dark:text-gray-300">Description</label>
                <textarea id="description" name="description"
                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required rows="3">{{ old('description', $task->description) }}</textarea>
            </div>

            <!-- Kategori -->
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-bold dark:text-gray-300">Category</label>
                <select id="category_id" name="category_id" 
                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Choose Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
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
                                class="form-checkbox text-blue-500 dark:bg-gray-700 dark:border-gray-600"
                                {{ in_array($label->id, $task->labels->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <span>{{ $label->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold dark:text-gray-300">Status</label>
                <select id="status" name="status" required
                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <!-- Tanggal Deadline -->
            <div class="mb-4">
                <label for="due_date" class="block text-gray-700 font-bold dark:text-gray-300">Tanggal Deadline</label>
                <input type="date" name="due_date" required value="{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}" 
                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <a href="{{ route('task.index') }}" 
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2 hover:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-800">Batal</a>
                <button type="submit" 
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
