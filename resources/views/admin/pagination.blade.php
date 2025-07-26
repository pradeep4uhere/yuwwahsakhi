@if ($response->lastPage() > 1)
    <div class="pagination text-center py-1 ">
        <table class="mx-auto text-sm text-gray-700">
            <tr class="space-x-4 flex items-center justify-center">
                {{-- Previous Page Link --}}
                <td>
                    @if ($response->onFirstPage())
                        <span class="text-gray-400 px-2"><i class="uil uil-angle-left"></i> Prev</span>
                    @else
                        <a href="{{ $response->previousPageUrl() }}" class="text-blue-600 px-2 hover:text-white">
                            <i class="uil uil-angle-left"></i> Prev
                        </a>
                    @endif
                </td>

                {{-- Page Info --}}
                <td >
                    Page <strong>{{ $response->currentPage() }}</strong> of 
                    <strong>{{ $response->lastPage() }}</strong> |
                    Total: <strong>{{ $response->total() }}</strong>
                </td>

                {{-- Next Page Link --}}
                <td>
                    @if ($response->hasMorePages())
                        <a href="{{ $response->nextPageUrl() }}" class="text-blue-600 px-2 py-1 rounded" style=" hover:text-white hover:bg-blue-600 transition">
                            Next <i class="uil uil-angle-right"></i>
                        </a>
                    @else
                        <span class="text-gray-400 px-2">Next <i class="uil uil-angle-right"></i></span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
@endif