<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="">
    <link rel="icon" type="image/png" href="">
    <title>
        @if (Route::is('event.show'))
            @if ($event->meta_title != null)
                {{ $event->meta_title . ' | ' . $event->meta_description }}
            @else    
                {{ $event->title . ' - ' . date('j F, Y (h:s a)', strtotime($event->date_time_start)) . ' | Ticketplatform'}}
            @endif
        @else
            Ticket Platform
        @endif
    </title>
    @if (Route::is('event.show'))    
        @php
            $fecha_inicial = $event->date_time_start ;
            $fecha = DateTime::createFromFormat('Y-m-d H:i', $fecha_inicial);
            $fecha_formateada = $fecha->format('Y-m-d\TH:i');
            $offset = timezone_offset_get($fecha->getTimezone(), $fecha);
            $fecha_final_start = $fecha_formateada . sprintf('%+03d:%02d', $offset / 3600, abs($offset) % 3600 / 60);

            $fecha_inicial = $event->date_time_end ;
            $fecha = DateTime::createFromFormat('Y-m-d H:i', $fecha_inicial);
            $fecha_formateada = $fecha->format('Y-m-d\TH:i');
            $offset = timezone_offset_get($fecha->getTimezone(), $fecha);
            $fecha_final_end = $fecha_formateada . sprintf('%+03d:%02d', $offset / 3600, abs($offset) % 3600 / 60);
        @endphp
        <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "Event",
            "name": "{{ $event->title }}",
            "startDate": "{{ $fecha_final_start }}",
            "endDate": "{{ $fecha_final_end }}",
            "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
            "eventStatus": "https://schema.org/EventScheduled",
            "location": {
                "@type": "Place",
                "name": "{{ $event->ubication }}",
                "address": {
                "@type": "PostalAddress",
                "streetAddress": "{{ $event->street_address }}",
                "addressLocality": "{{ $event->address_locality }}",
                "postalCode": "{{ $event->postal_code }}",
                "addressRegion": "{{ $event->address_region }}",
                "addressCountry": "{{ $event->address_country }}"
                }
            },
            "image": [
                "{{ asset('storage/' .  $event->image) }}"
            ],
            "description": "{{ $event->summary }}",
            "offers": {
                "@type": "Offer",
                "url": "{{ request()->url() }}",
            },
            "performer": {
                "@type": "PerformingGroup",
                "name": "{{ $event->user->username }}"
            },
            "organizer": {
                "@type": "Organization",
                "name": "{{ $event->user->username }}",
                "url": "{{ $event->user->web_url }}"
            }
            }
        </script>
    @endif
    
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <!-- Datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
    
    <style>
        .row {
            --bs-gutter-x: -0.5rem !important; 
        }
        .nav-event {
            box-shadow: none !important;
        }
        .nav-event .col-6 {
            border-bottom: solid 1px rgb(221,221,221);

        }
        .sticky-top {
            padding-top: 15px;
        }
        .about-html {
            padding-top: 20px;
            text-align: justify;
            
        }
        .about-html p {
            font-size: 0.80rem;            
        }
        .tox-tinymce-aux {
            display: none !important;
        }
        #checkout .row {
            --bs-gutter-x: 1.5rem !important; 
        }
        #checkoutMobile .row {
            --bs-gutter-x: 1.5rem !important; 
        }
        #navPhone {
            display: none;
        }
        #successpage .mobile {
            display: none;
        }
        #whenandwhere {
            padding-top: 40px;
        }
        #whPhone{
            display: none;
        }
        #getTicketsBottom {
            display: none; 
        }
        #getTicketsBottom1 {
            display: none; 
        }
        #cardGetTickets {
               display: block; 
        }
        @media only screen and (max-width: 959px) {
            
            #cardGetTickets {
               display: none !important; 
            }
            #getTicketsBottom {
               display: block;
               height: 140px; 
               box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.16);
            }
            #getTicketsBottom1{
               display: block;
               height: 140px; 
               box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.16);
               position: sticky !important;
            }
            #whDesktop {
                display: none;
            }
            #whPhone {
            display: block;
            }
            #navDesktop {
                display: none;
            }
            #navPhone {
                display: block;
            }
            #sucesspage .desktop {
                display: none;
            }
            #sucesspage .mobile {
                display: block;
            }
            
        }
        @media only screen and (max-width: 575px) {
            .locationDiv {
                padding-top: 20px !important;
            }
        }
    </style>
    
</head>

<body class="{{ $class ?? '' }}">

    @guest
        @yield('content')
    @endguest

    @auth
        @if (in_array(request()->route()->getName(), ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'rtl', 'virtual-reality', 'event.show', 'successpage']))
            @yield('content')
        @else
            @if (!in_array(request()->route()->getName(), ['profile', 'profile-static']))
                <div class="min-height-300 bg-primary position-absolute w-100"></div>
            @elseif (in_array(request()->route()->getName(), ['profile-static', 'profile']))
                <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
                    <span class="mask bg-primary opacity-6"></span>
                </div>
            @endif
            @include('layouts.navbars.auth.sidenav')
                <main class="main-content border-radius-lg">
                    @yield('content')
                </main>
            @include('components.fixed-plugin')
        @endif
    @endauth

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Datepicker -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/vfs_fonts.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://unpkg.com/imask"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    @stack('js')
</body>

</html>
