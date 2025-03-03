<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Promotion') }}
        </h2>
    </x-slot>
    <div class="py-12">
    <div class="max-w-12xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                @include('partner.tab')
                <div class="row">
                    @forelse($data['data'] as $item)
                        <div class="col-md-3 mb-4">
                            <div class="card p-2" style="min-height:280px">
                                <img class="card-img-top" 
                                    src="{{ $item['thumbnail'] ?? asset('images/placeholder.jpg') }}" 
                                    alt="Promotion Image">

                                <div class="card-body">
                                    <p class="card-text">{{ Str::limit($item['promotional_descriptions'], 100) }}</p>
                                </div>

                                <div class="card-footer">
                                    <small class="text-muted">Last updated {{ $item['created_at'] ?? 'N/A' }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center w-100">No promotions found.</p>
                    @endforelse
                </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $data['pagination_links'] ?? '' }}
    </div>

</div>
</div>
</div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


