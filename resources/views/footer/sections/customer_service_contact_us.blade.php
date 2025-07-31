<x-navbar />

<br>
<br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
                        accent: '#059669'
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
        .contact-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 3px solid transparent;
        }
        .contact-card:hover {
            transform: translateX(4px);
            border-left-color: var(--hover-color, #2563eb);
            background-color: #f8fafc;
        }
        .icon-container {
            transition: all 0.3s ease;
        }
        .contact-card:hover .icon-container {
            transform: scale(1.1);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full bg-white rounded-lg shadow-sm p-8 border border-slate-100">
        <!-- Header with subtle color accent -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-12 h-0.5 bg-primary mr-3"></div>
                <br>
                <br>
                <br>
                <br>
                <span class="text-primary text-sm font-medium">GET IN TOUCH</span>
                <div class="w-12 h-0.5 bg-primary ml-3"></div>
            </div>
            <h1 class="text-3xl font-semibold text-slate-800 mb-2">How Can We Help?</h1>
            <p class="text-slate-500 max-w-md mx-auto">We're here to help and answer any questions you may have.</p>
        </div>

        <!-- Contact Methods with colored accents -->
        <div class="space-y-6">
            <!-- Location -->
            <div class="contact-card p-6 flex items-start group" style="--hover-color: #2563eb">
                <div class="icon-container mr-5 text-primary bg-blue-50 p-3 rounded-full group-hover:bg-blue-100">
                    <i class="fas fa-map-marker-alt text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-slate-800 mb-1">Our Office</h3>
                    <p class="text-slate-600">{{ $data['location'] ?? '123 Business Avenue, Suite 400' }}</p>
                    <a href="#" class="inline-flex items-center mt-3 text-sm text-primary hover:text-blue-700 transition-colors">
                        Get directions <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Divider with gradient -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-slate-150"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-2 text-sm text-slate-400">or</span>
                </div>
            </div>

            <!-- Phone -->
            <div class="contact-card p-6 flex items-start group" style="--hover-color: #059669">
                <div class="icon-container mr-5 text-accent bg-emerald-50 p-3 rounded-full group-hover:bg-emerald-100">
                    <i class="fas fa-phone-alt text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-slate-800 mb-1">Call Us</h3>
                    <p class="text-slate-600">{{ $data['phone'] ?? '+1 (555) 123-4567' }}</p>
                    <div class="flex space-x-3 mt-3">
                        <a href="#" class="inline-flex items-center text-sm px-4 py-1.5 border border-blue-100 text-primary bg-blue-50 rounded-full hover:bg-blue-100 transition-colors">
                            <i class="fas fa-phone mr-1.5 text-xs"></i> Call now
                        </a>
                        <a href="#" class="inline-flex items-center text-sm px-4 py-1.5 border border-emerald-100 text-accent bg-emerald-50 rounded-full hover:bg-emerald-100 transition-colors">
                            <i class="fab fa-whatsapp mr-1.5 text-xs"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Divider with gradient -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-slate-150"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-2 text-sm text-slate-400">or</span>
                </div>
            </div>

            <!-- Email -->
            <div class="contact-card p-6 flex items-start group" style="--hover-color: #7c3aed">
                <div class="icon-container mr-5 text-secondary bg-purple-50 p-3 rounded-full group-hover:bg-purple-100">
                    <i class="fas fa-envelope text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-slate-800 mb-1">Email Us</h3>
                    <p class="text-slate-600 mb-3">{{ $data['email'] ?? 'hello@company.com' }}</p>
                    <a href="mailto:{{ $data['email'] ?? 'hello@company.com' }}" class="inline-flex items-center px-5 py-2.5 border border-secondary text-secondary rounded-md hover:bg-secondary hover:text-white transition-colors duration-200 text-sm font-medium">
                        <i class="fas fa-paper-plane mr-2 text-xs"></i> Send Message
                    </a>
                </div>
            </div>
        </div>

        <!-- Colored Social Links -->
        <div class="mt-12 text-center">
            <p class="text-slate-400 text-sm mb-4 tracking-wider">FOLLOW US</p>
            <div class="flex justify-center space-x-5">
                <a href="#" class="w-9 h-9 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center hover:bg-blue-100 transition-colors">
                    <i class="fab fa-twitter text-lg"></i>
                </a>
                <a href="#" class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                    <i class="fab fa-linkedin-in text-lg"></i>
                </a>
                <a href="#" class="w-9 h-9 rounded-full bg-gradient-to-tr from-purple-500 to-pink-500 text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                    <i class="fab fa-instagram text-lg"></i>
                </a>
                <a href="#" class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                    <i class="fab fa-facebook-f text-lg"></i>
                </a>
            </div>
        </div>

        <!-- Colored Footer -->
        <div class="mt-16 text-center text-xs text-slate-400 border-t border-slate-100 pt-6">
            <p>© 2023 <span class="text-primary">Company Name</span>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>