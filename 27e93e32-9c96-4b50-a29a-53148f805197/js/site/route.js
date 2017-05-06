/**
 * Created by Tarun on 5/4/2017.
 */

var placeSearch, autocomplete, autocomplete2;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name',
};

// map object initialize function for source point and first drop point
function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('source_point')),
        {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', function(){
        fillInAddress(autocomplete, 'source_point');
    });

    autocomplete2 = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('drop_point_1')),
        {types: ['geocode']});

    autocomplete2.addListener('place_changed', function(){
        fillInAddress(autocomplete2, 'drop_point_1');
    });
}

// fill up address, latitude and longitude into hidden fields
function fillInAddress(selector, id) {
    // Get the place details from the autocomplete object.
    var place = selector.getPlace();
    console.log(place);

    var single_div_selector = document.getElementById(id).parentNode;

    for (var component in componentForm) {
        single_div_selector.getElementsByClassName(component)[0].value = '';
        single_div_selector.getElementsByClassName(component)[0].disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        //console.log(place.geometry.location.lat())
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            single_div_selector.getElementsByClassName(addressType)[0].value = val;
        }
    }

    // latitude and longitude
    single_div_selector.getElementsByClassName('latitude')[0].value = place.geometry.location.lat();
    single_div_selector.getElementsByClassName('longitude')[0].value = place.geometry.location.lng();

    // map selected option
    single_div_selector.getElementsByClassName('mapselected')[0].value = 1
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}


$(document).ready(function() {

    $('.datepicker').datepicker({'format': 'yyyy-mm-dd'});

    // update row number
    $.fn.rowNumUpdate = function() {
        var txt = 'drop_point_'
            i = 1;
        $.each($('.route_single'), function() {
            $(this).find('.drop_point').attr('id', txt+i);
            i++;
        });
    }

    // Add part
    $(document).on('click', '#add_btn', function() {
        var clone_div = $('.route_single:last').clone();
        clone_div.appendTo('#routes_div_parent');
        clone_div.find('.drop_point').val('');
        clone_div.find('.remove_div').show();
        clone_div.find('label').css('visibility', 'hidden');
        $.fn.rowNumUpdate();

        var google_autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById(clone_div.find('input').attr('id'))),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        google_autocomplete.addListener('place_changed', function() {
            fillInAddress(google_autocomplete, clone_div.find('input').attr('id'));
        });
    });

    // Remove part
    $(document).on('click', '.remove_btn', function() {
        var _this = $(this);
        _this.closest('.route_single').fadeOut('slow', function() {
            _this.closest('.route_single').remove();
            $.fn.rowNumUpdate();
        });
    });

    $(document).on('keyup', '#source_point', function() {
        $(this).parent().find('.mapselected').val(0);
    });

    // Form validation
    $.fn.formValidate = function() {
        var error_found = 0;

        // map validation
        $('.map_field').each(function() {
            if ($(this).parent().find('.mapselected').val() == 0 || $(this).val() == '') {
                $(this).val('');
                $(this).after('<span style="color: red">Please specify proper address</span>');
                error_found = 1;
            }
        });

        // date null validation
        if ($.trim($('#date_of_journey').val()) == '') {
            $('#date_of_journey').after('<span style="color: red">This field is required</span>');
        }

        // error found or not checking and return
        if (error_found == 1) {
            return false;
        } else {
            return true;
        }

    }

    // Form submit and save data
    $('#add_route_form').on('submit', function(e) {
        e.preventDefault();

        // declare variables
        var csrftokenname = $('#csrf').attr('data-csrftokenname'),
            csrftokenhash = $('#csrf').attr('data-csrftokenhash'),
            request_data = {},
            temp_arr = [];


        // form validation part
        if (!$.fn.formValidate()) return false;

        // make data to submit data using ajax
        request_data[csrftokenname] = csrftokenhash;
        request_data['date_of_journey'] = $('#date_of_journey').val();
        $('.address_div').each(function() {
            var data = {
                'address': $(this).find('.map_field').val(),
                'latitude': $(this).find('.latitude').val(),
                'longitude': $(this).find('.longitude').val(),
            };
            temp_arr.push(data);
        })
        request_data['data'] = temp_arr;

        // ajax to save data
        $.ajax({type: 'POST', data: request_data})
            .done(function(response){
                if (response == 'success') {
                    location.href = base_url + '' + $('#driver_dir').val() + 'route';
                }
        });

    });

    // ======================================== LISTING ========================================

    // Show success message in routes list page if route is added immediately
    if ($('.success_msg') !== null && $('#addroutesuccess') !== null && $('#addroutesuccess').val() != '') {
        $('.success_msg').fadeIn('2000');
    }

    // load datatable
    if ($('#example') !== null) {
        //$('#example').DataTable();
    }
});
