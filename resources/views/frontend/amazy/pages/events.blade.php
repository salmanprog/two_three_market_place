@extends('frontend.amazy.layouts.app')

@push('styles')
    <style>
        .events-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }

        .events-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .events-header h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .events-header p {
            font-size: 1.2rem;
            color: #6c757d;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            padding: 0 15px;
        }

        .event-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            border: 1px solid #e9ecef;
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .event-image-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .event-card:hover .event-image {
            transform: scale(1.1);
        }

        .event-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(0,0,0,0.3), rgba(0,0,0,0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .event-card:hover .event-overlay {
            opacity: 1;
        }

        .event-content {
            padding: 25px;
        }

        .event-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            line-height: 1.3;
            min-height: 60px;
            display: flex;
            align-items: center;
        }

        .event-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .event-title a:hover {
            color: #007bff;
        }

        .event-description {
            color: #6c757d;
            margin-bottom: 20px;
            line-height: 1.5;
            font-size: 0.95rem;
        }

        .event-button {
            display: inline-block;
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: center;
        }

        .event-button:hover {
            background: linear-gradient(45deg, #0056b3, #004085);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
            color: white;
            text-decoration: none;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-state h3 {
            font-size: 2.5rem;
            color: #6c757d;
            margin-bottom: 20px;
            font-weight: 300;
        }

        .empty-state p {
            font-size: 1.1rem;
            color: #adb5bd;
            max-width: 500px;
            margin: 0 auto;
        }

        .event-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.9);
            color: #007bff;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .events-section {
                padding: 60px 0;
            }

            .events-header h1 {
                font-size: 2.2rem;
                margin-bottom: 15px;
            }

            .events-header p {
                font-size: 1rem;
                padding: 0 20px;
            }

            .events-grid {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 0 20px;
            }

            .event-card {
                margin-bottom: 20px;
            }

            .event-content {
                padding: 20px;
            }

            .event-title {
                font-size: 1.2rem;
                min-height: auto;
                margin-bottom: 12px;
            }

            .event-button {
                padding: 10px 25px;
                font-size: 0.9rem;
            }

            .empty-state h3 {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .events-header h1 {
                font-size: 1.8rem;
            }

            .events-grid {
                padding: 0 15px;
            }

            .event-content {
                padding: 18px;
            }

            .event-title {
                font-size: 1.1rem;
            }
        }

        /* Animation for cards */
        .event-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .event-card:nth-child(1) { animation-delay: 0.1s; }
        .event-card:nth-child(2) { animation-delay: 0.2s; }
        .event-card:nth-child(3) { animation-delay: 0.3s; }
        .event-card:nth-child(4) { animation-delay: 0.4s; }
        .event-card:nth-child(5) { animation-delay: 0.5s; }
        .event-card:nth-child(6) { animation-delay: 0.6s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading state for images */
        .event-image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        .event-image-container.loaded::before {
            display: none;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
@endpush

@section('content')
    <section class="events-section">
        <div class="container">
            <div class="events-header">
                <h1>Upcoming Events</h1>
                <p>Discover amazing events and experiences happening around you. Book your tickets now and create unforgettable memories.</p>
            </div>

            <div class="events-grid">
                @if (count($events) > 0)
                    @foreach($events as $key => $event)
                        <div class="event-card">
                            <div class="event-image-container" id="event-image-{{ $event->id }}">
                                <img 
                                    src="{{isset($event->image)?showImage($event->image):showImage('frontend/amazy/img/6438ce493d38b.svg')}}"
                                    alt="{{ $event->title }}" 
                                    title="{{ $event->title }}" 
                                    class="event-image lazyload"
                                    onload="this.parentElement.classList.add('loaded')"
                                >
                                <div class="event-overlay"></div>
                                <div class="event-badge">Event</div>
                            </div>
                            
                            <div class="event-content">
                                <h3 class="event-title">
                                    <a href="{{ route('frontend.organiser-events-show', $event->id) }}">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                                
                                 <!-- <div class="event-dates">
                                    <div class="event-date-item">
                                        <span class="event-date-icon">S</span>
                                        <span class="event-date-label">Start:</span>
                                        <span class="event-date-value">{{ $event->from_date }}</span>
                                    </div>
                                    <div class="event-date-item">
                                        <span class="event-date-icon">E</span>
                                        <span class="event-date-label">End:</span>
                                        <span class="event-date-value">{{ $event->to_date }}</span>
                                    </div>
                                </div> -->
                                
                                <p class="event-description">
                                    Join us for an incredible experience. Click below to learn more and book your spot.
                                </p>
                                
                                <a href="{{ route('frontend.organiser-events-show', $event->id) }}" class="event-button">
                                    View Event Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <h3>Coming Soon!</h3>
                        <p>We're working hard to bring you amazing events. Stay tuned for updates and be the first to know when new events are announced.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                @if(empty($eventsSortedByLocation))
                (function trySortEventsByLocation() {
                    if (!('geolocation' in navigator)) {
                        return;
                    }
                    var search = window.location.search || '';
                    if (/[?&]lat=/.test(search) && /[?&]lng=/.test(search)) {
                        return;
                    }
                    navigator.geolocation.getCurrentPosition(
                        function (pos) {
                            var params = new URLSearchParams(window.location.search);
                            params.set('lat', String(pos.coords.latitude));
                            params.set('lng', String(pos.coords.longitude));
                            var q = params.toString();
                            window.location.replace(window.location.pathname + (q ? '?' + q : ''));
                        },
                        function () {},
                        { enableHighAccuracy: false, timeout: 10000, maximumAge: 600000 }
                    );
                })();
                @endif

                // Pricing toggle functionality (keeping existing code)
                $('#pricingToggle').on('change', function() {
                    this.value = this.checked ? 1 : 0;
                    if (this.value == 1) {
                        $('#type').val('yearly');
                        $('.monthly_price_div').addClass('d-none');
                        $('.yearly_price_div').removeClass('d-none');
                    }
                    if (this.value == 0) {
                        $('#type').val('monthly');
                        $('.yearly_price_div').addClass('d-none');
                        $('.monthly_price_div').removeClass('d-none');
                    }
                });

                $(document).on('click', '.select_btn_price', function() {
                    event.preventDefault();
                    $('#id').val($(this).attr("data-id"));
                    $('.price_subscription_add').submit();
                });

                // Enhanced image loading
                $('.event-image').each(function() {
                    const img = $(this);
                    const container = img.parent();
                    
                    if (img[0].complete) {
                        container.addClass('loaded');
                    } else {
                        img.on('load', function() {
                            container.addClass('loaded');
                        });
                    }
                });

                // Smooth scroll for anchor links
                $('a[href^="#"]').on('click', function(event) {
                    const target = $(this.getAttribute('href'));
                    if (target.length) {
                        event.preventDefault();
                        $('html, body').stop().animate({
                            scrollTop: target.offset().top - 100
                        }, 1000);
                    }
                });

                // Add intersection observer for better performance
                if ('IntersectionObserver' in window) {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.style.opacity = '1';
                                entry.target.style.transform = 'translateY(0)';
                            }
                        });
                    }, {
                        threshold: 0.1
                    });

                    document.querySelectorAll('.event-card').forEach(card => {
                        observer.observe(card);
                    });
                }
            });
        })(jQuery);
    </script>
@endpush
