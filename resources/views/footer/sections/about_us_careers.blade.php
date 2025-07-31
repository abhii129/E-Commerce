<x-navbar />

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers</title>
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
        }
        
        .job-card {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .job-card:hover {
            border-left-color: #2563eb;
            transform: translateX(4px);
        }
        
        .apply-btn {
            transition: all 0.2s ease;
        }
        
        .apply-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        }
        
        .empty-state-icon {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="about-us-careers-section max-w-3xl w-full bg-white rounded-lg shadow-sm p-8 border border-slate-100">
        <!-- Header with decorative elements -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-12 h-0.5 bg-primary mr-3"></div>
                <span class="text-primary text-sm font-medium">JOIN OUR TEAM</span>
                <div class="w-12 h-0.5 bg-primary ml-3"></div>
            </div>
            <h2 class="text-3xl font-semibold text-slate-800 mb-3">Careers</h2>
            <p class="text-slate-500 max-w-md mx-auto">Help us build the future of e-commerce</p>
        </div>

        @if(!empty($data) && is_array($data))
            <ul class="space-y-8">
                @foreach($data as $job)
                    <li class="job-card pl-6 py-6">
                        <div class="flex flex-col md:flex-row md:items-start">
                            <div class="flex-1">
                                <div class="flex items-center mb-3">
                                    <span class="bg-blue-50 text-primary text-xs font-medium px-2.5 py-0.5 rounded-full mr-3">
                                        {{ $job['type'] ?? 'Full-time' }}
                                    </span>
                                    @if(!empty($job['location']))
                                        <span class="text-sm text-slate-500">
                                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $job['location'] }}
                                        </span>
                                    @endif
                                </div>
                                
                                <h3 class="text-xl font-semibold text-slate-800 mb-2">{{ $job['position'] ?? 'Open Position' }}</h3>
                                <p class="text-slate-600 mb-4">{{ $job['description'] ?? '' }}</p>
                                
                                <div class="flex flex-wrap items-center gap-4">
                                    @if(!empty($job['apply_link']))
                                        <a href="{{ $job['apply_link'] }}" class="apply-btn px-5 py-2 bg-primary text-white rounded-md hover:bg-blue-700 font-medium inline-flex items-center" target="_blank" rel="noopener">
                                            <i class="fas fa-paper-plane mr-2"></i> Apply Now
                                        </a>
                                    @endif
                                    @if(!empty($job['salary']))
                                        <span class="text-sm text-slate-500">
                                            <i class="fas fa-dollar-sign mr-1"></i> {{ $job['salary'] }}
                                        </span>
                                    @endif

                                    
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="empty-state-icon bg-slate-50 inline-flex p-6 rounded-full mb-4">
                    <i class="fas fa-briefcase text-3xl text-slate-300"></i>
                </div>
                <h3 class="text-xl font-medium text-slate-700 mb-2">No Current Openings</h3>
                <p class="text-slate-500 mb-4">We're not hiring at the moment, but check back soon!</p>
                <a href="#" class="inline-flex items-center text-sm text-primary hover:text-blue-700 font-medium">
                    <i class="fas fa-envelope mr-1"></i> Join our talent network
                </a>
            </div>
        @endif

        <!-- Culture Section -->
        <div class="mt-16 pt-10 border-t border-slate-100">
            <h3 class="text-xl font-semibold text-slate-800 mb-6 flex items-center">
                <span class="bg-primary/10 p-2 rounded-full mr-3">
                    <i class="fas fa-heart text-primary text-sm"></i>
                </span>
                Our Culture
            </h3>
            
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white p-5 rounded-lg border border-slate-100 shadow-sm">
                    <div class="bg-blue-50 w-10 h-10 rounded-full flex items-center justify-center text-primary mb-3">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4 class="font-medium text-slate-800 mb-2">Innovation</h4>
                    <p class="text-slate-600 text-sm">We encourage creative thinking and reward bold ideas.</p>
                </div>
                <div class="bg-white p-5 rounded-lg border border-slate-100 shadow-sm">
                    <div class="bg-emerald-50 w-10 h-10 rounded-full flex items-center justify-center text-accent mb-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="font-medium text-slate-800 mb-2">Collaboration</h4>
                    <p class="text-slate-600 text-sm">Teamwork is at the heart of everything we do.</p>
                </div>
                <div class="bg-white p-5 rounded-lg border border-slate-100 shadow-sm">
                    <div class="bg-purple-50 w-10 h-10 rounded-full flex items-center justify-center text-secondary mb-3">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="font-medium text-slate-800 mb-2">Growth</h4>
                    <p class="text-slate-600 text-sm">We invest in your professional development.</p>
                </div>
            </div>
        </div>

        <!-- General Application CTA -->
        <div class="mt-12 text-center">
            <h3 class="text-lg font-medium text-slate-800 mb-3">Don't see your dream role?</h3>
            <p class="text-slate-600 mb-6">We're always looking for talented people. Send us your resume!</p>
            <a href="mailto:careers@example.com" class="inline-flex items-center px-6 py-3 border border-primary text-primary rounded-md hover:bg-primary hover:text-white transition-colors font-medium">
                <i class="fas fa-envelope mr-2"></i> Submit General Application
            </a>
        </div>
    </div>
</body>
</html>