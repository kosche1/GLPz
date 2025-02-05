@extends('layouts.superadmin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Activity Management</h1>
        <button onclick="Livewire.emit('openActivityModal')" class="bg-[#5fbbd1] hover:bg-[#4a9bb1] text-white px-4 py-2 rounded-lg transition-colors">
            Create Activity
        </button>
    </div>

    <!-- Activity Manager Component -->
    <livewire:activity-manager />
</div>
@endsection 