<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <script src="/js/vue.min.js"></script>
    <script src="/js/axios.min.js"></script>
</head>

<body>

<div id="register">
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="name"><b>Name</b></label>
        <input v-model="userDetails.name" type="text" placeholder="Enter Name" name="name" id="email">

        <label for="email"><b>Email</b></label>
        <input v-model="userDetails.email" type="text" placeholder="Enter Email" name="email" id="email">

        <label for="psw"><b>Password</b></label>
        <input v-model="userDetails.password" type="password" placeholder="Enter Password" name="psw" id="psw">

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input v-model="userDetails.password_confirmation" type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat">
        <hr>

        <button type="submit" @click="register" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="/login">Sign in</a>.</p>
    </div>
</div>

</body>

<script>
    new Vue({
        el: '#register',
        data: () => ({
            userDetails: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            }
        }),
        methods: {

            register(){

                if (this.userDetails.email !== null
                    && this.userDetails.password !== null
                    && this.userDetails.password_confirmation !== null
                    && this.userDetails.name !== null) {

                    axios.post('/user/register', this.userDetails).then((response) => {
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
    .registerbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
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
