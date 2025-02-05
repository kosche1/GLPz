@extends('layouts.teacher')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Activities</h1>
        <a href="{{ route('teacher.activities.create') }}" 
           class="bg-[#5fbbd1] hover:bg-[#4a9bb1] text-white px-4 py-2 rounded-lg transition-colors">
            Create Activity
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 text-green-500 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white/10 backdrop-blur-md rounded-lg border border-white/10">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-white/10">
                        <th class="px-6 py-3 text-white">Title</th>
                        <th class="px-6 py-3 text-white">Subject</th>
                        <th class="px-6 py-3 text-white">Difficulty</th>
                        <th class="px-6 py-3 text-white">Points</th>
                        <th class="px-6 py-3 text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                        <tr class="border-b border-white/10 hover:bg-white/5">
                            <td class="px-6 py-4 text-white">{{ $activity->title }}</td>
                            <td class="px-6 py-4 text-white">{{ $activity->subject->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-sm
                                    @if($activity->difficulty === 'easy') bg-green-500/10 text-green-500
                                    @elseif($activity->difficulty === 'medium') bg-yellow-500/10 text-yellow-500
                                    @else bg-red-500/10 text-red-500
                                    @endif">
                                    {{ ucfirst($activity->difficulty) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-[#5fbbd1]">{{ $activity->points }} XP</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-3">
                                    <a href="{{ route('teacher.activities.edit', $activity) }}" 
                                       class="text-white/70 hover:text-white transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('teacher.activities.destroy', $activity) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this activity?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-400 hover:text-red-500 transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-white/70">
                                No activities found. Create your first activity to get started!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $activities->links() }}
    </div>
</div>
@endsection 