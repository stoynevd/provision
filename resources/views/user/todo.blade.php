<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="/js/vue.min.js"></script>
    <script src="/js/axios.min.js"></script>
</head>
<body>
<div class="container" id="todo">

    <h2>
        To Do Task: {{ $id }}
    </h2>

    <label><b>New Title</b></label>
    <input v-model="newTitle" type="text" placeholder="Enter New Title" name="uname">
    <br><br>
    <label for="birthday">New Date</label>
    <input v-model="newDate" type="date">
    <br><br>
    <label for="appt">New Time:</label>
    <input v-model="newTime" type="time" name="appt">
    <br><br>
    <button @click="updateTask" type="submit">Update Task</button>
    <button @click="window.location='/user/dashboard'" type="submit">Dashboard</button>
</div>

</body>

<script>
    new Vue({
        el: '#todo',
        data: () => ({
            id: {!! $id !!},
            newTitle: '{!! $title !!}',
            newDate: '{!! $date !!}',
            newTime: '{!! $time !!}',
        }),

        mounted: {
        },
        methods: {

            updateTask() {

                axios.post('/user/updateTask', {
                    id: {{ $id }},
                    title: this.newTitle,
                    date: this.newDate,
                    time: this.newTime,
                }).then((response) => {
                    alert(response.data.message);
                    if (response.data.success === true) {
                        window.location='/user/dashboard';
                    }
                });

            }

        }

    });

</script>

<style>

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    /* Set a style for all buttons */
    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {
            -webkit-transform: scale(0)
        }
        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes animatezoom {
        from {
            transform: scale(0)
        }
        to {
            transform: scale(1)
        }
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }

        .cancelbtn {
            width: 100%;
        }
    }
</style>

</html>
