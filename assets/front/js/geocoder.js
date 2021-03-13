var placeSearch, autocomplete;
if(typeof isFullAddress == 'undefined') isFullAddress = false;

var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function initAutocomplete() {    
    if(isInitGeoLocate)
        initGeoLocate();    
    // Create the autocomplete object, restricting the search predictions to
    // geographical location types.    
    if($('#autocomplete').length==0){
        return;
    }
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'), {types: ['geocode']});

    // Avoid paying for data that you don't need by restricting the set of
    // place fields that are returned to just the address components.
    autocomplete.setFields(['address_component']);

    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);    
}

function fillInAddress() {
    getGeoLocate($('#autocomplete').val());
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

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
        $('#autocomplete').val(address);
}

function getGeoLocate(address) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode( 
        { 'address': address},
        function(results, status) {		            
		    if (status === "OK") {
			    if (results[0]) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();	
				    $('#latitude').val(latitude);
                    $('#longitude').val(longitude);                    
			    } 
		    } else {
                showError("Geocoder failed due to: " + status);
		    }
		}
    );   
}

function showError(msg) {
    var alert = $('.alert-danger');
    if(alert.length>0) {
        $('ul', alert).html('').append('<li>'+msg+'</li>');
        alert.show();
    } else {
        alert(msg);
    }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function initGeoLocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
	        var geocoder = new google.maps.Geocoder();	  
	        geocoder.geocode(
		        {
		            location: geolocation
		        },
		        function(results, status) {		                    
		            if (status === "OK") {
			            if (results[0]) {	
                            $('#autocomplete').val(results[0].formatted_address);
                            $('#latitude').val(geolocation.lat);
                            $('#longitude').val(geolocation.lng);
                            if($('#range-value').length>0)
                                setGeolocation($('#range-value').val());
			            } 
		            } else {
                        showError("Geocoder failed due to: " + status);
		            }
		        }
	        );      
        });
    }
}

function setGeolocation(radius, cat_id, which_range) {
    var token = $('input[name=_token]').val();
    if(typeof cat_id == 'undefined') cat_id = -1;
    if(typeof which_range == 'undefined') which_range = -1;
    var data = {
        address: $('#autocomplete').val(),
        latitude: $('#latitude').val(),
        longitude: $('#longitude').val(),
        radius: radius,
        cat_id: cat_id,
        which_range: which_range,
        _token: token
    };
    $.ajax({
        url: mainurl+'/set_geolocation',
        type: 'POST',
        data: data,
        success: function(result){
            if(typeof loadNerbyVendors != 'undefined') {
                setTimeout(() => {
                    loadNerbyVendors(result);
                    // $('#nearby-store').html(result);
                }, 500);
            }
        }
    });    
}

function setGeolocation_autodebit(radius, cat_id) {
    var token = $('input[name=_token]').val();
    if(typeof cat_id == 'undefined') cat_id = -1;
    var data = {
        address: $('#autocomplete').val(),
        latitude: $('#latitude').val(),
        longitude: $('#longitude').val(),
        radius: radius,
        cat_id: cat_id,
        _token: token
    };
    $.ajax({
        url: mainurl+'/set_geolocation_autodebit',
        type: 'POST',
        data: data,
        success: function(result){
            if(typeof loadNerbyAutodebits != 'undefined') {
                setTimeout(() => {
                    loadNerbyAutodebits(result);
                    // $('#nearby-store').html(result);
                }, 500);
            }
        }
    });    
}

$(document).ready(function() {
    $(document).on('keyup', '#autocomplete', function() {
        $('#latitude').val('');
        $('#longitude').val('');
    });

    $(document).on('submit', '#userform', function() {
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        console.log(latitude);
        if(latitude=='' || longitude=='' || latitude=='0' || longitude=='0') {
            showError("Please enter address correctly to get getlocation.<br/>You might not be supported Nearby Service.");
            return false;
        }
        return true;
    });
});