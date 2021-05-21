@extends("main")

<h1>Register</h1>

<form action="/register" method="post">
    <div class="row mb-3">
        <div class="col-6">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>

        <div class="col-6">
            <label for="first_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div class="mb-3">
        <label for="confirm_password" class="form-label">Repeat password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
    </div>

    <button type="submit" class="w-100 btn btn-primary">Register</button>
</form>