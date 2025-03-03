<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Partner Center Update') }}
        </h2>
    </x-slot>
    <div class="py-12">
    <div class="max-w-12xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
               @include('partner.tab')
    <div class="container">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('partner.partnercenter.updatepartnercenter')}}" method="post">
    @csrf
    <table class="table table-striped table-bordered"  style="width:550px">
        <tr>
            <td colspan="2">{{__('Update_Partner_Center_Details')}}</td>
        </tr>
        <tr>
            <td>{{__('center_name')}}</td>
            <td><input type="text" name="center_name" class="form-control" value="{{$data['center_name']}}"/></td>
        </tr>
        <tr>
            <td>{{__('contact_number')}}</td>
            <td><input type="text" name="contact_number" class="form-control" value="{{$data['contact_number']}}"/></td>
        </tr>
        <tr>
            <td>{{__('email')}}</td>
            <td><input type="email" name="email" class="form-control" value="{{$data['email']}}"/></td>
        </tr>
        <tr>
            <td>{{__('address')}}</td>
            <td><input type="text" name="address" class="form-control" value="{{$data['address']}}"/></td>
        </tr>
        <tr>
            <td>{{__('district')}}</td>
            <td><input type="text" name="district" class="form-control" value="{{$data['address']}}"/></td>
        </tr>
        <tr>
            <td>{{__('city')}}</td>
            <td><input type="text" name="city" class="form-control" value="{{$data['address']}}"/></td>
        </tr>
        <tr>
            <td>{{__('state')}}</td>
            <td><input type="text" name="state" class="form-control" value="{{$data['address']}}"/></td>
        </tr>
        <tr>
            <td>{{__('status')}}</td>
            <td><select name="status">
                <option value="1">Active</option>
                <option value="2">InActive</option>
            </select></td>
        </tr>
        <tr>
            <td colspan="2">
            <input type="hidden" name="id" class="form-control" value="{{encryptString($data['id'])}}"/>
            <input type="submit" name="submit" class="form-control btn btn-primary" value="Save"/></td>
        </tr>
    </table>
</form>
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


