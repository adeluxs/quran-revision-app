@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-3xl font-bold text-center text-green-600 mb-6">Update Profile</h2>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                        <input type="text" id="country" name="country" value="{{ old('country', auth()->user()->country) }}" 
                               class="mt-2 block w-full px-4 py-2 text-sm text-gray-800 border rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" 
                               placeholder="Enter your country" required>
                    </div>

                    <div>
                        <label for="memorized_juz" class="block text-sm font-medium text-gray-700">Memorized Juz</label>
                        <select id="memorized_juz" name="memorized_juz[]" class="mt-2 block w-full px-4 py-2 text-sm text-gray-800 border rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" multiple>
                            @foreach (range(1, 30) as $juz)
                                <option value="{{ $juz }}" {{ in_array($juz, old('memorized_juz', auth()->user()->memorized_juz ?? [])) ? 'selected' : '' }}>
                                    Juz {{ $juz }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="available_days" class="block text-sm font-medium text-gray-700">Available Days</label>
                        <select id="available_days" name="available_days[]" class="mt-2 block w-full px-4 py-2 text-sm text-gray-800 border rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" multiple>
                            <option value="monday" {{ in_array('monday', old('available_days', auth()->user()->available_days ?? [])) ? 'selected' : '' }}>Monday</option>
                            <option value="tuesday" {{ in_array('tuesday', old('available_days', auth()->user()->available_days ?? [])) ? 'selected' : '' }}>Tuesday</option>
                            <option value="wednesday" {{ in_array('wednesday', old('available_days', auth()->user()->available_days ?? [])) ? 'selected' : '' }}>Wednesday</option>
                            <option value="thursday" {{ in_array('thursday', old('available_days', auth()->user()->available_days ?? [])) ? 'selected' : '' }}>Thursday</option>
                            <option value="friday" {{ in_array('friday', old('available_days', auth()->user()->available_days ?? [])) ? 'selected' : '' }}>Friday</option>
                            <option value="saturday" {{ in_array('saturday', old('available_days', auth()->user()->available_days ?? [])) ? 'selected' : '' }}>Saturday</option>
                            <option value="sunday" {{ in_array('sunday', old('available_days', auth()->user()->available_days ?? [])) ? 'selected' : '' }}>Sunday</option>
                        </select>
                    </div>

                    <div>
                        <label for="available_time" class="block text-sm font-medium text-gray-700">Available Time</label>
                        <input type="time" id="available_time" name="available_time" value="{{ old('available_time', auth()->user()->available_time) }}" 
                               class="mt-2 block w-full px-4 py-2 text-sm text-gray-800 border rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" 
                               required>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                    <textarea id="bio" name="bio" rows="4" class="mt-2 block w-full px-4 py-2 text-sm text-gray-800 border rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="Tell us something about yourself...">{{ old('bio', auth()->user()->bio) }}</textarea>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-500 focus:ring-4 focus:ring-green-500 focus:outline-none">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection
