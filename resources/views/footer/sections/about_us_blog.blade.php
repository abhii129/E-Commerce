<x-navbar />
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
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
        .blog-post {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        .blog-post:hover {
            border-left-color: #2563eb;
            transform: translateX(4px);
        }
        .post-date {
            position: relative;
            padding-left: 1.5rem;
        }
        .post-date:before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            background-color: #2563eb;
            opacity: 0.5;
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
    <div class="max-w-3xl w-full bg-white rounded-lg shadow-sm p-8 border border-slate-100">
        <!-- Header with decorative elements -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-12 h-0.5 bg-primary mr-3"></div>
                <span class="text-primary text-sm font-medium">LATEST UPDATES</span>
                <div class="w-12 h-0.5 bg-primary ml-3"></div>
            </div>
            <h2 class="text-3xl font-semibold text-slate-800 mb-3">Blog</h2>
            <p class="text-slate-500 max-w-md mx-auto">Insights, stories and updates from our team</p>
        </div>

        <!-- Blog Posts -->
        @if(!empty($data) && is_array($data))
            <ul class="space-y-8">
                @foreach($data as $post)
                    <li class="blog-post pl-6 py-4">
                        <div class="flex flex-col md:flex-row md:items-start">
                            @if(!empty($post['image']))
                                <div class="md:w-1/3 mb-4 md:mb-0 md:mr-6">
                                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] ?? 'Blog post image' }}" class="w-full h-48 object-cover rounded-lg shadow-sm">
                                </div>
                            @endif
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    @if(!empty($post['category']))
                                        <span class="bg-blue-50 text-primary text-xs font-medium px-2.5 py-0.5 rounded-full mr-3">
                                            {{ $post['category'] }}
                                        </span>
                                    @endif
                                    @if(!empty($post['date']))
                                        <small class="post-date text-sm text-slate-500">
                                            {{ \Carbon\Carbon::parse($post['date'])->format('F j, Y') }}
                                        </small>
                                    @endif
                                </div>
                                <h3 class="text-xl font-semibold text-slate-800 mb-2 hover:text-primary transition-colors">
                                    <a href="#">{{ $post['title'] ?? 'Untitled Post' }}</a>
                                </h3>
                                <p class="text-slate-600 mb-3">{{ $post['excerpt'] ?? $post['content'] ?? '' }}</p>
                                <a href="#" class="inline-flex items-center text-sm text-primary hover:text-blue-700 font-medium">
                                    Read more <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <nav class="inline-flex space-x-1">
                    <a href="#" class="px-3 py-1 rounded-md bg-primary text-white">1</a>
                    <a href="#" class="px-3 py-1 rounded-md hover:bg-slate-100">2</a>
                    <a href="#" class="px-3 py-1 rounded-md hover:bg-slate-100">3</a>
                    <a href="#" class="px-3 py-1 rounded-md hover:bg-slate-100">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </a>
                </nav>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="empty-state-icon bg-slate-50 inline-flex p-6 rounded-full mb-4">
                    <i class="fas fa-pen-fancy text-3xl text-slate-300"></i>
                </div>
                <h3 class="text-xl font-medium text-slate-700 mb-2">No Blog Posts Yet</h3>
                <p class="text-slate-500 mb-4">We're working on creating valuable content for you.</p>
                <a href="#" class="inline-flex items-center text-sm text-primary hover:text-blue-700 font-medium">
                    <i class="fas fa-envelope mr-1"></i> Subscribe to get notified
                </a>
            </div>
        @endif

        <!-- Categories Section -->
        <div class="mt-14 pt-10 border-t border-slate-100">
            <h3 class="text-lg font-medium text-slate-800 mb-4 flex items-center">
                <i class="fas fa-tags text-primary mr-2"></i>
                Browse by Category
            </h3>
            <div class="flex flex-wrap gap-2">
                <a href="#" class="px-3 py-1 bg-blue-50 text-primary rounded-full text-sm hover:bg-blue-100">All</a>
                <a href="#" class="px-3 py-1 bg-slate-50 text-slate-600 rounded-full text-sm hover:bg-slate-100">Company News</a>
                <a href="#" class="px-3 py-1 bg-slate-50 text-slate-600 rounded-full text-sm hover:bg-slate-100">Product Updates</a>
                <a href="#" class="px-3 py-1 bg-slate-50 text-slate-600 rounded-full text-sm hover:bg-slate-100">Tutorials</a>
                <a href="#" class="px-3 py-1 bg-slate-50 text-slate-600 rounded-full text-sm hover:bg-slate-100">Industry Insights</a>
            </div>
        </div>

        <!-- Subscription CTA -->
        <div class="mt-12 bg-slate-50 rounded-xl p-6">
            <div class="text-center">
                <h3 class="text-lg font-medium text-slate-800 mb-2">Stay Updated</h3>
                <p class="text-slate-600 mb-4 max-w-md mx-auto">Get the latest posts delivered right to your inbox</p>
                <div class="flex max-w-md mx-auto">
                    <input type="email" placeholder="Your email address" class="flex-1 px-4 py-2 border border-slate-200 rounded-l-md focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
                    <button class="bg-primary text-white px-4 py-2 rounded-r-md hover:bg-blue-700 transition-colors">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>