<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #0d6efd;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333;
        }
        .email-body h2 {
            margin-top: 0;
        }
        .email-body p {
            line-height: 1.6;
        }
        .email-button {
            display: block;
            text-align: center;
            margin: 20px auto;
        }
        .email-button a {
            text-decoration: none;
            background-color: #0d6efd;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .email-footer {
            text-align: center;
            padding: 10px;
            background-color: #f4f4f4;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <!-- Email Header -->
    <div class="email-header">
        <h1>{{config('app.name')}}</h1>
    </div>

    <!-- Email Body -->
    <div class="email-body">
        <h2>Dear Mr/Mrs {{$parentName}}</h2>
        <p>We are thrilled to share some exciting news about your child, [{{$studentName}}]! They recently
            completed the quiz "{{$quizName}}", and we couldn’t be more proud to let you know about their performance.</p>

        📊 Score Details
        <ul>
            <li>
                Quiz Title: [{{$quizName}}]
            </li>
            <li>
                Score Achieved: [{{$score}}]
            </li>
            <li>
                Passing Score: [{{$fullMark / 2}}]
            </li>
        </ul>

        <p>{{$studentName}} has shown great determination and dedication in their learning journey.
            Their efforts truly reflect their potential and eagerness to succeed.</p>
        <p> At [{{config('app.name')}}], we are committed to nurturing students to help them grow academically and personally.</p>

        <h5 class="text-dark">👏 What’s Next?</h5>
        <p>Encourage {{$studentName}} to keep up the great work! Together, we can continue to unlock their potential.
            If you have any questions or would like to discuss their progress further, feel free to reach out.
        <br>Thank you for being a constant source of motivation for {{$studentName}}. Your support makes all the difference in their educational journey.
        </p>
        <p>
            P.S. Feel free to celebrate this achievement with [{{$studentName}}]—every milestone deserves a moment of pride! 🎉
        </p>
        <div class="email-button">
            <a href="{{ $url }}" target="_blank">View student scores</a>
        </div>
        <p>Warm regards,<br>{{config('app.name')}}</p>
    </div>

    <!-- Email Footer -->
    <div class="email-footer">
        <p>If you're having trouble clicking the "View student scores" button, copy and paste the URL below into your web browser:</p>
        <p><a href="{{ $url }}" target="_blank">{{ $url }}</a></p>
    </div>
</div>
</body>
</html>
