<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/general/favicon/apple-icon-60x60.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/general/favicon/apple-icon-72x72.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/general/favicon/apple-icon-76x76.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/general/favicon/apple-icon-114x114.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/general/favicon/apple-icon-120x120.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/general/favicon/apple-icon-144x144.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/general/favicon/apple-icon-152x152.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/general/favicon/apple-icon-180x180.png') }}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/general/favicon/android-icon-192x192.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/general/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/general/favicon/favicon-96x96.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/general/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('images/general/favicon/manifest.json') }}">
<meta name="msapplication-TileColor" content="#3895D3">
<meta name="msapplication-TileImage" content="{{ asset('images/general/favicon/ms-icon-144x144.png') }}">
<meta name="theme-color" content="#3895D3">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        <!--Table Responsive-->
        <style type="text/css">
            .p-datatable-responsive-demo .p-datatable-tbody>tr>td .p-column-title {
                display:none
            }
            @media screen and (max-width:60em){
                .p-datatable.p-datatable-responsive-demo .p-datatable-tfoot>tr>td,
                .p-datatable.p-datatable-responsive-demo .p-datatable-thead>tr>th{
                    display:none!important
                }
                .p-datatable.p-datatable-responsive-demo
                .p-datatable-tbody>tr>td{
                    text-align:left;
                    display:block;
                    width:100%;
                    float:left;
                    clear:left;
                    border:0 none
                }
                .p-datatable.p-datatable-responsive-demo
                .p-datatable-tbody>tr>td
                .p-column-title{
                    padding:.4rem;
                    min-width:30%;
                    display:inline-block;
                    margin:-.4em 1em -.4em -.4rem;
                    font-weight:700
                }
                .p-datatable.p-datatable-responsive-demo
                .p-datatable-tbody>tr>td
                :last-child{
                    border-bottom:1px solid
                    var(--surface-d)
                }
            }</style>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
