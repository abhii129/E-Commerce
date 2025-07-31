<x-navbar />

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returns & Exchanges</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        slate: { 150: '#e8eef4' },
                        primary: '#2563eb',
                        secondary: '#7c3aed',
                        accent: '#059669',
                        danger: '#dc2626'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .policy-content {
            color: #334155;
            line-height: 1.6;
        }
        .policy-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .policy-content h4 {
            font-size: 1.1rem;
            font-weight: 500;
            color: #1e293b;
            margin-top: 1.25rem;
            margin-bottom: 0.5rem;
        }
        .policy-content p {
            margin-bottom: 1rem;
        }
        .policy-content ul, 
        .policy-content ol {
            margin-bottom: 1rem;
            padding-left: 1.5rem;
        }
        .policy-content ul {
            list-style-type: disc;
        }
        .policy-content ol {
            list-style-type: decimal;
        }
        .policy-content li {
            margin-bottom: 0.5rem;
        }
        .policy-content a {
            color: #2563eb;
            text-decoration: underline;
        }
        .policy-content a:hover {
            color: #1d4ed8;
        }
        .timeline-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 1.5rem;
        }
        .timeline-item:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0.25rem;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background-color: #2563eb;
            border: 3px solid #bfdbfe;
        }
        .timeline-item:after {
            content: "";
            position: absolute;
            left: 0.45rem;
            top: 1.25rem;
            width: 2px;
            height: calc(100% - 1rem);
            background-color: #bfdbfe;
        }
        .timeline-item:last-child:after {
            display: none;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-4xl w-full bg-white rounded-lg shadow-sm p-8 border border-slate-100">
        <!-- Header with consistent styling -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-12 h-0.5 bg-primary mr-3"></div>
                <span class="text-primary text-sm font-medium">RETURN POLICY</span>
                <div class="w-12 h-0.5 bg-primary ml-3"></div>
            </div>
            <h2 class="text-3xl font-semibold text-slate-800 mb-2">
                {{ $data['title'] ?? 'Returns & Exchanges' }}
            </h2>
            <p class="text-slate-500 max-w-md mx-auto">Our hassle-free return and exchange process</p>
        </div>

        <!-- Policy Content -->
        <div class="policy-content">
            @if(!empty($data['content']))
                {!! nl2br(e($data['content'])) !!}
            @else
                <div class="text-center py-8 border border-slate-100 rounded-lg">
                    <i class="fas fa-exchange-alt text-3xl text-slate-300 mb-3"></i>
                    <p class="text-slate-400">Returns & exchanges information is currently not available.</p>
                    <a href="/contact" class="inline-flex items-center mt-4 text-sm text-primary hover:text-blue-700">
                        <i class="fas fa-chevron-right mr-1 text-xs"></i> Contact us for details
                    </a>
                </div>
            @endif
        </div>

        <!-- Process Timeline (added value) -->
        <div class="mt-10">
            <h3 class="text-xl font-semibold text-slate-800 mb-6 flex items-center">
                <span class="bg-primary/10 p-2 rounded-full mr-3">
                    <i class="fas fa-list-ol text-primary text-sm"></i>
                </span>
                Our Simple Process
            </h3>
            
            <div class="timeline-container pl-4">
                <div class="timeline-item">
                    <h4 class="font-medium text-slate-800">1. Initiate Return</h4>
                    <p class="text-slate-600">Request return within 30 days of delivery through your account.</p>
                </div>
                <div class="timeline-item">
                    <h4 class="font-medium text-slate-800">2. Package Items</h4>
                    <p class="text-slate-600">Securely pack items with original packaging and tags attached.</p>
                </div>
                <div class="timeline-item">
                    <h4 class="font-medium text-slate-800">3. Ship Back</h4>
                    <p class="text-slate-600">Use provided return label or ship to our return center.</p>
                </div>
                <div class="timeline-item">
                    <h4 class="font-medium text-slate-800">4. Receive Refund</h4>
                    <p class="text-slate-600">Refund processed within 5 business days of receipt.</p>
                </div>
            </div>
        </div>

        <!-- Important Notice -->
        <div class="mt-10 bg-red-50 border border-red-100 rounded-lg p-5">
            <div class="flex items-start">
                <div class="bg-danger/10 p-2 rounded-full mr-4 text-danger">
                    <i class="fas fa-exclamation-circle text-lg"></i>
                </div>
                <div>
                    <h3 class="font-medium text-slate-800 mb-2">Important Notice</h3>
                    <p class="text-slate-600">Final sale items cannot be returned or exchanged. Please review your order carefully before purchase.</p>
                </div>
            </div>
        </div>

        <!-- Help Section -->
        <div class="mt-12 pt-8 border-t border-slate-100">
            <div class="bg-slate-50 p-6 rounded-lg">
                <div class="flex items-start">
                    <div class="bg-primary/10 p-3 rounded-full mr-4 text-primary">
                        <i class="fas fa-headset text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-slate-800 mb-2">Need help with returns?</h3>
                        <p class="text-slate-600 mb-3">Our support team is happy to assist with any return or exchange questions.</p>
                        <div class="flex flex-wrap gap-3">
                            <a href="/contact" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-700 transition-colors text-sm">
                                <i class="fas fa-envelope mr-2"></i> Contact Support
                            </a>
                            <a href="/shipping" class="inline-flex items-center px-4 py-2 border border-slate-200 text-slate-700 rounded-md hover:bg-slate-100 transition-colors text-sm">
                                <i class="fas fa-truck mr-2"></i> Shipping Policy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>