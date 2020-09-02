<script>
    var urls={
        base_url:"{{ url('/') }}",
        cpanel_url:"{{ url('/cpanel/') }}",
        admin_url:"{{ url('/admin/') }}",
    }
</script>
<script src="{{ asset('public/styles/backEnd') }}/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('public/styles/backEnd') }}/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="{{ asset('public/styles/backEnd') }}/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{ asset('public/styles/backEnd') }}/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="{{ asset('public/styles/backEnd') }}/plugins/bootstrap-notify/bootstrap-notify.js"></script> 
<script src="{{ asset('public/styles/backEnd') }}/plugins/jquery-validation/jquery.validate.js"></script>

<!-- JQuery Steps Plugin Js -->
<script src="{{ asset('public/styles/backEnd') }}/plugins/jquery-steps/jquery.steps.js"></script>
<!-- Sweet Alert Plugin Js -->
<script src="{{ asset('public/styles/backEnd') }}/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('public/styles/backEnd') }}/plugins/node-waves/waves.js"></script>

<!-- Custom Js -->
<script src="{{ asset('public/styles/backEnd') }}/js/admin.js"></script>
<script src="{{ asset('public/styles/backEnd') }}/js/pages/forms/form-wizard.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Demo Js -->
<script src="{{ asset('public/styles/backEnd') }}/js/demo.js"></script>
<script src="{{ asset('public') }}/js/healper.js"></script>

<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('public/styles/') }}/DataTables/datatables.min.js"></script>

@yield('page_script')
