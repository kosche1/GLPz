<div>
    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block text-white mb-2">Title</label>
            <input type="text" wire:model="title" 
                   class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-white mb-2">Description</label>
            <textarea wire:model="description" rows="3"
                      class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white"></textarea>
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-white mb-2">Subject</label>
            <select wire:model="subject_id" 
                    class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
                <option value="">Select Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
            @error('subject_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-white mb-2">Difficulty</label>
            <select wire:model="difficulty" 
                    class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
                <option value="">Select Difficulty</option>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>
            @error('difficulty') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-white mb-2">Experience Points</label>
            <input type="number" wire:model="exp_points" min="0"
                   class="w-full bg-white/10 border border-white/20 rounded px-3 py-2 text-white">
            @error('exp_points') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" 
                class="w-full bg-[#5fbbd1] hover:bg-[#4a9bb1] text-white py-2 px-4 rounded transition-colors">
            Create Activity
        </button>
    </form>
</div> 