<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ? $title . ' | ' : '' }}cBye</title>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- https://coolors.co/264653-2a9d8f-e9c46a-f4a261-e76f51 --}}

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    backgroundImage:{
                        login: "url('https://source.unsplash.com/category/stuff')"
                    },
                    colors: {
                        charcoal: {
                            std: "#264653",
                            hov: "#1c343e",
                        },
                        "persian-green": {
                            std: "#2a9d8f",
                            hov: "#1f756b",
                        },
                        "maize-crayola": {
                            std: "#e9c46a",
                            hov: "#dda620"
                        },
                        "sandy-brown": {
                            std: "#f4a261",
                            hov: "#ee7311",
                        },
                        "burnt-sienna": {
                            std: "#e76f51",
                            hov: "#cd3f1c",
                        },
                    }
                }
            }
        }
    </script>
</head>
<body>
    @yield('loginform')
    @yield('registerform')
    @yield('content')

    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</body>
</html>
