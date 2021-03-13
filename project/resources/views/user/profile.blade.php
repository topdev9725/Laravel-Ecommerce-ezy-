@extends('layouts.front')
@section('content')      

<section class="user-dashbord">
    <div class="container">
        <div class="row">
            @include('includes.user-dashboard-sidebar')
            <div class="col-lg-8">
                <div class="user-profile-details">
                    <div class="account-info shadow-no-border">
                        <div class="header-area">
                            <h4 class="title">
                                {{ $langg->lang262 }}
                            </h4>
                        </div>
                        <div class="edit-info-area">

                            <div class="body">
                                <div class="edit-info-area-form">
                                    <div class="gocover"
                                        style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                    </div>
                                    <form id="userform" action="{{route('user-profile-update')}}" method="POST"
                                        enctype="multipart/form-data">

                                        {{ csrf_field() }}

                                        @include('includes.admin.form-both')
                                        <div class="upload-img">
                                            @if($user->is_provider == 1)
                                            <div class="img"><img
                                                    src="{{ $user->photo ? asset($user->photo):asset('assets/images/'.$gs->user_image) }}">
                                            </div>
                                            @else
                                            <div class="img"><img
                                                    src="{{ $user->photo ? asset('assets/images/users/'.$user->photo):asset('assets/images/'.$gs->user_image) }}">
                                            </div>
                                            @endif
                                            @if($user->is_provider != 1)
                                            <div class="file-upload-area">
                                                <div class="upload-file">
                                                    <input type="file" name="photo" class="upload">
                                                    <span>{{ $langg->lang263 }}</span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input name="name" type="text" class="input-field"
                                                    placeholder="{{ $langg->lang264 }}" required=""
                                                    value="{{ $user->name }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input name="email" type="email" class="input-field"
                                                    placeholder="{{ $langg->lang265 }}" required=""
                                                    value="{{ $user->email }}" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input name="phone" type="text" class="input-field"
                                                    placeholder="{{ $langg->lang266 }}" required=""
                                                    value="{{ $user->phone }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input name="fax" type="text" class="input-field"
                                                    placeholder="{{ $langg->lang267 }}" value="{{ $user->fax }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="text" class="input-field" name="address" required="" placeholder="{{ $langg->lang270 }}" value="{{ $user->address }}" id="autocomplete1">
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <select class="input-field" name="country" id="country">
                                                    <option value="">{{ $langg->lang157 }}</option>
                                                    @foreach (DB::table('countries')->get() as $data)
                                                        <option value="{{ $data->country_name }}" {{ $user->country == $data->country_name ? 'selected' : '' }}>
                                                            {{ $data->country_name }}
                                                        </option>		
                                                        @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-6">
                                                <input name="state" type="text" class="input-field" id="administrative_area_level_1" 
                                                    placeholder="{{ $langg->lang830 }}" value="{{ $user->state }}">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input name="city" type="text" class="input-field" id="locality"
                                                    placeholder="{{ $langg->lang268 }}" value="{{ $user->city }}">
                                            </div>
                                                <div class="col-lg-6">
                                                    <input name="zip" type="text" class="input-field" id="postal_code" placeholder="{{ $langg->lang269 }}" value="{{ $user->zip }}">
                                                </div>
                                        </div>
                                        <input type="hidden" id="latitude1" name="latitude" value="{{$user->latitude}}"/>
                                        <input type="hidden" id="longitude1" name="longitude" value="{{$user->longitude}}"/>
                                        <div class="form-links">
                                            <button class="submit-btn" type="submit">{{ $langg->lang271 }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

@endsection

@section('scripts') 
<script type="text/javascript">
    var autocomplete1;
    function initAutocomplete1() {            
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.            
        autocomplete1 = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete1'), {types: ['geocode']});

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete1.setFields(['address_component']);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete1.addListener('place_changed', fillInAddress1);    
    }

    function fillInAddress1() {
        getGeoLocate1($('#autocomplete1').val());
        // Get the place details from the autocomplete object.
        var place = autocomplete1.getPlace();

        for (var component in componentForm) {
            if($('#'+component).length>0){
                $('#'+component).val('');
                $('#'+component).prop('disabled', false);
            }
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.  
        var address = '';
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                if($('#'+addressType).length>0)
                    $('#'+addressType).val(val);
                if(addressType == 'street_number' || addressType == 'route') {
                    address += ' ' + val;
                }
            }
        }
        if(address != '' && !isFullAddress) 
            $('#autocomplete1').val(address);
    }

    function getGeoLocate1(address) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( 
            { 'address': address},
            function(results, status) {		            
                if (status === "OK") {
                    if (results[0]) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();	
                        $('#latitude1').val(latitude);
                        $('#longitude1').val(longitude);                    
                    } 
                } else {
                    showError("Geocoder failed due to: " + status);
                }
            }
        );   
    }
    $(document).ready(function(){
        setTimeout(initAutocomplete1, 1000);
        
        if ($(window).width() < 800){
          $('#ezy-header').css('display', 'none');
          $('#ezy-footer').css('display', 'none');
          $('#user-profile-mobile-header').css('display', 'flex');
        }

    })
</script>
@endsection