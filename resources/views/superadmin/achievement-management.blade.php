@extends('layouts.superadmin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white/10 backdrop-blur-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white">Achievement Management</h2>
            <button onclick="document.getElementById('addAchievementModal').classList.remove('hidden')" 
                    class="bg-[#5fbbd1] hover:bg-[#4a9bb1] text-white px-4 py-2 rounded-lg transition-colors">
                Add New Achievement
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-100 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Achievements Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-white">
                <thead class="bg-black/30">
                    <tr>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Description</th>
                        <th class="px-4 py-3 text-center">Secret</th>
                        <th class="px-4 py-3 text-left">Image</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach($achievements as $achievement)
                        <tr class="hover:bg-white/5">
                            <td class="px-4 py-3">{{ $achievement->name }}</td>
                            <td class="px-4 py-3">{{ $achievement->description }}</td>
                            <td class="px-4 py-3 text-center">
                                @if($achievement->is_secret)
                                    <span class="text-yellow-400">✨</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($achievement->image)
                                    <img src="{{ $achievement->image }}" alt="{{ $achievement->name }}" class="h-8 w-8 object-cover rounded">
                                @else
                                    <span class="text-gray-400">No image</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button onclick="openEditModal('{{ $achievement->id }}', '{{ $achievement->name }}', '{{ $achievement->description }}', {{ $achievement->is_secret ? 'true' : 'false' }}, '{{ $achievement->image }}')" 
                                        class="text-[#5fbbd1] hover:text-[#4a9bb1] mr-2">
                                    Edit
                                </button>
                                <form action="{{ route('superadmin.achievements.destroy', $achievement) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-500" 
                                            onclick="return confirm('Are you sure you want to delete this achievement?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Achievement Modal -->
<div id="addAchievementModal" class="fixed inset-0 bg-black/50 hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-[#1a3f5c] rounded-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-white mb-4">Add New Achievement</h3>
            <form action="{{ route('superadmin.achievements.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-white mb-2">Name</label>
                        <input type="text" name="name" required maxlength="255" 
                               class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
                    </div>
                    <div>
                        <label class="block text-white mb-2">Description</label>
                        <textarea name="description" required maxlength="1000" rows="3"
                                  class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white"></textarea>
                    </div>
                    <div>
                        <label class="block text-white mb-2">Image URL (optional)</label>
                        <input type="text" name="image" maxlength="255" 
                               class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_secret" id="addIsSecret" 
                               class="rounded border-white/20 bg-white/10 text-[#5fbbd1]">
                        <label for="addIsSecret" class="ml-2 text-white">Secret Achievement</label>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="document.getElementById('addAchievementModal').classList.add('hidden')"
                            class="px-4 py-2 text-white hover:bg-white/10 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-[#5fbbd1] hover:bg-[#4a9bb1] text-white px-4 py-2 rounded">
                        Add Achievement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Achievement Modal -->
<div id="editAchievementModal" class="fixed inset-0 bg-black/50 hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-[#1a3f5c] rounded-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-white mb-4">Edit Achievement</h3>
            <form id="editAchievementForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-white mb-2">Name</label>
                        <input type="text" name="name" id="editName" required maxlength="255" 
                               class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
                    </div>
                    <div>
                        <label class="block text-white mb-2">Description</label>
                        <textarea name="description" id="editDescription" required maxlength="1000" rows="3"
                                  class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white"></textarea>
                    </div>
                    <div>
                        <label class="block text-white mb-2">Image URL (optional)</label>
                        <input type="text" name="image" id="editImage" maxlength="255" 
                               class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_secret" id="editIsSecret" 
                               class="rounded border-white/20 bg-white/10 text-[#5fbbd1]">
                        <label for="editIsSecret" class="ml-2 text-white">Secret Achievement</label>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="document.getElementById('editAchievementModal').classList.add('hidden')"
                            class="px-4 py-2 text-white hover:bg-white/10 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-[#5fbbd1] hover:bg-[#4a9bb1] text-white px-4 py-2 rounded">
                        Update Achievement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(id, name, description, isSecret, image) {
    document.getElementById('editAchievementForm').action = `/superadmin/achievements/${id}`;
    document.getElementById('editName').value = name;
    document.getElementById('editDescription').value = description;
    document.getElementById('editIsSecret').checked = isSecret;
    document.getElementById('editImage').value = image || '';
    document.getElementById('editAchievementModal').classList.remove('hidden');
}
</script>
@endsection 