@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Welcome and Stats -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800">Welcome <span class="text-green-600">{{ auth()->user()->name }}</span></h1>
            </div>
            <div>
                <button class="bg-green-500 text-white px-4 py-2 rounded-full shadow hover:bg-green-600 transition">Find Student</button>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-md text-gray-500 mb-2">Active Students</h3>
                <div class="text-4xl font-bold text-green-500">5</div>
                <a href="#" class="text-green-600 text-sm mt-2 inline-block">View Details</a>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-md text-gray-500 mb-2">Upcoming Sessions</h3>
                <div class="text-4xl font-bold text-green-400">3</div>
                <a href="#" class="text-green-600 text-sm mt-2 inline-block">View Details</a>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-md text-gray-500 mb-2">Pending Requests</h3>
                <div class="text-4xl font-bold text-yellow-400">-</div>
                <a href="#" class="text-green-600 text-sm mt-2 inline-block">View Details</a>
            </div>
        </div>


    @php
    $sessions = $sessions ?? [];
    $month = $month ?? 'April';
    $monthNumber = $monthNumber ?? now()->month;
    $year = $year ?? 2025;
    $daysInMonth = $daysInMonth ?? 30;
    $firstDay = $firstDay ?? 2;
    $prev = \Carbon\Carbon::create($year, $monthNumber, 1)->subMonth();
    $next = \Carbon\Carbon::create($year, $monthNumber, 1)->addMonth();
    @endphp

