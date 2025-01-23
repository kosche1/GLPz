@extends('layouts.superadmin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white/10 backdrop-blur-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white">Level Management</h2>
            <button onclick="document.getElementById('addLevelModal').classList.remove('hidden')" 
                    class="bg-[#5fbbd1] hover:bg-[#4a9bb1] text-white px-4 py-2 rounded-lg transition-colors">
                Add New Level
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-100 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Levels Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-white">
                <thead class="bg-black/30">
                    <tr>
                        <th class="px-4 py-3 text-left">Level</th>
                        <th class="px-4 py-3 text-left">XP Required for Next Level</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach($levels as $level)
                        <tr class="hover:bg-white/5">
                            <td class="px-4 py-3">{{ $level->level }}</td>
                            <td class="px-4 py-3">{{ number_format($level->next_level_experience) }} XP</td>
                            <td class="px-4 py-3 text-right">
                                <button onclick="openEditModal('{{ $level->id }}', '{{ $level->level }}', '{{ $level->next_level_experience }}')" 
                                        class="text-[#5fbbd1] hover:text-[#4a9bb1] mr-2">
                                    Edit
                                </button>
                                <form action="{{ route('superadmin.levels.destroy', $level) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-500" 
                                            onclick="return confirm('Are you sure you want to delete this level?')">
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

<!-- Add Level Modal -->
<div id="addLevelModal" class="fixed inset-0 bg-black/50 hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-[#1a3f5c] rounded-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-white mb-4">Add New Level</h3>
            <form action="{{ route('superadmin.levels.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-white mb-2">Level Number</label>
                        <input type="number" name="level" required min="1" 
                               class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
                    </div>
                    <div>
                        <label class="block text-white mb-2">XP Required for Next Level</label>
                        <input type="number" name="next_level_experience" required min="0" 
                               class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="document.getElementById('addLevelModal').classList.add('hidden')"
                            class="px-4 py-2 text-white hover:bg-white/10 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-[#5fbbd1] hover:bg-[#4a9bb1] text-white px-4 py-2 rounded">
                        Add Level
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Level Modal -->
<div id="editLevelModal" class="fixed inset-0 bg-black/50 hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-[#1a3f5c] rounded-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-white mb-4">Edit Level</h3>
            <form id="editLevelForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-white mb-2">Level Number</label>
                        <input type="number" name="level" id="editLevelNumber" required min="1" 
                               class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
                    </div>
                    <div>
                        <label class="block text-white mb-2">XP Required for Next Level</label>
                        <input type="number" name="next_level_experience" id="editXpRequired" required min="0" 
                               class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="document.getElementById('editLevelModal').classList.add('hidden')"
                            class="px-4 py-2 text-white hover:bg-white/10 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-[#5fbbd1] hover:bg-[#4a9bb1] text-white px-4 py-2 rounded">
                        Update Level
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(id, level, xp) {
    document.getElementById('editLevelForm').action = `/superadmin/levels/${id}`;
    document.getElementById('editLevelNumber').value = level;
    document.getElementById('editXpRequired').value = xp;
    document.getElementById('editLevelModal').classList.remove('hidden');
}
</script>
@endsection 