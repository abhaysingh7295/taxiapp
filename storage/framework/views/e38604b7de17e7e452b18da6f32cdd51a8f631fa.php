<?php $__env->startSection('content'); ?>
<div class="pro-dashboard-head">
    <div class="container">
        <a href="<?php echo e(route('provider.profile.index')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.profile.profile'); ?></a>
        <a href="<?php echo e(route('provider.documents.index')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.profile.manage_documents'); ?></a>
        <a href="<?php echo e(route('provider.location.index')); ?>" class="pro-head-link active"><?php echo app('translator')->getFromJson('provider.profile.update_location'); ?></a>
        <a href="<?php echo e(route('provider.wallet.transation')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.profile.wallet_transaction'); ?></a>
        <?php if(config('constants.card')==1): ?>
            <a href="<?php echo e(route('provider.cards')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.card.list'); ?></a>
        <?php endif; ?>    
        <a href="<?php echo e(route('provider.transfer')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.profile.transfer'); ?></a>
        <?php if(config('constants.referral')==1): ?>
            <a href="<?php echo e(route('provider.referral')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.profile.refer_friend'); ?></a>
        <?php endif; ?>
    </div>
</div>

<div class="pro-dashboard-content gray-bg">
    <div class="container">
        <div class="manage-docs pad30">
            <div class="manage-doc-content">
                <div class="manage-doc-section pad50">
                    <div class="manage-doc-section-head row no-margin">
                        <h3 class="manage-doc-tit">
                            <?php echo app('translator')->getFromJson('provider.profile.update_location'); ?>
                        </h3>
                    </div>

                    <?php echo $__env->make('common.notify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="manage-doc-section-content row">
                        <div class="prof-sub-col col-xs-12">
                            <br/>
                            <div class="form-group">
                                <input tabindex="2" id="pac-input" class="form-control" type="text" placehold="<?php echo app('translator')->getFromJson('provider.enter_location'); ?>" name="s_address">
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div id="map"></div>
                        </div>

                        <form action="<?php echo e(route('provider.location.update')); ?>" id="location_update_form" method="POST" class="form-horizontal row-border">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <input type="hidden" name="address" id="address">

                            <div class="prof-form-sub-sec border-top">
                                <div class="col-xs-12 col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-block btn-primary update-link"> <?php echo app('translator')->getFromJson('provider.profile.update'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    var map;
    var input = document.getElementById('pac-input');
    var s_latitude = document.getElementById('latitude');
    var s_longitude = document.getElementById('longitude');
    var s_address = document.getElementById('address');

    function initMap() {

        var userLocation = new google.maps.LatLng(
                <?php if(Auth::guard('provider')->user()->latitude): ?> <?php echo e(Auth::guard('provider')->user()->latitude); ?> <?php else: ?> 11.8508117 <?php endif; ?>, 
                <?php if(Auth::guard('provider')->user()->longitude): ?> <?php echo e(Auth::guard('provider')->user()->longitude); ?> <?php else: ?> 79.7854668 <?php endif; ?>
            );

        map = new google.maps.Map(document.getElementById('map'), {
            center: userLocation,
            zoom: 15
        });

        var service = new google.maps.places.PlacesService(map);
        var autocomplete = new google.maps.places.Autocomplete(input);
        var infowindow = new google.maps.InfoWindow();

        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow({
            content: '<?php echo app('translator')->getFromJson('provider.your_location'); ?>',
        });

        var marker = new google.maps.Marker({
            map: map,
            draggable: true,
            anchorPoint: new google.maps.Point(0, -29)
        });
        marker.setVisible(true);
        marker.setPosition(userLocation);
        infowindow.open(map, marker);

        google.maps.event.addListener(map, 'click', updateMarker);
        google.maps.event.addListener(marker, 'dragend', updateMarker);

        function updateMarker(event) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'latLng': event.latLng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        input.value = results[0].formatted_address;
                        updateForm(event.latLng.lat(), event.latLng.lng(), results[0].formatted_address);
                    } else {
                        alert('No Address Found');
                    }
                } else {
                    alert('Geocoder failed due to: ' + status);
                }
            });

            marker.setPosition(event.latLng);
            map.setCenter(event.latLng);
        }

        autocomplete.addListener('place_changed', function(event) {
            marker.setVisible(false);
            var place = autocomplete.getPlace();

            if (place.hasOwnProperty('place_id')) {
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }
                updateLocation(place.geometry.location);
            } else {
                service.textSearch({
                    query: place.name
                }, function(results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        updateLocation(results[0].geometry.location, results[0].formatted_address);
                        input.value = results[0].formatted_address;
                    }
                });
            }
        });

        function updateLocation(location) {
            map.setCenter(location);
            marker.setPosition(location);
            marker.setVisible(true);
            infowindow.open(map, marker);
            updateForm(location.lat(), location.lng(), input.value);
        }

        function updateForm(lat, lng, addr) {
            s_latitude.value = lat;
            s_longitude.value = lng;
            s_address.value = addr;
        }
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(Config::get('constants.map_key')); ?>&libraries=places&callback=initMap&language=<?php echo app('translator')->getFromJson('provider.lang'); ?>" async defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style type="text/css">
    #map {
        height: 100%;
        min-height: 400px; 
    }
    
    .controls {
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        margin-bottom: 10px;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 100%;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('provider.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>