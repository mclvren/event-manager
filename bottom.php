<div class="pt-5 bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="mx-auto text-center">Всего мероприятий в системе: <?php echo $count; ?></h1>
      </div>
    </div>
    <div class="row mt-5">

      <div class="col-12 mx-auto text-center">
        <li class="list-inline-item text-light mb-4">
          <small> © 2018 &nbsp;AIV,&nbsp;
            <a href="https://www.invisionapp.com/" target="_blank" class="text-white">Invision</a>,&nbsp;
            <a href="https://www.creative-tim.com/" target="_blank" class="text-white">Creative Tim</a> and
            <a href="https://www.pingendo.com/" target="_blank" class="text-white">Pingendo</a>. </small>
        </li>
      </div>
      <div> </div>
    </div>
  </div>
</div>
<script src="./vendor/jquery-2.0.3.min.js"></script>
<script src="assets/js/ajax-form.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBpAp9MdFD9IEtJ7cBTA1IBznTp2ZFIgrc" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"></script>
<script src="assets/js/parallax.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<?php if (Auth\User::isAuthorized()): ?>
  <script src="assets/js/profile.js"></script>
<?php endif; ?>
<script>
  $('.idtable').hide();
  $(document).ready(function(){
          $('[data-toggle="popover"]').popover();
          $('[data-toggle="tooltip"]').tooltip();
          $('#datepicker-example').datepicker({
              calendarWeeks: true,
              autoclose: true,
              todayHighlight: true
          });
        });



</script>
<noscript><meta http-equiv="refresh" content="0; url=whatyouwant.html" /></noscript>
