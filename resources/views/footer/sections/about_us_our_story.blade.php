<x-navbar />

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Story</title>
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
        .story-content {
            color: #334155;
            line-height: 1.7;
        }
        .story-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-top: 2rem;
            margin-bottom: 1rem;
            position: relative;
            padding-left: 1.5rem;
        }
        .story-content h3:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0.5rem;
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            background-color: #2563eb;
        }
        .story-content p {
            margin-bottom: 1.25rem;
        }
        .story-content a {
            color: #2563eb;
            font-weight: 500;
        }
        .story-image {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .story-image:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .milestone {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 2rem;
        }
        .milestone:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0.25rem;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            background-color: white;
            border: 3px solid #2563eb;
        }
        .milestone h4 {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        .milestone p {
            color: #475569;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-4xl w-full bg-white rounded-lg shadow-sm p-8 border border-slate-100">
        <!-- Header with decorative elements -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-12 h-0.5 bg-primary mr-3"></div>
                <span class="text-primary text-sm font-medium">OUR JOURNEY</span>
                <div class="w-12 h-0.5 bg-primary ml-3"></div>
            </div>
            <h2 class="text-3xl font-semibold text-slate-800 mb-3">
                {{ $data['title'] ?? 'Our Story' }}
            </h2>
            <p class="text-slate-500 max-w-md mx-auto">How it all began and where we're headed</p>
        </div>

        <!-- Story Content -->
        <div class="story-content">
            @if(!empty($data['content']))
                {!! nl2br(e($data['content'])) !!}
            @else
                <div class="text-center py-12">
                    <div class="bg-slate-50 inline-flex p-4 rounded-full mb-4">
                        <i class="fas fa-book-open text-3xl text-slate-300"></i>
                    </div>
                    <h3 class="text-xl font-medium text-slate-700 mb-2">Our Story is Still Being Written</h3>
                    <p class="text-slate-500 mb-4">Check back soon to learn about our journey</p>
                    <a href="/contact" class="inline-flex items-center text-sm text-primary hover:text-blue-700">
                        <i class="fas fa-chevron-right mr-1 text-xs"></i> Get in touch to learn more
                    </a>
                </div>
            @endif
        </div>

        <!-- Story Image -->
        @if(!empty($data['image']))
            <div class="mt-8 mb-12">
                <img src="{{ $data['image'] }}" alt="Our Story Image" class="story-image w-full h-auto rounded-lg shadow-md border border-slate-100">
                @if(!empty($data['image_caption']))
                    <p class="text-center text-sm text-slate-500 mt-2">{{ $data['image_caption'] }}</p>
                @endif
            </div>
        @endif

        <!-- Milestones Section (added value) -->
        <div class="mt-10 bg-slate-50 rounded-xl p-6">
            <h3 class="text-xl font-semibold text-slate-800 mb-6 flex items-center">
                <span class="bg-primary/10 p-2 rounded-full mr-3">
                    <i class="fas fa-star text-primary text-sm"></i>
                </span>
                Key Milestones
            </h3>
            
            <div class="space-y-6">
                <div class="milestone">
                    <h4 class="text-lg">2015 - Founded</h4>
                    <p class="text-slate-600">Started in a small garage with just two team members and a big vision.</p>
                </div>
                <div class="milestone">
                    <h4 class="text-lg">2017 - First Product Launch</h4>
                    <p class="text-slate-600">Introduced our flagship product that changed the industry standards.</p>
                </div>
                <div class="milestone">
                    <h4 class="text-lg">2020 - Global Expansion</h4>
                    <p class="text-slate-600">Began shipping to over 30 countries worldwide.</p>
                </div>
                <div class="milestone">
                    <h4 class="text-lg">2023 - Community Impact</h4>
                    <p class="text-slate-600">Reached our goal of donating 1% of all profits to environmental causes.</p>
                </div>
            </div>
        </div>

        <!-- Team Values -->
        <div class="mt-12">
            <h3 class="text-xl font-semibold text-slate-800 mb-6 flex items-center">
                <span class="bg-primary/10 p-2 rounded-full mr-3">
                    <i class="fas fa-heart text-primary text-sm"></i>
                </span>
                Our Core Values
            </h3>
            
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white p-5 rounded-lg border border-slate-100 shadow-sm">
                    <div class="bg-blue-50 w-10 h-10 rounded-full flex items-center justify-center text-primary mb-3">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4 class="font-medium text-slate-800 mb-2">Innovation</h4>
                    <p class="text-slate-600 text-sm">We constantly push boundaries to deliver groundbreaking solutions.</p>
                </div>
                <div class="bg-white p-5 rounded-lg border border-slate-100 shadow-sm">
                    <div class="bg-emerald-50 w-10 h-10 rounded-full flex items-center justify-center text-accent mb-3">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h4 class="font-medium text-slate-800 mb-2">Integrity</h4>
                    <p class="text-slate-600 text-sm">We do business with honesty and transparency at all times.</p>
                </div>
                <div class="bg-white p-5 rounded-lg border border-slate-100 shadow-sm">
                    <div class="bg-purple-50 w-10 h-10 rounded-full flex items-center justify-center text-secondary mb-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="font-medium text-slate-800 mb-2">Community</h4>
                    <p class="text-slate-600 text-sm">We believe in giving back and creating positive impact.</p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-14 text-center">
            <h3 class="text-xl font-medium text-slate-800 mb-3">Want to be part of our story?</h3>
            <p class="text-slate-600 mb-6 max-w-lg mx-auto">We're always looking for passionate people to join our team or partner with us.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="/careers" class="px-6 py-3 bg-primary text-white rounded-md hover:bg-blue-700 transition-colors font-medium">
                    <i class="fas fa-briefcase mr-2"></i> View Careers
                </a>
                <a href="/contact" class="px-6 py-3 border border-slate-200 text-slate-700 rounded-md hover:bg-slate-50 transition-colors font-medium">
                    <i class="fas fa-envelope mr-2"></i> Contact Us
                </a>
            </div>
        </div>
    </div>
</body>
</html>