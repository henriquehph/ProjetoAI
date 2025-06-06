<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catálogo</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            
            padding: 8px;
            text-align: left;
        }
        body {
            font-family: Arial, sans-serif;
            
            margin: 0;
            display: flex;
            padding: 0;
            color:white;
            background-color: #111827;
        }
        body>nav {
            height: 100%;;
            background-color: lightgray;
            margin-right: 20px;
        }
        body>nav ul {
            list-style-type: none;
            padding-left: 15px;
            margin-bottom: 10px;
        }
        body>nav li {
        margin-bottom: 10px;
        }   
        </style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav>
        <ul>
            <li>
                <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>
            </li>
            <li>
                <a
                            href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Register
                        </a>
            </li>
        </ul>
    </nav>
    <div class="main">
        <header>
            <h1>@yield('header-title')</h1>
        </header>
        <div class="content">
            @yield('main') gets put here
        </div>
    </div>
    
</body>
</html>