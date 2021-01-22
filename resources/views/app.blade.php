<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
