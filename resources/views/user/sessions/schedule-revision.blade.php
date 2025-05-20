@extends('layouts.app')

@section('content')

<br><br>

<div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-xl">

    <h2 class="text-2xl font-bold mb-6 text-green-700">Partners</h2>

    <!-- Search Bar -->
    <div class="mb-4">
        <input type="text" id="partnerSearch" placeholder="Search partners..."
               class="w-full p-3 border rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"
               onkeyup="filterPartners()">
    </div>

    @if ($partners->count() > 0)
        <ul id="partnerList" class="divide-y divide-gray-200">
            @foreach ($partners as $partner)
                <li class="py-4 flex justify-between items-center partner-item">
                    <div class="flex items-center gap-4">
                        <!-- Avatar -->
                        <img src="{{ $partner->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($partner->name) }}"
                             alt="Avatar" class="w-12 h-12 rounded-full object-cover shadow-md">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $partner->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $partner->email }}</p>
                            @if ($partner->country)
                                <p class="text-xs text-gray-400">🌍 {{ $partner->country }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="text-right">
                        <a href="{{ route('calendar.index', ['partner_id' => $partner->id]) }}"
                           class="text-sm text-blue-600 hover:text-blue-800 underline block mb-2">
                            View Sessions
                        </a>

                        <!-- Trigger Modal -->
                        <button type="button"
                            onclick="openModal({{ $partner->id }})"
                            class="bg-green-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            Send Revision Request
                        </button>
                    </div>
                </li>

                <!-- Modal -->
                <div id="modal-{{ $partner->id }}" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Send Revision Request to {{ $partner->name }}</h3>

                        <form action="{{ route('sessions.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                            <input type="hidden" name="partner_name" value="{{ $partner->name }}">
                            

                            <div>
                                <label for="date-{{ $partner->id }}" class="block text-sm font-medium text-gray-700">Select Date</label>
                                <input type="date" id="date-{{ $partner->id }}" name="date" class="w-full mt-1 p-2 border rounded-md" required>
                            </div>

                            <div>
                                <label for="start_time-{{ $partner->id }}" class="block text-sm font-medium text-gray-700">Select Start Time</label>
                                <input type="time" id="start_time-{{ $partner->id }}" name="start_time" class="w-full mt-1 p-2 border rounded-md" required>
                            </div>

                            <div>
                                <label for="end_time-{{ $partner->id }}" class="block text-sm font-medium text-gray-700">Select End Time</label>
                                <input type="time" id="end_time{{ $partner->id }}" name="end_time" class="w-full mt-1 p-2 border rounded-md" required>
                            </div>

                            <div class="flex justify-between mt-4">
                                <button type="button" onclick="closeModal({{ $partner->id }})"
                                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                    Send Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">You don’t have any accepted partners yet.</p>
    @endif
</div>

<!-- Modal Script + Search -->
<script>
    function openModal(partnerId) {
        document.getElementById(`modal-${partnerId}`).classList.remove('hidden');
    }

    function closeModal(partnerId) {
        document.getElementById(`modal-${partnerId}`).classList.add('hidden');
    }

    function filterPartners() {
        const input = document.getElementById('partnerSearch').value.toLowerCase();
        const items = document.querySelectorAll('.partner-item');
        items.forEach(item => {
            const text = item.innerText.toLowerCase();
            item.style.display = text.includes(input) ? '' : 'none';
        });
    }
</script>
@endsection
