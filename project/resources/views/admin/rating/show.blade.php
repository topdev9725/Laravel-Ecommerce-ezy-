@extends('layouts.load')
@section('content')
                        <div class="content-area no-padding">
                            <div class="add-product-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="product-description">
                                            <div class="body-area" id="modalEdit">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="table-responsive show-table">
                                                            <table class="table">
                                                                <tr>
                                                                    <th>{{ __('Reviewer') }}</th>
                                                                    <td>{{$data->user->name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>{{ __('Email') }}:</th>
                                                                    <td>{{$data->user->email}}</td>
                                                                </tr>
                                                                @if($data->user->phone != "")
                                                                <tr>
                                                                    <th>{{ __('Phone') }}:</th>
                                                                    <td>{{$data->user->phone}}</td>
                                                                </tr>
                                                                @endif
                                                                <tr>
                                                                    <th>{{ __('Rating') }}:</th>
                                                                    <td>                    
                                                                        <div class="ratings">
                                                                            <div class="empty-stars"></div>
                                                                                <div class="full-stars" style="width:{{App\Models\Rating::ratings($data->product_id)}}%"></div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>{{ __('Reviewed at') }}:</th>
                                                                    <td>{{ date('d-M-Y h:i:s',strtotime($data->review_date))}}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h5 class="review">
                                                        {{ __('Review') }}:
                                                        </h5>
                                                        <p class="review-text"> 
                                                            {{$data->review}}
                                                        </p>
                                                    </div>
                                                </div>
                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

@endsection