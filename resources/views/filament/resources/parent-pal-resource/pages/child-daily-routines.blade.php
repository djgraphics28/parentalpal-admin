<x-filament-panels::page>

    <button
        class="bg-blue-500 text-white px-4 py-2 rounded mb-4"
        wire:click="$set('showCreateModal', true)"
    >
        Add Daily Routine
    </button>

    <table class="w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">Routine Title</th>
                <th class="px-4 py-2">Time of Day</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->childDailyRoutines as $routine)
                <tr>
                    <td class="border px-4 py-2">{{ $routine->routine_title }}</td>
                    <td class="border px-4 py-2">{{ $routine->time_of_day }}</td>
                    <td class="border px-4 py-2">{{ $routine->date }}</td>
                    <td class="border px-4 py-2">
                        <button
                            class="bg-yellow-500 text-white px-2 py-1 rounded"
                            wire:click="editRoutine({{ $routine->id }})"
                        >
                            Edit
                        </button>
                        <button
                            class="bg-red-500 text-white px-2 py-1 rounded"
                            wire:click="deleteRoutine({{ $routine->id }})"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament-panels::page>