<div x-data="{ selectedSession: null }" class="bg-white rounded-2xl shadow-xl p-4 md:p-6 mb-10 w-full">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div class="flex items-center gap-3">
            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $month }} {{ $year }}

            </h2>


 <a href="{{ route('user.dashboard', ['year' => $prev->year, 'month' => $prev->month]) }}"
   class="text-sm bg-gray-100 px-2 py-1 rounded-lg font-medium">⬅️</a>

 <a href="{{ route('user.dashboard', ['year' => $next->year, 'month' => $next->month]) }}"
   class="text-sm bg-gray-100 px-2 py-1 rounded-lg font-medium">➡️</a>

        </div>
        <a href="#" class="text-green-600 hover:text-green-700 text-sm sm:text-base font-semibold underline">
            Manage Availability
        </a>
    </div>

    <!-- Days Header -->
    <div class="grid grid-cols-7 text-xs sm:text-sm text-center mb-3 text-gray-500 font-medium overflow-x-auto sm:overflow-visible whitespace-nowrap">

        @foreach (['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
            <div  class="w-full">{{ $day }}</div>
        @endforeach
    </div>

    <!-- Calendar Grid -->
    <div class="grid grid-cols-4 sm:grid-cols-7 gap-2 sm:gap-4 text-sm">
        @for ($i = 0; $i < $firstDay; $i++)
            <div></div> {{-- Empty for start offset --}}
        @endfor

        @for ($day = 1; $day <= $daysInMonth; $day++)

            <div class="border rounded-xl p-2 h-24 sm:h-28 bg-gray-50 hover:bg-green-50 transition group cursor-pointer flex flex-col justify-between text-[12px] sm:text-sm"
                 @click="selectedSession = {{ json_encode($sessions[$day] ?? []) }}">
                <div class="font-semibold text-gray-700">{{ $day }}</div>
                @if (isset($sessions[$day]))
                    @foreach ($sessions[$day] as $index => $session)
                        @if ($index === 0)
                            <div class="text-[10px] mt-1 px-1 py-[2px] rounded font-medium truncate
                                @if($session['status'] === 'confirmed') bg-green-200 text-green-800
                                @elseif($session['status'] === 'pending') bg-yellow-200 text-yellow-800
                                @else bg-red-200 text-red-800 @endif">
                                @if($session['user_id'] === auth()->user()->id) ✔️
                                {{ $session['name'] }}
                                @else
                                    {{ $session['user_name'] }} 
                                @endif    
                            </div>
                        @endif
                        @if (count($sessions[$day]) > 1 && $index === 0)
                            <div class="text-[10px] text-gray-600 underline">
                                +{{ count($sessions[$day]) - 1 }} more
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        @endfor
    </div>

     <!-- Modal -->
     <div x-show="selectedSession" x-cloak class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center px-4 sm:px-0">
        <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl relative overflow-y-auto max-h-[90vh]">
            <h3 class="text-xl font-semibold mb-4">Session Details</h3>
            <template x-if="selectedSession.length > 0">
                <ul class="space-y-3">
                    <template x-for="session in selectedSession" :key="session.id">
                        <li class="border-b pb-2">
                            <div class="flex justify-between">
                                <span class="font-semibold" x-text="session.name"></span>
                                <span x-text="session.time" class="text-sm text-gray-500"></span>
                            </div>
                            <div class="text-xs mt-1"
                                 :class="{
                                     'text-green-600': session.status === 'confirmed',
                                     'text-yellow-600': session.status === 'pending',
                                     'text-red-600': session.status === 'missed'
                                 }">
                                Status: <span x-text="session.status.charAt(0).toUpperCase() + session.status.slice(1)"></span>
                            </div>
                            <div x-data="sessionComponent({{ auth()->id() }})">
                                <!-- Accept & Decline Buttons for pending sessions -->
                                <div class="mt-2" x-show="session.status === 'pending'">
                                    <div x-show="message" x-transition class="fixed top-4 left-1/2 transform -translate-x-1/2 px-4 py-2 rounded-lg shadow-lg"
                                         :class="messageType === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'">
                                        <span x-text="message"></span>
                                    </div>
                                    <button
                                        x-show="session.partner_id === userId"
                                        @click="acceptSession(session.id)"
                                        class="bg-green-600 text-white text-sm px-3 py-1 rounded hover:bg-green-700">
                                        Accept Session
                                    </button>
                                    <button
                                        x-show="session.partner_id === userId"
                                        @click="declineSession(session.id)"
                                        class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600">
                                        Decline
                                    </button>
                                </div>

                                <!-- Cancel Button for confirmed sessions -->
                                <div class="mt-2" x-show="session.status === 'confirmed'">
                                    <button
                                        @click="cancelSession(session.id)"
                                        class="bg-yellow-500 text-white text-sm px-3 py-1 rounded hover:bg-yellow-600">
                                        Cancel Session
                                    </button>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
            </template>

            <button @click="selectedSession = null"
                    class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-xl font-bold">&times;</button>
        </div>
    </div>
</div>





<!-- Partner Requests Blade View -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left: Progress Overview -->
    <div class="col-span-2">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-5">
            📈 Your Revision Progress Overview
        </h2>
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
            <canvas id="progressChart" class="w-full h-64"></canvas>
            <p class="mt-4 text-center text-gray-500 text-sm">
                Stay consistent and see your revision streaks grow!
            </p>
        </div>
    </div>

    <!-- Right: Partner Requests -->
    <div>
        <h2 class="text-2xl sm:text-3xl font-bold text-green-700 mb-5">
            🤝 Partner Requests
        </h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('user.dashboard') }}" class="mb-4">
            <div class="flex flex-col sm:flex-row items-center gap-2">
                <select name="gender" class="rounded-lg px-3 py-2 border border-gray-300 w-full sm:w-auto">
                    <option value="">All Genders</option>
                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                <select name="subject" class="rounded-lg px-3 py-2 border border-gray-300 w-full sm:w-auto">
                    <option value="">All Subjects</option>
                    <option value="Tajweed" {{ request('subject') == 'Tajweed' ? 'selected' : '' }}>Tajweed</option>
                    <option value="Hifz" {{ request('subject') == 'Hifz' ? 'selected' : '' }}>Hifz</option>
                </select>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                    Filter
                </button>
            </div>
        </form>

        <!-- Partner Request Cards -->
        <div class="bg-gradient-to-br from-green-50 to-white rounded-2xl p-4 shadow-inner space-y-6">
            @forelse ($partnerRequests as $request)
                <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition duration-300 animate-fadeIn">
                    <div class="flex items-center justify-between mb-2">
                        <span class="inline-flex items-center gap-2 text-sm font-semibold text-green-600">
                            📨 Request from {{ $request->user->name }}
                        </span>
                        <span class="text-gray-400 text-xs">
                            {{ $request->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div class="flex items-center gap-4 mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($request->user->name) }}&background=0D8ABC&color=fff"
                             alt="{{ $request->user->name }}"
                             class="w-12 h-12 rounded-full border-2 border-green-400">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">{{ $request->user->name }}</h4>
                            <p class="text-sm text-gray-600 italic">
                                “Looking for a revision partner for {{ $request->subject }}.”
                            </p>
                        </div>
                    </div>

                    <ul class="text-sm text-gray-500 mb-4 space-y-1">
                        <li><strong>Subject:</strong> {{ $request->subject }}</li>
                        <li><strong>Preferred Time:</strong> {{ $request->preferred_time ?? 'Flexible' }}</li>
                        <li><strong>Gender:</strong> {{ ucfirst($request->user->gender) }}</li>
                        <li><strong>Status:</strong>
                            <span class="font-semibold {{ $request->status == 'accepted' ? 'text-green-600' : 'text-yellow-500' }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </li>
                    </ul>

                    @if ($request->status == 'pending')
                        <div class="flex justify-end gap-3">
                            <form method="POST" action="{{ route('partners.accept', $request->id) }}">
                                @csrf
                                <button class="px-4 py-2 bg-green-500 text-white rounded-full text-sm hover:bg-green-600 transition">
                                    ✅ Accept
                                </button>
                            </form>
                            <form method="POST" action="{{ route('partners.decline', $request->id) }}">
                                @csrf
                                <button class="px-4 py-2 bg-red-100 text-red-600 rounded-full text-sm hover:bg-red-200 transition">
                                    ❌ Decline
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-center text-xs text-gray-400 italic">This request has been {{ $request->status }}.</div>
                    @endif
                </div>
            @empty
                <div class="text-center text-gray-500 text-sm py-6">
                    No partner requests found. Check back soon!
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Add Tailwind animation class -->
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 0.5s ease-in-out;
}
</style>



    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('progressChart').getContext('2d');
    const progressChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Remaining'],
            datasets: [{
                data: [70, 30],
                backgroundColor: ['#34D399', '#D1D5DB'],
                borderColor: ['#34D399', '#D1D5DB'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                        }
                    }
                }
            }
        }
    });
