<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Parcels</h1>

        @if(in_array(auth()->user()->role, ['admin', 'customer']))
            <a href="{{ route('parcels.create') }}" class="bg-blue-600 text-black px-4 py-2 rounded">
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
                        <a href="{{ route('parcels.edit', $parcel) }}" class="text-blue-600 ml-4 underline">Update Status</a>
                    @endif
                </div>
            @empty
                <p>No parcels yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>