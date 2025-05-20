@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
<h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-green-800 mb-8 text-left leading-tight tracking-tight">
    Find Your Perfect Revision Partner ✨
</h2>


    @if($partners->isEmpty())
        <p class="text-center text-gray-500">No partners found at the moment. Try again later!</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($partners as $partner)
                <div class="bg-white rounded-2xl shadow-xl p-6 relative group hover:shadow-green-200 transition-all duration-300">
                    <!-- Profile Image -->
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ $partner->profile_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($partner->name) }}"
                             alt="Profile Image"
                             class="w-14 h-14 rounded-full border-2 border-green-500 shadow-md">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $partner->name }}</h3>
                            <p class="text-sm text-gray-500">
                                {{ $partner->country ?? 'Unknown Country' }}
                            </p>
                        </div>
                    </div>

                    <!-- Partner Info -->
                    <div class="text-sm text-gray-700 space-y-1 mb-4">
                        <p><strong>Memorized Juz:</strong> {{ implode(', ', $partner->memorized_juz) }}</p>
                        <p><strong>Available Days:</strong> {{ implode(', ', $partner->available_days) }}</p>
                        <p><strong>Available Time:</strong> {{ $partner->available_time }}</p>
                    </div>

                    <!-- Send Partner  Request -->
                    <form action="{{ route('sendrequest') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                        <!--<input type="hidden" name="status" value="pending">
                        
                        <label for="date-{{ $partner->id }}" class="block text-sm font-medium text-gray-600 mb-1">Choose Date</label>
                        <input type="date" name="date" id="date-{{ $partner->id }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:ring-green-500 focus:border-green-500 mb-2" required>

                        <label for="time-{{ $partner->id }}" class="block text-sm font-medium text-gray-600 mb-1">Choose Time</label>
                        <input type="time" name="time" id="time-{{ $partner->id }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:ring-green-500 focus:border-green-500 mb-4" required>-->

                        <button type="submit"
                                class="w-full py-2 px-4 bg-gradient-to-r from-green-400 to-green-600 text-white rounded-lg text-sm font-semibold hover:from-green-500 hover:to-green-700 transition duration-200">
                             Request to Become Partners
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
