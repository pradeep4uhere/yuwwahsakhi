<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<x-app-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<style>
.text-small {
    font-size: 0.8rem;
}
.text-small-1 {
    font-size: 0.9rem;
}
</style>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Opportunities') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                @include('partner.tab')
                <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card" style="min-height:200px">
                                <div class="card-body">
                                    <table width="100%">
                                    <tr>
                                    <td width="85%">
                                    <a href="{{route('partner.opportunites.details',['id'=>$data['id']])}}"><p class="card-text"><strong>{{ Str::limit(ucwords($data['opportunities_title']), 100) }}</strong></p></a></td>
                                    <td class="mt-10"><p class="text-small-1 pt-1"><i class="bi bi-file"></i>&nbsp;View Specification Document <a href="{{$data['document']}}">
                                        <i class="bi bi-share"></i></a>
                                        </p></td>
                                    </tr>
                                    </table>
                                    <table>  
                                    <tr>
                                    <td><p class="text-small">{{$data['description']}}</p></td>
                                    <td style="background-color:#dedede;padding:5px;">₹ 650</td>
                                    </tr>
                                    <tr>
                                    <td colspan="2">
                                        
                                    </td>
                                    </tr>
                                   
                                    <table class="mt-10" style="margin-top:30px">  
                                    <tr>
                                        <td><p class="text-small-1 pt-1">₹ {{$data['payout_monthly']}}/month</p></td>
                                        <td class="text-end"><p class="text-small-1 pt-1">{{$data['provider_name']}}</p></td>
                                        <td><p class="text-small-1 pt-1"><i class="bi bi-calendar"></i>&nbsp;Start Date: {{$data['start_date']}}</p></td>
                                        <td><p class="text-small-1 pt-1"><i class="bi bi-calendar"></i>&nbsp;End Date: {{$data['end_date']}}</p></td>
                                    <td><p class="text-small-1 pt-1"><i class="bi bi-person"></i>&nbsp;{{$data['number_of_openings']}} Oppenings</p></td>
                                    </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                </div>
                

    <!-- Pagination -->
   

</div>
</div>
</div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


