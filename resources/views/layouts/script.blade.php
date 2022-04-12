<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/waves.js') }}"></script>
<script src="{{ asset('backend/js/wow.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('backend/assets/chat/moment-2.2.1.js') }}"></script>
<script src="{{ asset('backend/assets/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('backend/assets/jquery-detectmobile/detect.js') }}"></script>
<script src="{{ asset('backend/assets/fastclick/fastclick.js') }}"></script>
<script src="{{ asset('backend/assets/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('backend/assets/jquery-blockui/jquery.blockUI.js') }}"></script>

<!-- sweet alerts -->
<script src="{{ asset('backend/assets/sweet-alert/sweet-alert.min.js') }}"></script>
<script src="{{ asset('backend/assets/sweet-alert/sweet-alert.init.js') }}"></script>

<!-- flot Chart -->
<script src="{{ asset('backend/assets/flot-chart/jquery.flot.js') }}"></script>
<script src="{{ asset('backend/assets/flot-chart/jquery.flot.time.js') }}"></script>
<script src="{{ asset('backend/assets/flot-chart/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('backend/assets/flot-chart/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('backend/assets/flot-chart/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('backend/assets/flot-chart/jquery.flot.selection.js') }}"></script>
<script src="{{ asset('backend/assets/flot-chart/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('backend/assets/flot-chart/jquery.flot.crosshair.js') }}"></script>

<!-- Counter-up -->
<script src="{{ asset('backend/assets/counterup/waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>

<!-- CUSTOM JS -->
<script src="{{ asset('backend/js/jquery.app.js') }}"></script>

<!-- Dashboard -->
<script src="{{ asset('backend/js/jquery.dashboard.js') }}"></script>

<!-- Chat -->
<script src="{{ asset('backend/js/jquery.chat.js') }}"></script>

<!-- Todo -->
<script src="{{ asset('backend/js/jquery.todo.js') }}"></script>

{{-- toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- toastr notification --}}
<script>
    @if (Session::has('T-messege'))
        var type="{{ Session::get('alert-type', 'info') }}"
        switch(type){
        case 'info' :
        toastr.info("{{ Session::get('T-messege') }}");
        break;
        case 'success' :
        toastr.success("{{ Session::get('T-messege') }}");
        break;
        case 'warning' :
        toastr.warning("{{ Session::get('T-messege') }}");
        break;
        case 'error' :
        toastr.error("{{ Session::get('T-messege') }}");
        break;
    
        }
    @endif
</script>


<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
    });
</script>
