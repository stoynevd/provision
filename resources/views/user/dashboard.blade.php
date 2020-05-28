<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="/js/vue.min.js"></script>
    <script src="/js/axios.min.js"></script>
</head>
<body>
<div id="dashboard">
    <h2>Welcome {{ $name }} !</h2>
    <button type="submit" @click="logout">
        Logout
    </button>
    <br>
    <h2> All to do tasks of {{ $name }}:</h2>

    <table id="t01">
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Time</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        <tr v-for="todo in todos">
            <td>@{{ todo.title }}</td>
            <td>@{{ todo.date }}</td>
            <td>@{{ todo.time }}</td>
            <td>
                <button @click="deleteTask(todo.id)">Delete</button>
            </td>
            <td>
                <button @click="window.location = '/user/tasks/' + todo.id">Edit</button>
            </td>
        </tr>
    </table>
    <br>

    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add a new to do task
    </button>

    <div id="id01" class="modal">

        <div class="modal-content animate">

            <div class="container">
                <label for="uname"><b>Title</b></label>
                <input v-model="newToDo.title" type="text" placeholder="Enter Title" name="uname" required>
                <br><br>
                <label for="birthday">Date</label>
                <input v-model="newToDo.date" type="date">
                <label for="appt">Select a time:</label>
                <input v-model="newToDo.time" type="time" name="appt">
                <br><br>
                <button type="submit" @click="addNewTask">Add new task</button>
            </div>
        </div>
    </div>

</div>
</body>

<script>
    new Vue({
        el: '#dashboard',
        data: () => ({
            todos: {!! $tasks !!},
            newToDo: {
                title: null,
                date: null,
                time: null,
            }
        }),
        methods: {
            logout() {
                axios.get('/logout').then((response) => {
                    window.location = '/login';
                });
            },

            addNewTask() {
                if (this.newToDo.title !== null
                    && this.newToDo.date !== null
                    && this.newToDo.time !== null) {
                    axios.post('/user/addNewTask', this.newToDo).then((response) => {
                        alert(response.data.message);
                        if (response.data.success === true) {
                            document.getElementById('id01').style.display = "none";
                            location.reload();
                        }
                    });
                } else {
                    alert('All fields are required!');
                }
            },

            deleteTask(todo_id) {
                let flag = confirm('Are you sure you want to delete it?');
                if (flag === true) {
                    axios.post('/user/deleteTask', {todo_id: todo_id}).then((response) => {
                        alert(response.data.message);
                        if (response.data.success === true) {
                            location.reload();
                        }
                    });
                }
            },

        }

    });

    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>

<style>
    table {
        width: 100%;
    }

    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    table#t01 tr:nth-child(even) {
        background-color: #eee;
    }

    table#t01 tr:nth-child(odd) {
        background-color: #fff;
    }

    table#t01 th {
        background-color: black;
        color: white;
    }

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
