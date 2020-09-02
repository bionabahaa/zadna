<script>
    var urls={
        base_url:"{{ url('/') }}",
        cpanel_url:"{{ url('/cpanel/') }}",
        admin_url:"{{ url('/admin/') }}",
    }
</script>
  <script src="{{ asset('public/styles/backEnd') }}/dist/jquery/jquery-3.3.1.min.js"></script>
      <script src="{{ asset('public/styles/backEnd') }}/dist/js/popper.js"></script>
      

  <script src="{{ asset('public/styles/backEnd') }}/dist/js/bootstrap4-rtl.js"></script>
        {{-- 
    <!--    <script src="../dist/bootstrap/js/bootstrap.js"></script>--> --}}
    
    {{-- <script defer src="{{ asset('public/styles/backEnd') }}/dist/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl"
        crossorigin="anonymous"></script> --}}
    {{-- <!-- include html files --> --}}
    <script src="{{ asset('public/styles/backEnd') }}/dist/js/include.js"></script>
    <script src="{{ asset('public/styles/backEnd') }}/dist/jquery.dataTables.min.js"></script>
    <script src="{{ asset('public/styles/backEnd') }}/dist/plugins/select2/select2.full.min.js"></script>
    <script>
        includeHTML();
    </script>

    <script src="{{ asset('public/styles/backEnd') }}/dist/sweetalert.min.js"></script>
<script src="{{ asset('public') }}/js/healper.js"></script>

@yield('page_script')
