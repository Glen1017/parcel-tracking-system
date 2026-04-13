<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Parcel Details</h1>
        
        <div class="border p-4 rounded space-y-3">
            <strong>Tracking Number:</strong> {{ $parcel->tracking_number }}<br>
            <strong>Sender Name:</strong> {{ $parcel->sender_name }}<br>
            <strong>Recipient Name:</strong> {{ $parcel->recipient_name }}<br>
            <strong>Address:</strong> {{ $parcel->address }}<br>
            <strong>Return Address:</strong> {{ $parcel->return_address ?? 'Not Provided' }}<br>
            <strong>Status:</strong> {{ $parcel->status }}
            <strong>Created At:</strong> {{ $parcel->created_at->format('Y-m-d H:i') }}<br>
            <strong>Updated At:</strong> {{ $parcel->updated_at->format('Y-m-d H:i') }}
        </div>

        <div class="mt-6 bg-white shadow rounded p-6">
            <h2 class="text-xl font-bold mb-4">Tracking History</h2>

            @forelse ($parcel->deliveryEvents as $event)
            <div class="border-b py-3">
                <strong>Status:</strong> {{ $event->status }}<br>
                <strong>Updated By:</strong> {{ $event->user ? $event->user->name : 'System' }}<br>
                <strong>Time:</strong> {{ $event->created_at->format('Y-m-d H:i') }}
            </div>
            @empty
            <p>No tracking history available.</p>
            @endforelse
        </div>
        <div class="mt-4">
            <a href="{{ route('parcels.index') }}" class="text-blue-600 underline">Back to List</a>
        </div>
    </div>
</x-app-layout>