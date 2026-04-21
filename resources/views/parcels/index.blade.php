<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Parcels</h1>

        @if(in_array(auth()->user()->role, ['admin', 'customer']))
            <a href="{{ route('parcels.create') }}" class="text-white text-black px-4 py-2 rounded inlline-block mb-4" style="background-color: #374151;">
                Create Parcel
            </a>
        @endif

        <div class="mt-6">
            @forelse ($parcels as $parcel)
                <div class="border p-3 mb-2 rounded">
                    <strong>
                        <a href="{{ route('parcels.show', $parcel) }}" class="text-blue-600 underline">
                            {{ $parcel->tracking_number }}
                        </a>
                    </strong>
                    <br>
                    {{ $parcel->sender_name }} → {{ $parcel->recipient_name }}
                    <br>
                    Status: {{ $parcel->status }}

                    @if(in_array(auth()->user()->role, ['admin', 'courier']))
                        <a href="{{ route('parcels.edit', $parcel) }}" class=" text-white px-3 py-1 rounded text-sm ml-2 inline-block" style="background-color: #374151;">Update Status</a>
                    @endif

                    @if(auth()->user()->role === 'admin') <br>
                    <form action="{{ route('parcels.destroy', $parcel) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm ml-2 inline-block" onclick="return confirm('Are you sure you want to delete this parcel?');">Delete Parcel</button>
                    </form>
                @endif
            </div>      
@empty  
    <p>No parcels found.</p>
@endforelse
        </div>
    </div>
</x-app-layout>