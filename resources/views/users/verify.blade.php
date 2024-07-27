<!DOCTYPE html>
<html>
<head>
    <title>Verify Subscription</title>
    <!-- Add your CSS here -->
</head>
<body>
    <div class="container">
        <h1>Verify Your Subscription</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="/verify" method="POST">
            @csrf
            <div class="form-group">
                <label for="code">Verification Code:</label>
                <input type="text" name="code" id="code" class="form-control" placeholder="Enter verification code" required>
            </div>
            <button type="submit" class="btn btn-primary">Verify</button>
        </form>
    </div>
</body>
</html>
