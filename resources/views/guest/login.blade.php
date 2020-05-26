<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <script src="/js/vue.min.js"></script>
    <script src="/js/axios.min.js"></script>
</head>

<body>

<div id="login">
    <div class="container">
        <h1>Login</h1>
        <hr>

        <label for="email"><b>Email</b></label>
        <input v-model="userDetails.email" type="text" placeholder="Enter Email" name="email" id="email">

        <label for="psw"><b>Password</b></label>
        <input v-model="userDetails.password" type="password" placeholder="Enter Password" name="psw" id="psw">

        <button type="submit" @click="login" class="loginbtn">Login</button>
    </div>

    <div class="container signin">
        <p>You do not have an account? <a href="/register">Register here</a>.</p>
    </div>
</div>

</body>

<script>
    new Vue({
        el: '#login',
        data() {
            return {
                userDetails: {
                    email: null,
                    password: null
                }
            }
        },
        methods: {

            login(){

                if (this.userDetails.email !== null && this.userDetails.password !== null) {

                    axios.post('/user/login', this.userDetails).then((response) => {
                        if (response.data.success === true) {
                            alert('Welcome!');
                            window.location = '/user/dashboard';
                        }
                    });

                } else {
                    alert('Both fields are required!');
                }

            }

        },
    });
</script>

<style>
    * {box-sizing: border-box}

    /* Add padding to containers */
    .container {
        padding: 16px;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Set a style for the submit/register button */
    .loginbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .loginbtn:hover {
        opacity:1;
    }

    /* Add a blue text color to links */
    a {
        color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        background-color: #f1f1f1;
        text-align: center;
    }
</style>

</html>
