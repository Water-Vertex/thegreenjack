<div>
    <style>
        /* Additional modern touches: smooth scroll, custom selection */
        ::selection {
            background: rgba(91, 159, 1, 0.3);
            color: #1f2a2e;
        }
        .btn-primary i, .learn-link i {
            transition: transform 0.2s;
        }
        .print-card:hover .icon-circle {
            border-radius: 30px;
        }
        p.text-gray-500 {
            color: #5d6e73;
        }
        .max-w-2xl {
            max-width: 42rem;
        }
        .services-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #ffffff 0%, #f8faf7 100%);
            position: relative;
            overflow: hidden;
        }

        .services-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(#e3f0d5 1.2px, transparent 1px);
            background-size: 32px 32px;
            opacity: 0.4;
            pointer-events: none;
        }

        /* header style matching modern brand */
        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(91, 159, 1, 0.12);
            padding: 6px 18px;
            border-radius: 60px;
            margin-bottom: 20px;
            backdrop-filter: blur(2px);
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            background-color: #5B9F01;
            border-radius: 50%;
            display: inline-block;
            animation: pulseDot 1.8s infinite;
        }

        @keyframes pulseDot {
            0% { opacity: 0.4; transform: scale(0.8);}
            100% { opacity: 1; transform: scale(1.2);}
        }

        .section-badge span {
            color: #3f6d00;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: #1E2A2F;
            margin-bottom: 16px;
        }

        .title-decoration {
            width: 70px;
            height: 4px;
            background: #5B9F01;
            border-radius: 4px;
            margin: 0 auto;
            margin-top: 8px;
        }

        /* G R I D  -  4 columns + responsive */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 28px;
            margin: 48px 0 40px;
        }

        @media (min-width: 640px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .services-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* Service Card - refined similar but distinct: softer shadows, modern borders */
        .print-card {
            background: white;
            border-radius: 28px;
            padding: 28px 20px 32px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            box-shadow: 0 12px 26px -12px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(91, 159, 1, 0.08);
            position: relative;
            z-index: 2;
        }

        .print-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 40px -20px rgba(91, 159, 1, 0.25), 0 12px 24px -8px rgba(0, 0, 0, 0.08);
            border-color: rgba(91, 159, 1, 0.25);
        }

        /* Icon container - different curvature: circular modern */
        .icon-circle {
            width: 84px;
            height: 84px;
            background: #F0F7E5;
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 22px;
            transition: all 0.3s ease;
        }

        .print-card:hover .icon-circle {
            background: #5B9F01;
            transform: scale(0.96);
            border-radius: 32px;
        }

        .icon-circle i {
            font-size: 42px;
            color: #5B9F01;
            transition: all 0.3s ease;
        }

        .print-card:hover .icon-circle i {
            color: white;
            transform: scale(1.02);
        }

        .service-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.45rem;
            font-weight: 700;
            margin-bottom: 14px;
            color: #1f2a2e;
        }

        .service-title a {
            text-decoration: none;
            color: inherit;
            transition: color 0.2s;
        }

        .service-title a:hover {
            color: #5B9F01;
        }

        .card-description {
            color: #5b6b6f;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 22px;
            padding: 0 4px;
        }

        .learn-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #5B9F01;
            text-decoration: none;
            border-bottom: 1.5px solid transparent;
            transition: all 0.2s;
        }

        .learn-link i {
            font-size: 0.8rem;
            transition: transform 0.2s;
        }

        .learn-link:hover {
            gap: 12px;
            border-bottom-color: #5B9F01;
        }

        .learn-link:hover i {
            transform: translateX(4px);
        }

        /* CTA button enhanced */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: #5B9F01;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            padding: 12px 32px;
            border-radius: 50px;
            transition: all 0.25s ease;
            box-shadow: 0 6px 14px rgba(91, 159, 1, 0.3);
            text-decoration: none;
            border: none;
        }

        .btn-primary:hover {
            background: #3f7a00;
            transform: scale(1.02);
            box-shadow: 0 12px 20px -8px rgba(91, 159, 1, 0.5);
            gap: 14px;
        }

        /* extra decorative elements */
        .floating-accent {
            position: absolute;
            width: 240px;
            height: 240px;
            background: radial-gradient(circle, rgba(91,159,1,0.03) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .accent-1 {
            top: -80px;
            left: -60px;
        }
        .accent-2 {
            bottom: -60px;
            right: -40px;
        }

        @media (max-width: 768px) {
            .services-section {
                padding: 60px 0;
            }
            h2 {
                font-size: 1.9rem;
            }
            .icon-circle {
                width: 72px;
                height: 72px;
            }
            .icon-circle i {
                font-size: 34px;
            }
            .service-title {
                font-size: 1.3rem;
            }
        }
    </style>

    <section class="services-section">
        <div class="floating-accent accent-1"></div>
        <div class="floating-accent accent-2"></div>
        <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 24px;">
            <!-- Section Header -->
            <div class="text-center">
                <div class="section-badge">
                    <span class="badge-dot"></span>
                    <span>PREMIUM SOLUTIONS</span>
                </div>
                <h2>Print. Promote. <span style="color:#5B9F01;">Perform.</span></h2>
                <div class="title-decoration"></div>
                <p class="text-gray-500 max-w-2xl mx-auto mt-4" style="max-width: 560px; color: #5f6f74;">
                    High‑impact printing & strategic marketing — from business essentials to bold campaigns.
                </p>
            </div>

            <!-- Services Grid: 8 distinct printing & marketing services with matching icons -->
            <div class="services-grid">

                <!-- 1. Document Printing -->
                <div class="print-card">
                    <div class="icon-circle">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="service-title"><a href="#">Document Printing</a></h3>
                    <p class="card-description">
                        Crisp, professional documents — reports, manuals, proposals. Fast turnaround & premium paper options.
                    </p>
                    <a href="#" class="learn-link">Discover printing <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- 2. Business Cards -->
                <div class="print-card">
                    <div class="icon-circle">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3 class="service-title"><a href="#">Business Cards</a></h3>
                    <p class="card-description">
                        Leave a lasting impression with premium business cards — matt, gloss, foil, or eco-friendly finishes.
                    </p>
                    <a href="#" class="learn-link">Customize now <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- 3. Signs, Banners, & Posters -->
                <div class="print-card">
                    <div class="icon-circle">
                        <i class="fas fa-sign"></i>
                    </div>
                    <h3 class="service-title"><a href="#">Signs, Banners & Posters</a></h3>
                    <p class="card-description">
                        Indoor & outdoor signage, vinyl banners, pull-up displays — high visibility for events & retail.
                    </p>
                    <a href="#" class="learn-link">Get a quote <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- 4. Marketing Materials -->
                <div class="print-card">
                    <div class="icon-circle">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="service-title"><a href="#">Marketing Materials</a></h3>
                    <p class="card-description">
                        Flyers, brochures, catalogs, and door hangers — data-driven designs that convert leads.
                    </p>
                    <a href="#" class="learn-link">Boost your brand <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- 5. Cards & Invitations -->
                <div class="print-card">
                    <div class="icon-circle">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <h3 class="service-title"><a href="#">Cards & Invitations</a></h3>
                    <p class="card-description">
                        Elegant wedding invites, greeting cards, thank you notes — custom foil stamping + letterpress available.
                    </p>
                    <a href="#" class="learn-link">Design yours <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- 6. Labels & Stickers -->
                <div class="print-card">
                    <div class="icon-circle">
                        <i class="fas fa-tag"></i>
                    </div>
                    <h3 class="service-title"><a href="#">Labels & Stickers</a></h3>
                    <p class="card-description">
                        Waterproof, kiss-cut, or roll labels — perfect for packaging, branding, and promotional giveaways.
                    </p>
                    <a href="#" class="learn-link">Create stickers <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- 7. Envelope & Stationery -->
                <div class="print-card">
                    <div class="icon-circle">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="service-title"><a href="#">Envelope & Stationery</a></h3>
                    <p class="card-description">
                        Custom envelopes, letterheads, notepads — elevate corporate correspondence with sophistication.
                    </p>
                    <a href="#" class="learn-link">Shop stationery <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- 8. Photo Gifts & Business Solutions -->
                <div class="print-card">
                    <div class="icon-circle">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h3 class="service-title"><a href="#">Photo Gifts & Business Solutions</a></h3>
                    <p class="card-description">
                        Photo albums, calendars, mugs, and B2B bulk solutions — branded corporate gifts & promotional merch.
                    </p>
                    <a href="#" class="learn-link">Gift ideas <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Marketing Services sub-section -->
            <div class="mt-8 grid md:grid-cols-2 gap-8 items-center bg-white/60 backdrop-blur-sm rounded-3xl p-6 md:p-8 border border-[#5B9F01]/10 shadow-sm" style="margin-top: 40px;">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <i class="fas fa-chart-line text-[#5B9F01] text-xl"></i>
                        <span class="text-[#5B9F01] font-bold text-sm uppercase tracking-wider">Marketing muscle</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">Beyond print — full funnel marketing</h3>
                    <p class="text-gray-600 mt-3 leading-relaxed">
                        From SEO-optimized catalogs to direct mail campaigns, we blend traditional printing with modern marketing strategies.
                        Get branded assets, campaign management, and analytics-driven collateral.
                    </p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-[#5B9F01] text-sm"></i><span>Variable data printing & personalization</span></li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-[#5B9F01] text-sm"></i><span>QR code integration + tracking</span></li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-[#5B9F01] text-sm"></i><span>Full-service creative & copywriting</span></li>
                    </ul>
                    <a href="#" class="inline-flex items-center gap-2 mt-5 text-[#5B9F01] font-semibold border-b border-[#5B9F01]/40 hover:gap-3 transition-all">Explore marketing services →</a>
                </div>
                <div class="flex justify-center md:justify-end">
                    <div class="grid grid-cols-2 gap-2 w-full max-w-xs">
                        <div class="bg-white p-3 rounded-xl shadow-sm text-center border border-gray-100">
                            <i class="fas fa-envelope-open-text text-2xl text-[#5B9F01]"></i>
                            <p class="text-xs font-medium mt-1">Direct Mail</p>
                        </div>
                        <div class="bg-white p-3 rounded-xl shadow-sm text-center border border-gray-100">
                            <i class="fas fa-ad text-2xl text-[#5B9F01]"></i>
                            <p class="text-xs font-medium mt-1">Digital Sync</p>
                        </div>
                        <div class="bg-white p-3 rounded-xl shadow-sm text-center border border-gray-100">
                            <i class="fas fa-palette text-2xl text-[#5B9F01]"></i>
                            <p class="text-xs font-medium mt-1">Creative Studio</p>
                        </div>
                        <div class="bg-white p-3 rounded-xl shadow-sm text-center border border-gray-100">
                            <i class="fas fa-store text-2xl text-[#5B9F01]"></i>
                            <p class="text-xs font-medium mt-1">Retail Ready</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="text-center mt-12">
                <a href="#" class="btn-primary">
                    Discover All Printing & Marketing Services <i class="fas fa-arrow-right text-sm"></i>
                </a>
                <p class="text-xs text-gray-400 mt-4">Volume discounts • Free shipping on orders $150+ • Same-day in-store</p>
            </div>
        </div>
    </section>
</div>
