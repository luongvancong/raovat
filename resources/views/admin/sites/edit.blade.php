@extends('admin/layouts/master')

@section('styles')
<style>
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
  #map {
    height: 400px;
  }
  .controls {
    margin-top: 10px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  }

  	#pac-input {
		background-color: #fff;
		font-family: Roboto;
		font-size: 15px;
		font-weight: 300;
		margin-left: 12px;
		padding: 0 11px 0 13px;
		text-overflow: ellipsis;
		width: 300px;
		z-index: 1050 !important;
  	}

  	.pac-container {
	    background-color: #FFF;
	    z-index: 20;
	    position: fixed;
	    display: inline-block;
	    float: left;
	}
	.modal{
	    z-index: 20;
	}
	.modal-backdrop{
	    z-index: 10;
	}​

  #pac-input:focus {
    border-color: #4d90fe;
  }

  .pac-container {
    font-family: Roboto;
  }

  #type-selector {
    color: #fff;
    background-color: #4d90fe;
    padding: 5px 11px 0px 11px;
  }

  #type-selector label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }
  #target {
    width: 345px;
  }
</style>
@stop

@section('main-content')
	<h3>Sửa thông tin site</h3>
	<div class="panel-body">

		<div class="pd-bt-20">
			<a href="{{ route('admin.site.branch.create', [$site->getId()]) }}" class="btn btn-sm btn-danger"><i class="fa fa-home"></i> Tạo chi nhánh</a>
		</div>

		<form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">
			<div class="form-group">
				<div class="col-sm-6 col-sm-offset-3">
					<img src="{{ $site->getImage() }}" height="90">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Logo</label>
				<div class="col-sm-6">
					<input type="file" class="form-control" name="logo">
				</div>
			</div>

			<div class="form-group {{ hasValidator('name') }}">
				<label for="email" class="col-sm-3 control-label">Tên <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('name', $site->getName()) }}" name="name">
					{!! alertError('name') !!}
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Tên công ty</label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control input-sm" value="{{ Request::old('alias', $site->alias) }}" name="alias">
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Slug</label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control input-sm" readonly="true" value="{{ Request::old('slug', $site->getSlug()) }}" name="slug">
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Site cha</label>
				<div class="col-sm-6 text-center">
					<select name="parent_id" class="form-control input-sm select2">
						<option value="">Chọn site cha</option>
						@foreach($sites as $st)
						<option value="{{ $st->getId() }}" {{ old('parent_id', $site->parent_id) == $st->getId() ? 'selected' : '' }}>{{ $st->getName() }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Địa chỉ</label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control input-sm" value="{{ Request::old('address', $site->address) }}" name="address">
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Phone</label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control input-sm" value="{{ Request::old('phone', $site->phone) }}" name="phone">
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Fax</label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control input-sm" value="{{ Request::old('fax', $site->fax) }}" name="fax">
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Kinh độ</label>
				<div class="col-sm-6 text-center">
					<div class="input-group">
						<input type="text" class="form-control input-sm" value="{{ Request::old('latitude', $site->latitude) }}" name="latitude">
						<span class="input-group-addon get-lat-long">Lấy tọa độ</span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Vĩ độ</label>
				<div class="col-sm-6 text-center">
					<div class="input-group">
						<input type="text" class="form-control input-sm" value="{{ Request::old('longitude', $site->longitude) }}" name="longitude">
						<span class="input-group-addon get-lat-long">Lấy tọa độ</span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
			   	<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
			   	<a href="{{ route('admin.site.index') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>


	<div id="modal-map" class="modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title">Modal title</h4>
				</div>
				<div class="modal-body">
					<input id="pac-input" class="controls" type="text" placeholder="Search Box">
    				<div id="map"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgw7JoSOV_VqSLZBWP40kHd8la0tRP8EU&libraries=places"></script>
<script>
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
var map = new google.maps.Map(document.getElementById('map'), {
    center: {
        lat: -33.8688,
        lng: 151.2195
    },
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
});

 // Create the search box and link it to the UI element.
var input = document.getElementById('pac-input');
var searchBox = new google.maps.places.SearchBox(input);
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

function initAutocomplete() {

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });

    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {

        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach(function(marker) {
            marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: place.name,
                position: place.geometry.location
            }));

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

            console.log(place.geometry.location.lat())
            console.log(place.geometry.location.lng())

            $('[name="latitude"]').val(place.geometry.location.lat());
            $('[name="longitude"]').val(place.geometry.location.lng());
        });
        map.fitBounds(bounds);
    });
}
</script>

<script>
	$(function() {
		$('.select2').select2();

		$('[name="alias"]').on('keyup', function() {
			var value = $(this).val();
			value = removeAccents(value);
			value = value.replace(/\s/g, '-');
			value = value.toLowerCase();
			$('[name="slug"]').val(value);
		});

		$('.get-lat-long').on('click', function() {
			$('#modal-map').modal({
				show: true,
				backdrop : false
			});
		});

		$('#modal-map').on('shown.bs.modal', function() {
			initAutocomplete();
			google.maps.event.trigger(map, 'resize');
		});
	});
</script>

@stop