<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancelled - Grand Regency</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #121212;
            --card-bg: #1e1e1e;
            --text-main: #f5f5f5;
            --text-muted: #a0a0a0;
            --danger: #ef4444;
            --border: #333;
        }
        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .status-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            border: 1px solid var(--border);
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .icon-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
            margin: 0 auto 24px auto;
        }
        .title {
            font-size: 24px;
            font-weight: 600;
            margin: 0 0 12px 0;
        }
        .message {
            color: var(--text-muted);
            font-size: 15px;
            line-height: 1.5;
            margin: 0 0 30px 0;
        }
        .btn {
            display: inline-block;
            width: 100%;
            padding: 14px;
            box-sizing: border-box;
            background: var(--card-bg);
            border: 1px solid var(--border);
            color: var(--text-main);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: background 0.2s ease, transform 0.1s ease;
        }
        .btn:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        .btn:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="status-card">
        <div class="icon-wrapper">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <h2 class="title">Payment Cancelled</h2>
        <p class="message">Your transaction was not completed. You can safely try again when you are ready.</p>
        <a href="{{ route('stripe.checkout') }}" class="btn">Try Again</a>
    </div>
</body>
</html>
