@extends('layouts.load')
@section('content')

                        <div class="content-area no-padding">
                            <div class="add-product-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="product-description">
                                            <div class="body-area" id="modalEdit">

                                    <div class="table-responsive show-table">
                                        <table class="table">
                                            <tr>
                                                <th>{{ __("User ID#") }}</th>
                                                <td>{{$withdraw->user->id}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("User Name") }}</th>
                                                <td>
                                                    <a href="{{route('admin-user-show',$withdraw->user->id)}}" target="_blank">{{$withdraw->user->name}}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Withdraw Amount") }}</th>
                                                <td>{{App\Classes\Common::formatPrice($withdraw->amount) }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Withdraw Charge") }}</th>
                                                <td>{{App\Classes\Common::formatPrice($withdraw->fee) }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Withdraw Process Date") }}</th>
                                                <td>{{date('d-M-Y',strtotime($withdraw->created_at))}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Withdraw Status") }}</th>
                                                <td>{{ucfirst($withdraw->status)}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("User Email") }}</th>
                                                <td>{{$withdraw->user->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("User Phone") }}</th>
                                                <td>{{$withdraw->user->phone}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Withdraw Method") }}</th>
                                                <td>{{$withdraw->method}}</td>
                                            </tr>
                                            @if($withdraw->method != "Bank")
                                            <tr>
                                                <th>{{$withdraw->method}} {{ __("Email") }}:</th>
                                                <td>{{$withdraw->acc_email}}</td>
                                            </tr>
                                            @else 
                                            <tr>
                                                <th>{{$withdraw->method}} {{ __("Account") }}:</th>
                                                <td>{{$withdraw->iban}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Account Name") }}:</th>
                                                <td>{{$withdraw->acc_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Country") }}</th>
                                                <td>{{ucfirst(strtolower($withdraw->country))}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Address") }}</th>
                                                <td>{{$withdraw->address}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{$withdraw->method}} {{__("Swift Code")}}:</th>
                                                <td>{{$withdraw->swift}}</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

@endsection