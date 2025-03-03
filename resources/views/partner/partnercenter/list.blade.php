<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Partner Center') }}
        </h2>
    </x-slot>
    <div class="py-12">
    <div class="max-w-12xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
               @include('partner.tab')
    <div class="container">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Onboard On</th>
                <th>Ys Associated</th>
                <th>Other</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach ($data['data'] as $item)
            
            <tr>
                <td>{{$count}}</td>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['center_name'] }}</td>
                <td>{{ $item['contact_number'] }}</td>
                <td>{{ $item['email'] }}</td>
               
                <td>{{ $item['onboard_date'] }}</td>
                <td>0</td>
                <td>NA</td>
                <td>
                    <a href="{{route('partner.partnercenter.edit',['id'=>$item['id']])}}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
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


