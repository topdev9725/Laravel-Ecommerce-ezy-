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
                                                <th width="50%">{{ __("Customer ID#") }}</th>
                                                <td>{{ $subs->user->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Name") }}</th>
                                                <td>{{ $subs->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Email") }}</th>
                                                <td>{{$subs->user->email}}</td>
                                            </tr>
                                            @if($subs->user->phone != "")
                                            <tr>
                                                <th>{{ __("Phone") }}</th>
                                                <td>{{$subs->user->phone}}</td>
                                            </tr>
                                            @endif

                                            @if($subs->user->fax != "")
                                            <tr>
                                                <th>{{ __("Fax") }}</th>
                                                <td>{{$subs->user->fax}}</td>
                                            </tr>
                                            @endif

                                            @if($subs->user->address != "")
                                            <tr>
                                                <th>{{ __("Address") }}</th>
                                                <td>{{$subs->user->address}}</td>
                                            </tr>
                                            @endif

                                            @if($subs->user->city != "")
                                            <tr>
                                                <th>{{ __("City") }}</th>
                                                <td>{{$subs->user->city}}</td>
                                            </tr>
                                            @endif

                                            @if($subs->user->zip != "")
                                            <tr>
                                                <th>{{ __("Zip") }}</th>
                                                <td>{{$subs->user->zip}}</td>
                                            </tr>
                                            @endif

                                            <tr>
                                                <th>{{ __("Vendor Name") }}</th>
                                                <td>{{$subs->user->owner_name}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Vendor Phone Number") }}</th>
                                                <td>{{$subs->user->shop_number}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Vendor Shop Address") }}</th>
                                                <td>{{$subs->user->shop_address}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Vendor Registration Number") }}</th>
                                                <td>{{$subs->user->reg_number}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Vendor Message") }}</th>
                                                <td>{{$subs->user->shop_message}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Subscription Plan") }}</th>
                                                <td>{{$subs->title}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Currency Symbol") }}</th>
                                                <td>{{$subs->currency}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Cost") }}</th>
                                                <td>{{$subs->price}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Duration") }}</th>
                                                <td>{{$subs->days}} {{ __("Days") }}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Details") }}</th>
                                                <td>{!!$subs->details!!}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Duration") }}</th>
                                                <td>{{$subs->days}} {{ __("Days") }}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Method") }}</th>
                                                <td>{{$subs->method}}</td>
                                            </tr>


                                          @if($subs->method == "Stripe")
                                            <tr>
                                                <th>{{ __("Transaction ID") }}</th>
                                                <td>{{$subs->txnid}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Charge ID") }}</th>
                                                <td>{{$subs->charge_id}}</td>
                                            </tr>
                                            @elseif($subs->method == "Paypal")
                                            <tr>
                                                <th>{{ __("Transaction ID") }}</th>
                                                <td>{{$subs->txnid}}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>{{ __("Purchase Time") }}</th>
                                                <td>{{$subs->created_at->diffForHumans()}}</td>
                                            </tr>

                                        </table>
                                    </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

@endsection