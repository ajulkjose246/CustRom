<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CustRom</title>
    <!-- <link rel='stylesheet' href='https://rawcdn.githack.com/SochavaAG/example-mycode/master/_common/css/reset.css'> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
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

        .footer-div {
            background-color: #121212;
            border-radius: 20px;
        }

        .footer-text {
            color: white;
            height: 100px;
            font-size: 20px;
            font-weight: 500;
            padding: 35px;
        }

        .button {
            cursor: pointer;
            position: relative;
            padding: 10px 24px;
            font-size: 18px;
            color: rgb(193, 163, 98);
            border: 2px solid rgb(193, 163, 98);
            border-radius: 34px;
            background-color: transparent;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            overflow: hidden;
        }

        .button::before {
            content: '';
            position: absolute;
            inset: 0;
            margin: auto;
            width: 50px;
            height: 50px;
            border-radius: inherit;
            scale: 0;
            z-index: -1;
            background-color: rgb(193, 163, 98);
            transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
        }


        .button:active {
            scale: 1;
        }
    </style>
</head>

<body>
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <div class="container-fluid">
        <center><input type="text" id="deviceName" placeholder="Device Name" class="ag-courses-item_link" style="color: white;width: 50%;"></center>
        <div id="device-data" class="row m-5">
        </div>
        <div class='ag-courses_item col-12 footer-div mb-5  ml-5'>
            <div class="row">
                <div class='footer-text col-12 col-sm-8'>
                    <span>Developed by <a href="https://ajulkjose.in" class="fw-bold" target="_blank">Ajul K Jose</a></span>
                </div>
                <div class='footer-text col-12 col-sm-4'>
                    <a href="https://t.me/+x1LLxRytEko4MzQ1" target="_blank" class="button">
                        Reqest Device
                    </a>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
        get,
        child
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
    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const db = getDatabase();

    let blogno = 1;

    const deviceNameInput = document.getElementById('deviceName');
    deviceNameInput.addEventListener('input', () => {
        const enteredQuery = deviceNameInput.value.trim().toLowerCase();
        filterDevices(enteredQuery);
    });

    function filterDevices(query) {
        // Clear existing device cards
        $("#device-data").empty();

        const dbref = ref(db, 'devices');
        get(dbref).then((snapshot) => {
            if (snapshot.exists()) {
                const blogs = snapshot.val();
                Object.keys(blogs).forEach((key) => {
                    let value = blogs[key];
                    var codename = key.toLowerCase();
                    var devicename = value.name.toLowerCase();

                    // Check if entered query is a substring of the device name or codename
                    if (devicename.includes(query) || codename.includes(query)) {
                        $("#device-data").append("<div class='ag-courses_item col-12 col-md-6 col-lg-4 mt-5'><a href='/" + codename + "' class='ag-courses-item_link'><div class='ag-courses-item_bg'></div><div class='ag-courses-item_title'>" + value.name + "</div><div class='ag-courses-item_date-box'><span class='ag-courses-item_date'>" + codename + "</span></div></a></div>");
                    }
                });
            } else {
                console.log("No data available");
            }
        }).catch((error) => {
            console.error("Error getting data: ", error);
        });
    }

    // Initial loading of all devices
    window.addEventListener("load", filterDevices(''));
</script>

</html>