@include('headers.cpanel')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                @yield('page_header')
            </div>
            
            @yield('page_content')
    </section>
@include('footers.cpanel')
