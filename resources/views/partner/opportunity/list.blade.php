<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><x-app-layout>
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
                    @forelse($data['data'] as $item)
                        
                        <div class="col-md-3 mb-4">
                            <div class="card" style="min-height:280px">
                                <div class="card-body">
                                    <table width="100%">
                                    <tr>
                                    <td>
                                    <a href="{{route('partner.opportunites.details',['id'=>$item['id']])}}"><p class="card-text"><strong>{{ Str::limit(ucwords($item['opportunities_title']), 100) }}</strong></p></a></td>
                                    <td>YS Inactive</td>
                                    </tr>
                                    <tr>
                                    <td><p class="text-small">{{ Str::limit($item['description'], 100) }}</p></td>
                                    <td style="background-color:#dedede;padding:5px;">₹ 650</td>
                                    </tr>
                                    <tr>
                                    <td colspan="2">
                                        <p class="text-small-1 pt-1"><i class="bi bi-file"></i>&nbsp;View Specification Document <a href="{{$item['document']}}">
                                        <i class="bi bi-share"></i></a>
                                        </p>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td class="text-end">
                                    <table width="100%">
                                    <tr><td width="40%"><p class="text-small-1 pt-1">₹ {{$item['payout_monthly']}}/month</p></td>
                                    <td width="60%" class="text-end"><p class="text-small-1 pt-1">{{$item['provider_name']}}</p></td>
                                    </tr>
                                    </table>
                                    </tr>
                                    <tr>
                                    <td colspan="2"><p class="text-small-1 pt-1"><i class="bi bi-calendar"></i>&nbsp;Start Date: {{$item['start_date']}}</p></td>
                                    </tr>
                                    <tr>
                                    <td colspan="2"><p class="text-small-1 pt-1"><i class="bi bi-calendar"></i>&nbsp;End Date: {{$item['end_date']}}</p></td>
                                    </tr>
                                    <tr>
                                    <td colspan="2"><p class="text-small-1 pt-1"><i class="bi bi-person"></i>&nbsp;{{$item['number_of_openings']}} Oppenings</p></td>
                                    </tr>
                                   
                                    </table>
                                </div>

                                <div class="card-footer">
                                    <table class="text-muted" width="100%">
                                    <tr>
                                    <td> <p class="text-muted"><strong>#YS Stated Opportunites</strong></p></td>
                                    <td>0</td>
                                    </tr>
                                    <tr>
                                    <td><p class="text-muted"><strong>#Pathways Completed</strong></p></td>
                                    <td>{{count($item['patheway'])}}</td>
                                    </tr>
                                    </table>
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


