<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/ticket.css') }}">
</head>
<body>

<div id="alert-message"></div>

<div class="feedback-container">
    <h2>Обратная связь</h2>
    <form id="feedbackForm" enctype="multipart/form-data">
        <div class="input-box">
            <input type="text" name="name" placeholder="Name">
            <span data-error="name"></span>
        </div>
        <div class="input-box">
            <input type="email" name="email" placeholder="Email">
            <span data-error="email"></span>
        </div>
        <div class="input-box">
            <input type="tel" name="phone" placeholder="Phone">
            <span data-error="phone"></span>
        </div>
        <div class="input-box">
            <input type="text" name="subject" placeholder="Subject">
            <span data-error="subject"></span>
        </div>
        <div class="input-box">
            <textarea name="description" rows="4" placeholder="Description"></textarea>
            <span data-error="description"></span>
        </div>
        <div class="input-box">
            <input type="file" name="files[]" multiple>
            <span data-error="files"></span>
        </div>
        <button type="submit">Send</button>
    </form>
</div>

<script src="{{ asset('assets/scripts/ticket.js') }}"></script>

</body>
</html>
