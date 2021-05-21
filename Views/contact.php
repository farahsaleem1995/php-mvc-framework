@extends("main")

<h1>Contact Us</h1>

<form action="/contact" method="post">
    <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea class="form-control" id="body" name="body"></textarea>
    </div>

    <button type="submit" class="w-100 btn btn-primary">Submit</button>
</form>