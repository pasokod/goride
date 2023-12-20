@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{ trans('lang.airport_plural') }}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('lang.dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('airports') !!}">{{ trans('lang.airports') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ $id == '' ? trans('lang.airport_add') : trans('lang.airport_edit') }}
                </li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card pb-4">

            <div class="card-body">

                <div class="error_top"></div>

                <div class="row restaurant_payout_create">
                    <div class="restaurant_payout_create-inner">
                        <fieldset>
                            <legend>{{ trans('lang.airports_details') }}</legend>

                            
                            <div class="form-group row width-100" id="add_ones_div">
                                <label class="col-3 control-label">{{trans('lang.airport_location')}}</label>
                                <div class="row">
                                    <div class="col-md-12 d-flex">
                                        <div class="col-12">
                                        
                                            <input type="text" class="form-control airport" id="airport" autocomplete="on">
                                            <div class="form-text text-muted">{{ trans("lang.airport_help") }} </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                                <div class="form-group row width-50">
                                    <div class="form-check">
                                        <input type="checkbox" class="service_active" id="active">
                                        <label class="col-3 control-label"
                                            for="active">{{ trans('lang.enable') }}</label>
                                    </div>
                                </div>





                        </fieldset>
                    </div>
                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  save-airport-btn"><i class="fa fa-save"></i>
                        {{ trans('lang.save') }}</button>
                    <a href="{!! route('airports') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel') }}</a>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection
@section('scripts')
<script type="text/javascript">
    var database = firebase.firestore();
    var requestId = "{{$id}}";
    var city = '';
    var id = (requestId == '') ? database.collection("tmp").doc().id : requestId;
    console.log(id);
    $(document).ready(function() {
        $('.airport_menu').addClass('active');

        jQuery("#data-table_processing").show();
        database.collection('airports').where('id', '==', requestId).get().then(function(snapshots) {
            if (snapshots.docs[0].data()) {
                var doc = snapshots.docs[0].data();
                if (doc.enable) {
                    $('.service_active').prop('checked', true);
                }

                $('#airport').val(doc.airportName).attr('lat', doc.airportLat).attr('lng', doc.airportLng).attr('city',doc.cityLocation).attr('state',doc.state).attr('country',doc.country);
                // var count = 0;
                // doc.airports.forEach(data => {
                //     count = count + 1;
                   // $(".add_ons_list").append('<div class="row" style="margin-top:5px;" id="location_list_' + count + '"><div class="col-5"><input class="form-control location_list" type="text" value="' + data.airportName + '" lat="' + data.airportLat + '" lng = "' + data.airportLng + '" disabled></div><div class="col-2"><button class="btn" type="button" onclick="deleteAddOnesSingle(' + count + ')"><span class="fa fa-trash"></span></button></div></div>');
                // });
            }
        });
        jQuery("#data-table_processing").hide();
    });

    function initialize(id) {
       
        var input = document.getElementById(id);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            var placeaddress = autocomplete.getPlace().address_components;
            var city = place.address_components.filter(f => JSON.stringify(f.types) === JSON.stringify(['locality', 'political']))[0].long_name;
            var state = place.address_components.filter(f => JSON.stringify(f.types) === JSON.stringify(['administrative_area_level_1', 'political']))[0].long_name;
            var country = place.address_components.filter(f => JSON.stringify(f.types) === JSON.stringify(['country', 'political']))[0].long_name;

            $("#" + id).val(place.name).attr('lat', place.geometry.location.lat()).attr('lng', place.geometry.location.lng()).attr('city',city).attr('state',state).attr('country',country)
        });
    }

    function deleteAddOnesSingle(id) {
        $('#location_list_' + id).html("");
    }
    $(document).on("click","#airport", function() {
        var id = $(this).attr('id');
        initialize(id);
    });
    $(document).on('click', '.save-airport-btn', function() {
      
            var airportName = $('.airport').val();
            var airportLat = $('.airport').attr('lat');
            var airportLng = $('.airport').attr('lng');
            var cityLocation = $('.airport').attr('city');
            var state = $('.airport').attr('state');
            var country = $('.airport').attr('country');

        $('.error_top').html("");
        if (airportName == "") {
            window.scroll(0, 0);
            $('.error_top').show();
            $('.error_top').html("<p>{{trans('lang.enter_airport_location')}}</p>");
            return false;
        } 
        var enable = false;
        if ($(".service_active").is(':checked')) {
            enable = true;
        }

        jQuery("#data-table_processing").show();
        database.collection('airports').doc(id).set({
            'id': id,
            'cityLocation':cityLocation,
            'country': country,
            'state': state,
            'airportName':airportName,
            'airportLat':airportLat,
            'airportLng':airportLng,
            'enable':enable,
            'date': new Date(),
        }).then(function(response) {
            jQuery("#data-table_processing").hide();
            window.location.href = '{{ url("airports")}}';
        });
    });
</script>
@endsection