</script>

<script>
    function sessionComponent(userId) {
    return {
        selectedSession: [],
        userId: userId,
        message: '', // To store success or error messages
        messageType: '', // To store the type of message ('success' or 'error')

        acceptSession(sessionId) {
            fetch(`/sessions/${sessionId}/accept`, {
                method: 'POST',
                headers: this.headers(),
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    this.message = data.message;
                    this.messageType = 'success';
                    this.updateSessionStatus(sessionId, 'confirmed');
                } else {
                    this.message = data.message;
                    this.messageType = 'error';
                }
                this.clearMessageAfterDelay();
            })
            .catch(() => {
                this.message = 'An unexpected error occurred. Please try again later.';
                this.messageType = 'error';
                this.clearMessageAfterDelay();
            });
        },

        declineSession(sessionId) {
            fetch(`/sessions/${sessionId}/decline`, {
                method: 'POST',
                headers: this.headers(),
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    this.message = data.message;
                    this.messageType = 'success';
                    this.updateSessionStatus(sessionId, 'declined');
                } else {
                    this.message = data.message;
                    this.messageType = 'error';
                }
                this.clearMessageAfterDelay();
            })
            .catch(() => {
                this.message = 'An unexpected error occurred. Please try again later.';
                this.messageType = 'error';
                this.clearMessageAfterDelay();
            });
        },

        cancelSession(sessionId) {
            fetch(`/sessions/${sessionId}/cancel`, {
                method: 'POST',
                headers: this.headers(),
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    this.message = data.message;
                    this.messageType = 'success';
                    this.updateSessionStatus(sessionId, 'cancelled');
                } else {
                    this.message = data.message;
                    this.messageType = 'error';
                }
                this.clearMessageAfterDelay();
            })
            .catch(() => {
                this.message = 'An unexpected error occurred. Please try again later.';
                this.messageType = 'error';
                this.clearMessageAfterDelay();
            });
        },

        updateSessionStatus(sessionId, newStatus) {
            let session = this.selectedSession.find(s => s.id === sessionId);
            if (session) {
                session.status = newStatus; // Update the session status dynamically
            }
        },

        headers() {
            return {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            };
        },

        clearMessageAfterDelay() {
            setTimeout(() => {
                this.message = '';
                this.messageType = '';
            }, 3000); // Clear the message after 3 seconds
        }
    };
}
</script>


@endpush

