<x-navbar />

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Connection</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .social-card {
            width: 100%;
            max-width: 320px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
        }
        
        .card-top {
            height: 80px;
            background: linear-gradient(135deg, #1877f2 0%, #166fe5 100%);
        }
        
        .card-content {
            padding: 60px 25px 25px;
            text-align: center;
            position: relative;
            margin-top: -40px; /* Pulls content up */
        }
        
        .social-icon {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 3px solid white;
        }
        
        .social-icon i {
            font-size: 24px;
            color: #1877f2;
        }
        
        h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }
        
        p {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #1877f2;
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px rgba(24, 119, 242, 0.2);
        }
        
        .btn:hover {
            background: #166fe5;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(24, 119, 242, 0.3);
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .social-stats {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 24px;
        }
        
        .stat {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .stat-number {
            font-weight: 700;
            color: #1e293b;
            font-size: 1rem;
        }
        
        .stat-label {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 2px;
        }
        
        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 20px 0;
        }
        
        .no-link {
            background: #f1f5f9;
            color: #64748b;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
        }
        
        .no-link i {
            margin-right: 6px;
        }
    </style>
</head>
<body>
    <div class="social-card">
        <div class="card-top"></div>
        
        <div class="card-content">
            <div class="social-icon">
                @if(!empty($data['icon']))
                    <i class="{{ $data['icon'] }}"></i>
                @else
                    <i class="fab fa-facebook-f"></i>
                @endif
            </div>
            
            <h3>Join Our Facebook Community</h3>
            <p>Connect with us for exclusive updates and offers</p>
            
            @if(!empty($data['link']))
                <a href="{{ $data['link'] }}" class="btn" target="_blank" rel="noopener">
                    <i class="fab fa-facebook-f"></i> Follow Page
                </a>
            @else
                <div class="no-link">
                    <i class="fas fa-unlink"></i> Link not available
                </div>
            @endif
            
            <div class="divider"></div>
            
            
        </div>
    </div>
</body>
</html>