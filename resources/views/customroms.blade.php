<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .ag-courses-item_title {
            height: 25px !important;
        }

        /* Add styles for the loader container */
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000 !important;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Add styles for the loader animation */
        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Add additional styles for your page content if needed */
        #content {
            /* Add your content styles */
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $id }}</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 id="device-title" style="color: white;" class="text-center fw-bold"></h5>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($devices as $deviceName => $deviceData)
                        <!-- @if ($deviceData['boolean']) -->
                        <div class="ag-courses_item col-12 col-md-6 col-lg-4 mt-3">
                            <a href="{{ $deviceData['url'] }}" target="_blank" class="ag-courses-item_link">
                                <div class="ag-courses-item_bg"></div>
                                <div class="ag-courses-item_title">
                                    {{ ucfirst($deviceName) }} <!-- Display the device name with the first letter capitalized -->
                                </div>
                            </a>
                        </div>
                        <!-- @endif -->
                        @endforeach


                        <!-- <div class="ag-courses_item col-12 col-md-6 col-lg-4 mt-3">
                            <a href="custom_rom.php?name=redwood" class="ag-courses-item_link">
                                <div class="ag-courses-item_bg"></div>

                                <div class="ag-courses-item_title">
                                    Pixel OS
                                </div>
                            </a>
                        </div>
                        <div class="ag-courses_item col-12 col-md-6 col-lg-4 mt-3">
                            <a href="custom_rom.php?name=redwood" class="ag-courses-item_link">
                                <div class="ag-courses-item_bg"></div>

                                <div class="ag-courses-item_title">
                                    Evolution X
                                </div>
                            </a>
                        </div> -->


                    </div>


                </div>
            </div>

        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Hide the loader once the page is fully loaded
        document.querySelector(".loader-container").style.display = "none";
    });
</script>
<script type="module">
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
    import {
        getAnalytics
    } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-analytics.js";
    import {
        getDatabase,
        ref,
        get
    } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-database.js";

    const firebaseConfig = {
        apiKey: "AIzaSyDOQeAEB4cQUmfN6_xnE6S4M5EKfFPIaho",
        authDomain: "cust-rom.firebaseapp.com",
        projectId: "cust-rom",
        storageBucket: "cust-rom.appspot.com",
        messagingSenderId: "874858109247",
        appId: "1:874858109247:web:9ee07bab57a6d33461db8a",
        databaseURL: "https://cust-rom-default-rtdb.asia-southeast1.firebasedatabase.app"
    };
    const app = initializeApp(firebaseConfig);
    const db = getDatabase();

    function getBlog(devicecode) {
        const dbref = ref(db, 'devices/' + devicecode);
        get(dbref).then((snapshot) => {
            if (snapshot.exists()) {
                const value = snapshot.val();
                $("#device-title").text(value.name + " ( " + devicecode + " )");
                $("title").text(value.name + " ( " + devicecode + " )");

            } else {
                console.log("No data available for the specified blog key");
            }
        }).catch((error) => {
            console.error("Error getting data: ", error);
        });
    }
    getBlog('{{ $id }}');
</script>

</html>