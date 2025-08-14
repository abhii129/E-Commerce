<x-navbar />
<div class="relative overflow-hidden">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-primary to-secondary py-24 sm:py-32">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-1/3 h-full bg-white opacity-20 transform -skew-x-12"></div>
            <div class="absolute top-0 right-0 w-1/4 h-full bg-white opacity-10 transform skew-y-12"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 animate-fade-in-down">
                    Our Story
                </h1>
                <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
                    Building the future of e-commerce with passion, innovation, and customer focus
                </p>
            </div>
        </div>
        
        <!-- Wave divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M1440 21.21C1206.67 58.42 1022.17 5.21004 755.5 5.21004C469.5 5.21004 256 68.21 0 21.21V120H1440V21.21Z" fill="#F9FAFB"/>
            </svg>
        </div>
    </div>

    <!-- Mission Section -->
    <div class="bg-white py-16 sm:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center mb-16">
                <div class="inline-flex items-center justify-center mb-4">
                    <div class="w-12 h-0.5 bg-primary mr-3"></div>
                    <span class="text-primary text-sm font-medium">OUR MISSION</span>
                    <div class="w-12 h-0.5 bg-primary ml-3"></div>
                </div>
                <h2 class="text-3xl font-semibold text-slate-800 mb-6">
                    Empowering businesses to thrive in the digital age
                </h2>
                <p class="text-lg text-slate-600">
                    We believe in creating tools that level the playing field, allowing businesses of all sizes to compete and succeed in today's digital marketplace. Our platform is designed to simplify complexity and amplify opportunity.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="bg-slate-50 p-8 rounded-xl text-center">
                    <div class="w-16 h-16 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-lightbulb text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-3">Innovation</h3>
                    <p class="text-slate-600">We constantly push boundaries to deliver cutting-edge solutions that anticipate market needs.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl text-center">
                    <div class="w-16 h-16 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-heart text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-3">Passion</h3>
                    <p class="text-slate-600">Our team is driven by a genuine love for what we do and the impact we create.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl text-center">
                    <div class="w-16 h-16 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-handshake text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-3">Integrity</h3>
                    <p class="text-slate-600">We build trust through transparency, honesty, and ethical business practices.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="bg-slate-50 py-16 sm:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center mb-16">
                <div class="inline-flex items-center justify-center mb-4">
                    <div class="w-12 h-0.5 bg-primary mr-3"></div>
                    <span class="text-primary text-sm font-medium">OUR TEAM</span>
                    <div class="w-12 h-0.5 bg-primary ml-3"></div>
                </div>
                <h2 class="text-3xl font-semibold text-slate-800 mb-6">
                    Meet the people behind our success
                </h2>
                <p class="text-lg text-slate-600">
                    A diverse team of thinkers, makers, and doers united by a common vision to revolutionize e-commerce.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-sm text-center hover:shadow-md transition-shadow">
                    <div class="w-32 h-32 mx-auto mb-6 rounded-full overflow-hidden border-4 border-white shadow-md">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Team member" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-1">Sarah Johnson</h3>
                    <p class="text-primary mb-4">CEO & Founder</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-slate-400 hover:text-primary transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-primary transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm text-center hover:shadow-md transition-shadow">
                    <div class="w-32 h-32 mx-auto mb-6 rounded-full overflow-hidden border-4 border-white shadow-md">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Team member" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-1">Michael Chen</h3>
                    <p class="text-primary mb-4">CTO</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-slate-400 hover:text-primary transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-primary transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm text-center hover:shadow-md transition-shadow">
                    <div class="w-32 h-32 mx-auto mb-6 rounded-full overflow-hidden border-4 border-white shadow-md">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Team member" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-1">Emma Rodriguez</h3>
                    <p class="text-primary mb-4">Head of Design</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-slate-400 hover:text-primary transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-primary transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm text-center hover:shadow-md transition-shadow">
                    <div class="w-32 h-32 mx-auto mb-6 rounded-full overflow-hidden border-4 border-white shadow-md">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Team member" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-1">David Kim</h3>
                    <p class="text-primary mb-4">Marketing Director</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-slate-400 hover:text-primary transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-primary transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-gradient-to-r from-primary to-secondary py-16 sm:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">10K+</div>
                    <p class="text-indigo-100 font-medium">Happy Customers</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">5+</div>
                    <p class="text-indigo-100 font-medium">Years in Business</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">50+</div>
                    <p class="text-indigo-100 font-medium">Team Members</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="bg-white py-16 sm:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center mb-16">
                <div class="inline-flex items-center justify-center mb-4">
                    <div class="w-12 h-0.5 bg-primary mr-3"></div>
                    <span class="text-primary text-sm font-medium">OUR VALUES</span>
                    <div class="w-12 h-0.5 bg-primary ml-3"></div>
                </div>
                <h2 class="text-3xl font-semibold text-slate-800 mb-6">
                    The principles that guide everything we do
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <div class="flex">
                    <div class="mr-6">
                        <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-lg flex items-center justify-center text-primary">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-slate-800 mb-3">Customer First</h3>
                        <p class="text-slate-600">Every decision starts with asking "what's best for our customers?" We listen, adapt, and go above and beyond to exceed expectations.</p>
                    </div>
                </div>
                <div class="flex">
                    <div class="mr-6">
                        <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-lg flex items-center justify-center text-primary">
                            <i class="fas fa-bolt text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-slate-800 mb-3">Agility</h3>
                        <p class="text-slate-600">In a fast-changing world, we embrace flexibility and quick thinking to stay ahead of the curve.</p>
                    </div>
                </div>
                <div class="flex">
                    <div class="mr-6">
                        <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-lg flex items-center justify-center text-primary">
                            <i class="fas fa-seedling text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-slate-800 mb-3">Sustainable Growth</h3>
                        <p class="text-slate-600">We build for the long term, making decisions that ensure lasting success for our business and community.</p>
                    </div>
                </div>
                <div class="flex">
                    <div class="mr-6">
                        <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-lg flex items-center justify-center text-primary">
                            <i class="fas fa-laugh text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-slate-800 mb-3">Joy</h3>
                        <p class="text-slate-600">We believe work should be fulfilling and fun. Our positive energy fuels creativity and collaboration.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-slate-50 py-16 sm:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm p-8 sm:p-12 text-center">
                <h2 class="text-3xl font-semibold text-slate-800 mb-4">Join us on our journey</h2>
                <p class="text-lg text-slate-600 mb-8 max-w-2xl mx-auto">
                    We're always looking for talented, passionate people to join our growing team.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#" class="px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        View Open Positions
                    </a>
                    <a href="#" class="px-6 py-3 border-2 border-primary text-primary font-medium rounded-lg hover:bg-blue-50 transition-colors">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animation for banner text */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-down {
        animation: fadeInDown 0.8s ease-out forwards;
    }
    
    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
    
    /* Card hover effect */
    .hover\:-translate-y-2:hover {
        transform: translateY(-8px);
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #a1a1a1;
    }
</style>
<x-footer />