<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error - 403 Forbidden</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Share+Tech+Mono|Montserrat:700");
        @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&display=swap');

        * {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
            box-sizing: border-box;
            color: inherit;
        }

        body {
            background-image: linear-gradient(120deg, #1F2937 0%, #000000 100%);
            height: 100vh;
            overflow: hidden; /* Mencegah scrolling */
        }

        h1 {
            font-size: 45vw;
            text-align: center;
            position: fixed;
            width: 100vw;
            z-index: 1;
            color: #ffffff26;
            text-shadow: 0 0 50px rgba(0, 0, 0, 0.07);
            top: 50%;
            transform: translateY(-50%);
            font-family: "Dosis", sans-serif;
            /* Mencegah interaksi dengan teks */
            /* pointer-events: none; */
        }

        div {
            background: rgba(0, 0, 0, 0);
            width: 70vw;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            margin: 0 auto;
            padding: 30px 30px 10px;
            box-shadow: 0 0 150px -20px rgba(0, 0, 0, 0.5);
            z-index: 3;
            /* Mencegah interaksi dengan teks */
            /* pointer-events: none; */
        }

        p {
            font-family: "Share Tech Mono", monospace;
            color: #f5f5f5;
            margin: 0 0 20px;
            font-size: 17px;
            line-height: 1.2;
        }

        span {
            color: #f0c674;
        }

        i {
            color: #8abeb7;
        }

        div a {
            text-decoration: none;
        }

        b {
            color: #81a2be;
        }

        a.avatar {
            position: fixed;
            bottom: 15px;
            right: -100px;
            animation: slide 0.5s 4.5s forwards;
            display: block;
            z-index: 4;
        }

        a.avatar img {
            border-radius: 100%;
            width: 44px;
            border: 2px solid white;
        }

        @keyframes slide {
            from {
                right: -100px;
                transform: rotate(360deg);
                opacity: 0;
            }
            to {
                right: 15px;
                transform: rotate(0deg);
                opacity: 1;
            }
        }

        /* Mencegah seleksi teks */
        body, div, p, span, i, b {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
</head>
<body>
    <h1>403</h1>
    <div>
        <p>> <span>ERROR CODE</span>: "<i>HTTP 403 Forbidden</i>"</p>
        <p>> <span>ERROR DESCRIPTION</span>: "<i>Access Denied. You Do Not Have The Permission To Access This Page On This Server</i>"</p>
        <p>> <span>ERROR POSSIBLY CAUSED BY</span>: [<b>execute access forbidden, read access forbidden, write access forbidden, ssl required...</b>]</p>
        <p>> <span>SOME PAGES ON THIS SERVER THAT YOU DO HAVE PERMISSION TO ACCESS</span>: [<a href="{{ route('login') }}">Dashboard</a>]</p>
        <p>> <span>HAVE A NICE DAY! :-)</span></p>
        <span>- fey</span>
    </div>

    <a class="avatar" href="https://t.me/feyfry" title="Feyfry" alt="Feyfry" target="_blank">
        <img src="https://i.ibb.co.com/JRxs8nb/Fc-D05m-GPag-MIQhdhu-VR8-Mlx-Wdc-JE9rwbmd1-Xa-LHMRj-MKbos-Iau-MJ5-Yg-O1-SVi-Xkex-Vfl-Lj-Oy6i-Dv1q-LM.jpg" />
    </a>

    <script>
        // Disable right-click
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        // Disable F12, Ctrl+Shift+I, Ctrl+U, and other shortcuts
        document.addEventListener('keydown', function (e) {
            if (
                (e.ctrlKey && e.key === 'u') || // Ctrl + U
                (e.ctrlKey && e.shiftKey && e.key === 'I') || // Ctrl + Shift + I
                (e.ctrlKey && e.shiftKey && e.key === 'J') || // Ctrl + Shift + J
                e.key === 'F12' || // F12
                (e.ctrlKey && e.shiftKey && e.key === 'C') || // Ctrl + Shift + C
                (e.ctrlKey && e.key === 'S') || // Ctrl + S
                (e.ctrlKey && e.key === 'P') // Ctrl + P
            ) {
                e.preventDefault();
            }
        });

        // Simulate typing effect
        document.addEventListener('DOMContentLoaded', function () {
            const str = document.querySelector('div').innerHTML.toString();
            let i = 0;
            document.querySelector('div').innerHTML = "";

            setTimeout(function () {
                const se = setInterval(function () {
                    i++;
                    document.querySelector('div').innerHTML = str.slice(0, i) + "|";
                    if (i === str.length) {
                        clearInterval(se);
                        document.querySelector('div').innerHTML = str;
                    }
                }, 10);
            }, 0);
        });
    </script>
</body>
</html>
