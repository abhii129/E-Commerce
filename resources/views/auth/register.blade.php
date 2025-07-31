<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | E-Com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
</head>
<body>
    <div class="form-wrapper">
        <div class="form-container">
            <!-- Header -->
            <div class="form-header">
                <h1 class="form-title">Create your account to start shopping</h1>
            </div>

            <!-- Form -->
            <div class="form-content">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name -->
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" required autofocus class="form-input"
                            placeholder="John Doe" value="{{ old('name') }}">
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" required class="form-input"
                            placeholder="your@email.com" value="{{ old('email') }}">
                    </div>

                    <!-- Phone and Age -->
                    <div class="form-grid">
                        <!-- Phone -->
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="number" required class="form-input"
                                placeholder="(555) 123-4567" value="{{ old('number') }}">
                        </div>
                        
                        <!-- Age -->
                        <div class="form-group">
                            <label class="form-label">Age</label>
                            <input type="number" name="age" min="0" required class="form-input"
                                placeholder="Your age" value="{{ old('age') }}">
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" required class="form-input"
                            placeholder="123 Main St, City, Country" value="{{ old('address') }}">
                    </div>

                    <!-- Gender -->
                    <div class="form-group">
                        <label class="form-label">Gender</label>
                        <select name="gender" required class="form-input form-select">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Password and Confirm Password -->
                    <div class="form-grid">
                        <!-- Password -->
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" required class="form-input"
                                placeholder="••••••••">
                        </div>
                        
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" required class="form-input"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="form-checkbox">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">
                            I agree to the <a href="#" class="form-link">Terms of Service</a> and <a href="#" class="form-link">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="form-submit">
                        Create Account
                    </button>
                </form>

                <!-- Already have account -->
                <div class="form-footer">
                    Already have an account? <a href="{{ route('login') }}" class="form-link">Sign in</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>