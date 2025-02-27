<?php 
    include('master-login.php');
?>
    <main class="form-signin w-100 m-auto">
        <form method="post" enctype="multipart/form-data">
            <h1 class="h3 mb-3 fw-normal">Register Form</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput1"  name="username" placeholder="Jonh Doe">
                <label for="floatingInput1">User Name</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="my-2">
                <label for="floatingPassword">Profile</label>
                <input type="file" name="profile" id="" class="form-control">
            </div>
            <button class="btn btn-primary w-100 py-2" name="btn-register" type="submit">Register</button>
            <a href="login.php">Already have an account?</a>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2024</p>
        </form>
    </main>

</body>

<script src="assets/libs/jquery/dist/jquery.min.js"></script>
</html>