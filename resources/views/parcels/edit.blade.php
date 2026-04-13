<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Update Parcel Status </h1>

        <form method="POST" action="{{ route('parcels.update', $parcel) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2">Tracking Number</label>
                <input type="text" value="{{ $parcel->tracking_number }}" class="border p-2 2-full mb-2" disabled>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Status</label>
                <select name="status" class="border p-2 w-full">
                    <option value="Registered" {{ $parcel->status === 'Registered' ? 'selected' : '' }}>Registered</option>
                    <option value="In Transit" {{ $parcel->status === 'In Transit' ? 'selected' : '' }}>In Transit</option>
                    <option value="Out for Delivery" {{ $parcel->status === 'Out for Delivery' ? 'selected' : '' }}>Out for Delivery</option>
                    <option value="Delivered" {{ $parcel->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">
                Update Status
            </button>
        </form>
    </div>
</x-app-layout>