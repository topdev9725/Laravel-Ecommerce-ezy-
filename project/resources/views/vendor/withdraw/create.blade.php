@extends('layouts.vendor')
@section('content')

                        <div class="content-area">
                            <div class="mr-breadcrumb">
                                <div class="row">
                                    <div class="col-lg-12">
                                            <h4 class="heading">{{ $langg->lang479 }} <a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ $langg->lang480 }}</a></h4>
                                            <ul class="links">
                                                <li>
                                                    <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">{{ $langg->lang472 }} </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">{{ $langg->lang479 }}</a>
                                                </li>
                                            </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="add-product-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="product-description">
                                            <div class="body-area" id="modalEdit">

                                          <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                                                    @include('includes.admin.form-both') 
                         <form id="geniusform" class="form-horizontal" action="{{route('vendor-wt-store')}}" method="POST" enctype="multipart/form-data">

                                                    {{ csrf_field() }}


                                <div class="item form-group">
                                    <label class="control-label col-sm-12" for="name"><b>{{ $langg->lang498 }} : {{ App\Models\Product::vendorConvertPrice(Auth::user()->current_balance) }}</b></label>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-sm-4" for="name">{{ $langg->lang481 }} *

                                    </label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="methods" id="withmethod" required>
                                            <option value="">{{ $langg->lang482 }}</option>
                                            <option value="Paypal">{{ $langg->lang483 }}</option>
                                            <option value="Skrill">{{ $langg->lang484 }}</option>
                                            <option value="Payoneer">{{ $langg->lang485 }}</option>
                                            <option value="Bank">{{ $langg->lang486 }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-sm-12" for="name">{{ $langg->lang487 }} *

                                    </label>
                                    <div class="col-sm-12">
                                        <input name="amount" placeholder="{{ $langg->lang487 }}" class="form-control"  type="text" value="{{ old('amount') }}" required>
                                    </div>
                                </div>

                                <div id="paypal" style="display: none;">

                                    <div class="item form-group">
                                        <label class="control-label col-sm-12" for="name">{{ $langg->lang488 }}l *

                                        </label>
                                        <div class="col-sm-12">
                                            <input name="acc_email" placeholder="{{ $langg->lang488 }}" class="form-control" value="{{ old('email') }}" type="email">
                                        </div>
                                    </div>

                                </div>
                                <div id="bank" style="display: none;">

                                    <div class="item form-group">
                                        <label class="control-label col-sm-12" for="name">{{ $langg->lang489 }} *

                                        </label>
                                        <div class="col-sm-12">
                                            <input name="iban" value="{{ old('iban') }}" placeholder="{{ $langg->lang489 }}" class="form-control" type="text">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-sm-12" for="name">{{ $langg->lang490 }} *

                                        </label>
                                        <div class="col-sm-12">
                                            <input name="acc_name" value="{{ old('accname') }}" placeholder="{{ $langg->lang490 }}" class="form-control" type="text">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-sm-12" for="name">{{ $langg->lang491 }} *

                                        </label>
                                        <div class="col-sm-12">
                                            <input name="address" value="{{ old('address') }}" placeholder="{{ $langg->lang491 }}" class="form-control" type="text">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-sm-12" for="name">{{ $langg->lang492 }} *

                                        </label>
                                        <div class="col-sm-12">
                                            <input name="swift" value="{{ old('swift') }}" placeholder="{{ $langg->lang492 }}" class="form-control" type="text">
                                        </div>
                                    </div>

                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-sm-12" for="name">{{ $langg->lang493 }}) *

                                    </label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="reference" rows="6" placeholder="{{ $langg->lang493 }}">{{ old('reference') }}</textarea>
                                    </div>
                                </div>

                                <div id="resp" class="col-md-12">

                                                                            <span class="help-block">
                                <strong>{{ $langg->lang494 }} ${{ $gs->withdraw_fee }} {{ $langg->lang495 }} {{ $gs->withdraw_charge }}% {{ $langg->lang496 }}</strong>
                            </span>
                                                                    </div>

                                            <hr>
                                            <div class="add-product-footer">
                                                <button name="addProduct_btn" type="submit" class="mybtn1">{{ $langg->lang497 }}</button>
                                            </div>
                                        </form>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

@endsection

@section('scripts')
<script type="text/javascript">

    $("#withmethod").change(function(){
        var method = $(this).val();
        if(method == "Bank"){

            $("#bank").show();
            $("#bank").find('input, select').attr('required',true);

            $("#paypal").hide();
            $("#paypal").find('input').attr('required',false);

        }
        if(method != "Bank"){
            $("#bank").hide();
            $("#bank").find('input, select').attr('required',false);

            $("#paypal").show();
            $("#paypal").find('input').attr('required',true);
        }
        if(method == ""){
            $("#bank").hide();
            $("#paypal").hide();
            $("#bank").find('input, select').attr('required',false);
             $("#paypal").find('input').attr('required',false);           
        }

    })

</script>
@endsection