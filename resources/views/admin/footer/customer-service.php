<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($message->section) }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom Styling -->
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7ff;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .contact-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .contact-container:hover {
            transform: translateY(-5px);
        }
        
        .contact-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .contact-header h2 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .contact-header p {
            opacity: 0.9;
        }
        
        .contact-form {
            padding: 2.5rem;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            padding: 12px 30px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .contact-image {
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }
        
        .contact-info {
            padding: 2rem;
            background-color: var(--light);
            border-radius: 0 0 16px 16px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .info-icon {
            width: 50px;
            height: 50px;
            background-color: rgba(67, 97, 238, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--primary);
            font-size: 1.25rem;
        }
        
        @media (max-width: 992px) {
            .contact-image-col {
                display: none;
            }
            
            .contact-container {
                margin-top: 2rem;
                margin-bottom: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container my-auto py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row g-0 shadow-lg">
                    <!-- Contact Form Column -->
                    <div class="col-lg-7">
                        <div class="contact-container h-100">
                            <div class="contact-header">
                                <h2>Contact Us</h2>
                                <p>We'd love to hear from you! Send us a message.</p>
                            </div>
                            
                            <form class="contact-form" method="POST" action="#">
                                <div class="mb-4">
                                    <label for="name" class="form-label">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="name" placeholder="John Doe" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" placeholder="example@domain.com" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="subject" class="form-label">Subject</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        <input type="text" class="form-control" id="subject" placeholder="How can we help?" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="message" class="form-label">Your Message</label>
                                    <textarea class="form-control" id="message" rows="5" placeholder="Type your message here..." required></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-submit mt-2">
                                    <i class="fas fa-paper-plane me-2"></i> Send Message
                                </button>
                            </form>
                            
                            <div class="contact-info">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Our Location</h5>
                                        <p class="mb-0">123 Business Ave, Suite 456<br>New York, NY 10001</p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Call Us</h5>
                                        <p class="mb-0">+1 (555) 123-4567<br>Mon-Fri, 9am-5pm</p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Email Us</h5>
                                        <p class="mb-0">info@company.com<br>support@company.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- Image Column -->
                    <div class="col-lg-5 d-none d-lg-flex contact-image-col">
                        <div class="h-100 d-flex align-items-center justify-content-center bg-light">
                            <img src="https://img.freepik.com/free-vector/flat-design-illustration-customer-support_23-2148887720.jpg" 
                                 alt="Contact Illustration" 
                                 class="contact-image p-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- {{ ucfirst($message->section) }}

<h2 class="text-2xl font-bold mb-4">Message for {{ ucfirst(str_replace('_', ' ', $message->section)) }}</h2>
     <p>{{ $message->message ?? 'No message available for this section.' }}</p> -->
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>