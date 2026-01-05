@extends('layouts.app')

@section('content')

    <section class="max-w-6xl mx-auto px-6 md:px-12 lg:px-20 py-20">
        <!-- Header -->
        <div class="text-center mb-20">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif text-[#C5A059] mb-6">Get In Touch</h1>
            <p class="text-gray-400 text-lg font-light max-w-2xl mx-auto">
                We look forward to welcoming you. Please feel free to contact us using any of the methods below.
            </p>
        </div>

        <!-- Contact Information Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-20">
            <!-- Location -->
            <div class="text-center md:text-left">
                <h3 class="text-[#C5A059] uppercase tracking-widest text-sm mb-6 font-medium">Our Location</h3>
                <address class="not-italic text-gray-300 leading-relaxed font-light">
                    <span class="block text-white font-medium mb-2">Brooklyn's Massage Parlour</span>
                    129-131B Nantwich Road<br>
                    Crewe<br>
                    Cheshire<br>
                    CW2 6DF
                </address>
            </div>

            <!-- Phone -->
            <div class="text-center md:text-left">
                <h3 class="text-[#C5A059] uppercase tracking-widest text-sm mb-6 font-medium">Call Us</h3>
                <a href="tel:01270215600"
                   class="text-2xl md:text-3xl font-serif text-white hover:text-[#C5A059] transition-colors block">
                    01270 215 600
                </a>
                <p class="text-gray-400 text-sm mt-3 font-light">
                    Available for bookings and enquiries
                </p>
            </div>

            <!-- Email -->
            <div class="text-center md:text-left">
                <h3 class="text-[#C5A059] uppercase tracking-widest text-sm mb-6 font-medium">Email</h3>
                <a href="mailto:hello@brookynsbabes.com"
                   class="text-white hover:text-[#C5A059] transition-colors break-all">
                    hello@brookynsbabes.com
                </a>
            </div>
        </div>

        <!-- Important Notice -->
        <div class="bg-[#C5A059]/10 border-l-4 border-[#C5A059] px-8 py-6 mb-20">
            <p class="text-white text-center font-medium">
                IT CAN TAKE A FEW DAYS TO ANSWER EMAILS. IF YOU HAVE ANY QUESTIONS OR YOU WOULD LIKE TO MAKE A BOOKING PLEASE CALL
                <a href="tel:01270215600" class="text-[#C5A059] hover:text-white transition-colors">01270 215 600</a>
            </p>
        </div>

        <!-- Directions -->
        <div class="mb-12 max-w-3xl mx-auto">
            <h3 class="text-2xl md:text-3xl font-serif text-white text-center mb-8">How to Find Us</h3>
            <p class="text-gray-300 leading-relaxed font-light text-center">
                Once you are on Nantwich Road look out for Brooklyn Street, turn onto this street and you will see a turning on the left-hand side of the road (at the rear of Apparel). This leads into our private car park. Please feel free to leave your vehicle here as it is a secure area.
            </p>
            <p class="text-gray-400 text-sm text-center mt-4 italic">
                (If you pass Sainsbury's then you have gone too far up the road)
            </p>
        </div>

        <!-- Google Map -->
        <div class="aspect-video w-full overflow-hidden border border-white/10 grayscale">
            <iframe
                src="https://maps.google.com/maps?q=129-131B+Nantwich+Road,+Crewe,+CW2+6DF,+UK&t=&z=15&ie=UTF8&iwloc=&output=embed"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

@endsection