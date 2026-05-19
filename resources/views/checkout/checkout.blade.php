<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Grand Regency</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #121212;
            --card-bg: #1e1e1e;
            --text-main: #f5f5f5;
            --text-muted: #a0a0a0;
            --primary: #6366f1;
            --primary-hover: #4f46e5;
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
        .checkout-container {
            width: 100%;
            max-width: 400px;
        }
        .product-card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            border: 1px solid var(--border);
            transition: transform 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-bottom: 1px solid var(--border);
        }
        .product-details {
            padding: 24px;
        }
        .product-category {
            font-size: 12px;
            text-transform: uppercase;
            color: var(--primary);
            letter-spacing: 1.5px;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }
        .product-title {
            font-size: 22px;
            font-weight: 600;
            margin: 0 0 16px 0;
            line-height: 1.3;
        }
        .product-features {
            list-style: none;
            padding: 0;
            margin: 0 0 24px 0;
            color: var(--text-muted);
            font-size: 14px;
        }
        .product-features li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .product-features li i {
            margin-right: 12px;
            width: 16px;
            text-align: center;
            color: var(--text-main);
        }
        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }
        .price {
            font-size: 28px;
            font-weight: 600;
            color: #fff;
        }
        .currency {
            font-size: 16px;
            vertical-align: top;
            margin-right: 2px;
            color: var(--text-muted);
        }
        .btn-checkout {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.1s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .btn-checkout i {
            margin-right: 8px;
            font-size: 18px;
        }
        .btn-checkout:hover {
            background: var(--primary-hover);
        }
        .btn-checkout:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

    <div class="checkout-container">
        <div class="product-card">
            <!-- Product Image -->
            <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=800&q=80" alt="Luxury Hotel Room" class="product-image">
            
            <div class="product-details">
                <span class="product-category">Premium Stay</span>
                <h2 class="product-title">Deluxe Ocean View Room</h2>
                
                <!-- Booking Details -->
                <ul class="product-features">
                    <li><i class="fa-solid fa-bed"></i> 1 King Size Bed</li>
                    <li><i class="fa-solid fa-calendar-days"></i> 2 Nights</li>
                    <li><i class="fa-solid fa-user"></i> 2 Guests</li>
                </ul>

                <!-- Price -->
                <div class="price-row">
                    <span style="color: var(--text-muted); font-size: 15px;">Total Amount</span>
                    <div class="price"><span class="currency">$</span>250.00</div>
                </div>

                <!-- Stripe Checkout Form -->
                <form action="{{ route('stripe.process') }}" method="POST">
                    @csrf
                    <!-- Hidden inputs to send data to backend -->
                    <input type="hidden" name="product_name" value="Deluxe Ocean View Room">
                    <input type="hidden" name="price" value="250">
                    <input type="hidden" name="quantity" value="1">
                    
                    <button type="submit" class="btn-checkout">
                        <i class="fa-brands fa-stripe"></i> Pay with Stripe
                    </button>
                </form>

                
            </div>
        </div>
    </div>

</body>
</html>
