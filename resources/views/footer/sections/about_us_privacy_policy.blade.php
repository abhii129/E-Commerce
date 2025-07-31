<x-navbar />

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#7c3aed',
                        accent: '#059669',
                        dark: '#1e293b',
                        light: '#f8fafc'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            line-height: 1.6;
        }
        
        .policy-content {
            color: #334155;
        }
        
        .policy-content h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            position: relative;
            padding-left: 1.5rem;
        }
        
        .policy-content h2:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0.5rem;
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background-color: #2563eb;
        }
        
        .policy-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
        }
        
        .policy-content p {
            margin-bottom: 1.25rem;
        }
        
        .policy-content ul, 
        .policy-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.75rem;
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
            font-weight: 500;
            text-decoration: underline;
        }
        
        .empty-state-icon {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        .toc-item {
            position: relative;
            padding-left: 1rem;
        }
        
        .toc-item:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0.75rem;
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background-color: #2563eb;
            opacity: 0.5;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="privacy-policy-section max-w-4xl w-full bg-white rounded-lg shadow-sm p-8 border border-slate-100">
        <!-- Header with decorative elements -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-12 h-0.5 bg-primary mr-3"></div>
                <span class="text-primary text-sm font-medium">YOUR PRIVACY</span>
                <div class="w-12 h-0.5 bg-primary ml-3"></div>
            </div>
            <h2 class="text-3xl font-semibold text-slate-800 mb-3">
                {{ $data['title'] ?? 'Privacy Policy' }}
            </h2>
            <p class="text-slate-500 max-w-md mx-auto">Last updated: {{ $data['updated_at'] ?? \Carbon\Carbon::now()->format('F j, Y') }}</p>
        </div>

        <!-- Table of Contents (added value) -->
        <div class="bg-slate-50 rounded-xl p-6 mb-10">
            <h3 class="text-lg font-medium text-slate-800 mb-4 flex items-center">
                <i class="fas fa-list-ul text-primary mr-2"></i>
                Table of Contents
            </h3>
            <div class="grid md:grid-cols-2 gap-3">
                <a href="#information-we-collect" class="toc-item text-slate-600 hover:text-primary">1. Information We Collect</a>
                <a href="#how-we-use-info" class="toc-item text-slate-600 hover:text-primary">2. How We Use Information</a>
                <a href="#cookies" class="toc-item text-slate-600 hover:text-primary">3. Cookies & Tracking</a>
                <a href="#data-security" class="toc-item text-slate-600 hover:text-primary">4. Data Security</a>
                <a href="#your-rights" class="toc-item text-slate-600 hover:text-primary">5. Your Rights</a>
                <a href="#changes" class="toc-item text-slate-600 hover:text-primary">6. Policy Changes</a>
            </div>
        </div>

        <!-- Policy Content -->
        <div class="policy-content">
            @if(!empty($data['content']))
                {!! nl2br(e($data['content'])) !!}
            @else
                <div class="text-center py-12">
                    <div class="empty-state-icon bg-slate-50 inline-flex p-6 rounded-full mb-4">
                        <i class="fas fa-lock text-3xl text-slate-300"></i>
                    </div>
                    <h3 class="text-xl font-medium text-slate-700 mb-2">Privacy Policy Coming Soon</h3>
                    <p class="text-slate-500 mb-4">We're currently updating our privacy policy documentation.</p>
                    <a href="/contact" class="inline-flex items-center text-sm text-primary hover:text-blue-700 font-medium">
                        <i class="fas fa-chevron-right mr-1 text-xs"></i> Contact us for details
                    </a>
                </div>
            @endif
        </div>

        <!-- Contact Information -->
        <div class="mt-14 pt-10 border-t border-slate-100">
            <h3 class="text-xl font-semibold text-slate-800 mb-4 flex items-center">
                <i class="fas fa-question-circle text-primary mr-2"></i>
                Questions About Our Privacy Policy?
            </h3>
            <div class="bg-blue-50 rounded-lg p-6">
                <p class="text-slate-700 mb-4">If you have any questions about our privacy practices or this policy, please contact our Data Protection Officer:</p>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-medium text-slate-800 mb-2"><i class="fas fa-envelope text-primary mr-2"></i> Email</h4>
                        <a href="mailto:privacy@example.com" class="text-primary hover:underline">privacy@example.com</a>
                    </div>
                    <div>
                        <h4 class="font-medium text-slate-800 mb-2"><i class="fas fa-map-marker-alt text-primary mr-2"></i> Mailing Address</h4>
                        <p class="text-slate-600">123 Privacy Lane, Suite 100<br>San Francisco, CA 94107</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Policy Acceptance -->
        <div class="mt-12 text-sm text-slate-500 border-t border-slate-100 pt-6">
            <p>By using our website, you acknowledge that you have read and understood this Privacy Policy.</p>
        </div>
    </div>
</body>
</html>