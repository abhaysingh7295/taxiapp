<?php $__env->startSection('title', 'Dashboard '); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-9">
    <div class="dash-content">
        <div class="row no-margin">
            <div class="col-md-12">
                <h4 class="page-title"><?php echo app('translator')->getFromJson('user.ride.ride_now'); ?></h4>
            </div>
        </div>
        <?php echo $__env->make('common.notify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="row no-margin">
            <div class="col-md-6">
                <form action="<?php echo e(url('confirm/ride')); ?>" method="GET" onkeypress="return disableEnterKey(event);">
                    <div class="input-group dash-form">
                        <input type="text" class="form-control" id="origin-input" name="s_address"  placehold="Local de partida">
                    </div>

                    <div class="input-group dash-form">
                        <input type="text" class="form-control" id="destination-input" name="d_address"  placehold="Local de chegada" >
                    </div>

                    <input type="hidden" name="s_latitude" id="origin_latitude">
                    <input type="hidden" name="s_longitude" id="origin_longitude">
                    <input type="hidden" name="d_latitude" id="destination_latitude">
                    <input type="hidden" name="d_longitude" id="destination_longitude">
                    <input type="hidden" name="current_longitude" id="long">
                    <input type="hidden" name="current_latitude" id="lat">

                    <div class="car-detail"  style="direction: ltr !important;">

                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="car-radio">
                            <input type="radio" 
                                name="service_type"
                                value="<?php echo e($service->id); ?>"
                                id="service_<?php echo e($service->id); ?>"
                                <?php if($loop->first): ?> <?php endif; ?>>
                                
                            <label for="service_<?php echo e($service->id); ?>">
                                <div class="car-radio-inner">
                                    <div class="img"><img src="<?php echo e(image($service->image)); ?>"></div>
                                    <div class="name"><span><?php echo e($service->name); ?><p style="font-size: 10px;">(1-<?php echo e($service->capacity); ?>)</p></span>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div>
                   
                    <div class="input-group dash-form" id="hours" >
                        <input type="number" class="form-control" id="rental_hours" name="rental_hours"  placehold="(Horas de aluguel) Quantas horas?" >
                    </div>
                    <button type="submit"  class="full-primary-btn fare-btn"><?php echo app('translator')->getFromJson('user.ride.ride_now'); ?></button>
             

                </form>
            </div>

            <div class="col-md-6">
                <div class="map-responsive">
                    <div id="map" style="width: 100%; height: 450px;"></div>
                </div> 
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>    
<script type="text/javascript">
    var current_latitude = 13.0574400;
    var current_longitude = 80.2482605;
</script>

<script type="text/javascript">
      $(".drp1").hide();
    $("#drplocat").click(function(){
  $(".drplocat").hide();
  $(".drp1").show()
});


    if( navigator.geolocation ) {
       navigator.geolocation.getCurrentPosition( success, fail );
    } else {
        console.log('Sorry, your browser does not support geolocation services.');
        initMap();
    }

    function success(position)
    {
        document.getElementById('long').value = position.coords.longitude;
        document.getElementById('lat').value = position.coords.latitude

        if(position.coords.longitude != "" && position.coords.latitude != ""){
            current_longitude = position.coords.longitude;
            current_latitude = position.coords.latitude;
        }
        initMap();
    }

    function fail()
    {
        // Could not obtain location
        console.log('unable to get your location');
        initMap();
    }
</script> 

<script type="text/javascript" src="<?php echo e(asset('asset/js/map.js')); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(Config::get('constants.map_key')); ?>&libraries=places&callback=initMap" async defer></script>

<script type="text/javascript">
    function disableEnterKey(e)
    {
        var key;
        if(window.e)
            key = window.e.keyCode; // IE
        else
            key = e.which; // Firefox

        if(key == 13)
            return e.preventDefault();
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#hours").hide();

        $('input[name=service_type]').change(function(){

    var id =     $('input[name=service_type]:checked').val();
    
     $.ajax({url: "<?php echo e(url('hour')); ?>/"+id,dataType: "json",
                   success: function(data){
                    //console.log(data['calculator']);

                       /*if (data['calculator'] == 'DISTANCEHOUR')
                       $("#hours").show();  
                       else
                       $("#hours").hide(); */
                  }});
    });
  }); 

setInterval("checkstatus()",3000); 

function checkstatus(){
    $.ajax({
        url: '/user/incoming',
        dataType: "JSON",
        data:'',
        type: "GET",
        success: function(data){
            if(data.status==1){
                window.location.replace("/dashboard");
            }
        }
    });
}


/*var _registration = null;
function registerServiceWorker() {
  return navigator.serviceWorker.register("<?php echo e(asset('js/service-worker.js')); ?>")
  .then(function(registration) {
    console.log('Service worker successfully registered.');
    _registration = registration;
    return registration;
  })
  .catch(function(err) {
    console.error('Unable to register service worker.', err);
  });
}

function askPermission() {
  return new Promise(function(resolve, reject) {
    const permissionResult = Notification.requestPermission(function(result) {
      resolve(result);
    });

    if (permissionResult) {
      permissionResult.then(resolve, reject);
    }
  })
  .then(function(permissionResult) {
    if (permissionResult !== 'granted') {
      throw new Error('We weren\'t granted permission.');
    }
    else{
      subscribeUserToPush();
    }
  });
}

function urlBase64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}

function getSWRegistration(){
  var promise = new Promise(function(resolve, reject) {
  // do a thing, possibly async, then…

  if (_registration != null) {
    resolve(_registration);
  }
  else {
    reject(Error("It broke"));
  }
  });
  return promise;
}

function subscribeUserToPush() {
  getSWRegistration()
  .then(function(registration) {
    console.log(registration);
    const subscribeOptions = {
      userVisibleOnly: true,
      applicationServerKey: urlBase64ToUint8Array(
        "<?php echo e(env('VAPID_PUBLIC_KEY')); ?>"
      )
    };
    return registration.pushManager.subscribe(subscribeOptions);
  })
  .then(function(pushSubscription) {
    console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));
    sendSubscriptionToBackEnd(pushSubscription);
    return pushSubscription;
  });
}

function sendSubscriptionToBackEnd(subscription) {
    $.ajax({
            url: "/save-subscription/<?php echo e(Auth::user()->id); ?>/user",
            headers: {'Content-Type': 'application/json'},
            type: 'post',
            data: JSON.stringify(subscription),
            success:function(data, textStatus, jqXHR) {
                console.log(data);
            }
        });
}

  askPermission();

  registerServiceWorker();*/

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>