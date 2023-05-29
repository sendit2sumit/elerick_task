<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            border: 3px solid #f1f1f1;
        }

        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #04AA6D;
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

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }
        .login_div {
            width: 50%;
        }

        span.psw {
            float: right;
            padding-top: 16px;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>

    <h2>Login Form</h2>
    @if(Session::has('message'))
    <h3 class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</h3>
    @endif
    <div class="container">
        <div class="login_div">
            <form action="{{ route('admin.login.post') }}" method="post">
                @csrf
                <div class="container">
                    <label for="uname"><b>Email</b></label>
                    <input type="email" placeholder="Enter Email" name="email" required>
                    @error('email')
                    <span class="validation">{{ $message }}</span>
                    @enderror
                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required>
                    @error('password')
                    <span class="validation">{{ $message }}</span>
                    @enderror
                    <button type="submit">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
