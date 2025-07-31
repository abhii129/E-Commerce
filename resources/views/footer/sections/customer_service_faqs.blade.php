<x-navbar />

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Section</title>
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
        .faq-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 1px solid #e8eef4;
        }
        .faq-question {
            transition: all 0.2s ease;
        }
        .faq-question:hover {
            color: #2563eb;
        }
        .faq-answer {
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.2s ease;
        }
        .rotate-90 {
            transform: rotate(90deg);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full bg-white rounded-lg shadow-sm p-8 border border-slate-100">
        <!-- Header with matching style -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-12 h-0.5 bg-primary mr-3"></div>
                <span class="text-primary text-sm font-medium">QUESTIONS</span>
                <div class="w-12 h-0.5 bg-primary ml-3"></div>
            </div>
            <h2 class="text-3xl font-semibold text-slate-800 mb-2">Frequently Asked Questions</h2>
            <p class="text-slate-500 max-w-md mx-auto">Find answers to common questions about our services</p>
        </div>

        <!-- FAQ Accordion -->
        <div class="space-y-2">
            @if(!empty($data) && is_array($data))
                @foreach($data as $i => $faq)
                    <div class="faq-item py-4">
                        <button 
                            type="button" 
                            class="faq-question w-full flex justify-between items-center text-left font-medium text-slate-700 hover:text-primary focus:outline-none"
                            onclick="toggleFaq({{ $i }})"
                            aria-expanded="false"
                            aria-controls="faq-answer-{{ $i }}"
                        >
                            <span class="mr-3">Q: {{ $faq['question'] ?? '' }}</span>
                            <svg 
                                id="faq-icon-{{ $i }}" 
                                class="w-5 h-5 text-primary transform transition-transform" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div 
                            id="faq-answer-{{ $i }}" 
                            class="faq-answer max-h-0 opacity-0 ml-2 pl-4 border-l-2 border-primary"
                            aria-hidden="true"
                        >
                            <div class="py-3 text-slate-600">
                                <span class="font-medium text-accent">A:</span> {{ $faq['answer'] ?? '' }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8 text-slate-400">
                    <i class="far fa-comment-dots text-3xl mb-2"></i>
                    <p>No FAQs available at the moment.</p>
                </div>
            @endif
        </div>

        <!-- Support CTA -->
        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
            <p class="text-slate-500 mb-4">Still have questions?</p>
            <a href="#" class="inline-flex items-center px-5 py-2.5 border border-primary text-primary rounded-md hover:bg-primary hover:text-white transition-colors duration-200 text-sm font-medium">
                <i class="fas fa-headset mr-2"></i> Contact Support
            </a>
        </div>
    </div>

    <script>
        function toggleFaq(index) {
            const answer = document.getElementById(`faq-answer-${index}`);
            const icon = document.getElementById(`faq-icon-${index}`);
            const isExpanded = answer.getAttribute('aria-hidden') === 'false';
            
            if (isExpanded) {
                answer.classList.add('max-h-0', 'opacity-0');
                answer.classList.remove('max-h-screen', 'opacity-100');
                answer.setAttribute('aria-hidden', 'true');
                icon.classList.remove('rotate-90');
            } else {
                answer.classList.remove('max-h-0', 'opacity-0');
                answer.classList.add('max-h-screen', 'opacity-100');
                answer.setAttribute('aria-hidden', 'false');
                icon.classList.add('rotate-90');
            }
        }
    </script>
</body>
</html>