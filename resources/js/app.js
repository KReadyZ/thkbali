// Import Tailwind CSS utilities if needed or keep it simple
// This file will contain all frontend logic, modals, scroll animation, stats counter, tab switches, and lightbox.

document.addEventListener('DOMContentLoaded', () => {
    
    // Helper to get active language dynamically (handles Google Translate cookie)
    function getCurrentLang() {
        const match = document.cookie.match(/googtrans=([^;]+)/);
        if (match) {
            const decoded = decodeURIComponent(match[1]);
            const parts = decoded.split('/');
            const targetLang = parts[parts.length - 1];
            if (targetLang) {
                const lang = targetLang.toLowerCase();
                if (lang === 'id' || lang === 'indonesian') return 'id';
                return lang;
            }
        }
        // If custom switcher is active on page, read localStorage; otherwise default to 'id'
        const customBtns = document.querySelectorAll('.lang-btn');
        if (customBtns.length > 0) {
            return localStorage.getItem('preferred-language') || 'id';
        }
        return 'id';
    }
    let currentLang = getCurrentLang();
    
    // Helper to hide/show the WhatsApp floating widget
    function hideWhatsAppWidget() {
        const widget = document.getElementById('whatsapp-widget');
        if (widget) {
            widget.classList.add('hidden');
        }
    }

    function showWhatsAppWidget() {
        const widget = document.getElementById('whatsapp-widget');
        if (widget) {
            widget.classList.remove('hidden');
        }
    }
    
    /* ==========================================================================
       0. Transisi Halaman (Page Fade Transition)
       ========================================================================== */
    // Add fade-in to body on load
    setTimeout(() => {
        document.body.classList.add('fade-in');
    }, 50);

    // Intercept link clicks for page fade-out exit
    document.querySelectorAll('a').forEach(link => {
        const href = link.getAttribute('href');
        const target = link.getAttribute('target');
        
        if (href && 
            !href.startsWith('#') && 
            !href.startsWith('javascript:') && 
            target !== '_blank' && 
            !link.classList.contains('open-login-btn') && 
            !link.classList.contains('open-register-btn') && 
            !link.classList.contains('open-contact-btn') &&
            !link.hasAttribute('data-tab') &&
            !link.hasAttribute('data-pillar')) {
            
            link.addEventListener('click', (e) => {
                e.preventDefault();
                document.body.classList.remove('fade-in');
                setTimeout(() => {
                    window.location.href = href;
                }, 500);
            });
        }
    });
    
    /* ==========================================================================
       1. Navigasi & Mobile Menu Toggle
       ========================================================================== */
    // Helper function for precise smooth scrolling offset
    function scrollToTarget(targetEl) {
        if (!targetEl) return;
        const headerEl = document.querySelector('header');
        const headerHeight = headerEl ? headerEl.offsetHeight : 80;
        const elementPosition = targetEl.getBoundingClientRect().top + window.scrollY;
        const offsetPosition = elementPosition - headerHeight - 24; // 24px extra padding for perfect breathing room
        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }

    // Attach global smooth scroll logic for all anchor links starting with '#'
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const targetEl = document.querySelector(targetId);
            if (targetEl) {
                e.preventDefault();
                scrollToTarget(targetEl);
            }
        });
    });

    // Handle hash scrolling on page load
    if (window.location.hash) {
        const targetEl = document.querySelector(window.location.hash);
        if (targetEl) {
            setTimeout(() => {
                scrollToTarget(targetEl);
            }, 300);
        }
    }

    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenuCloseBtn = document.getElementById('mobile-menu-close-btn');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    const navLinks = document.querySelectorAll('.nav-scroll-link');

    if (mobileMenuBtn && mobileMenuOverlay && mobileMenuCloseBtn) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenuOverlay.classList.remove('hidden');
            setTimeout(() => {
                mobileMenuOverlay.classList.remove('opacity-0', 'translate-x-full');
            }, 10);
        });

        const closeMobileMenu = () => {
            mobileMenuOverlay.classList.add('opacity-0', 'translate-x-full');
            setTimeout(() => {
                mobileMenuOverlay.classList.add('hidden');
            }, 300);
        };

        mobileMenuCloseBtn.addEventListener('click', closeMobileMenu);
        
        // Close menu when clicking nav links
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                closeMobileMenu();
                // The global anchor click listener will handle the scrolling!
            });
        });
    }

    // Scroll Header Background & Padding Transition
    const header = document.querySelector('header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Scrollspy Logic: Dynamically highlight the active navbar item based on section scroll position
    const sections = document.querySelectorAll('section[id]');
    const desktopLinks = document.querySelectorAll('.nav-link');
    const mobileLinks = document.querySelectorAll('.nav-scroll-link');

    const updateActiveLink = () => {
        let currentSectionId = 'home'; // Default to home at the top of the page
        const scrollPosition = window.scrollY + 120; // Offset for header height and safe triggering

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSectionId = section.getAttribute('id');
            }
        });

        // Check if user is scrolled to the absolute bottom of the page
        if ((window.innerHeight + window.scrollY) >= document.documentElement.scrollHeight - 50) {
            const lastSection = sections[sections.length - 1];
            if (lastSection) {
                currentSectionId = lastSection.getAttribute('id');
            }
        }

        // Apply active class to desktop navigation links
        desktopLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href === `#${currentSectionId}`) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        // Apply active class to mobile drawer navigation links
        mobileLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href === `#${currentSectionId}`) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    };

    // Run Scrollspy on scroll and page load
    window.addEventListener('scroll', updateActiveLink);
    updateActiveLink();



    /* ==========================================================================
       2. Auto-Suggest Pencarian Hero
       ========================================================================== */
    const searchInput = document.getElementById('hero-search-input');
    const searchSuggestions = document.getElementById('search-suggestions');
    
    const getSearchSuggestionsData = () => {
        const newsItems = window.newsData ? Object.values(window.newsData).map(item => ({
            title: item.title,
            category: "Berita — " + item.category,
            targetId: item.id,
            isNews: true
        })) : [];
        return newsItems;
    };

    if (searchInput && searchSuggestions) {
        // Show suggestions on focus
        searchInput.addEventListener('focus', () => {
            showSuggestions(searchInput.value);
        });

        // Hide suggestions on click outside
        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                searchSuggestions.classList.add('hidden');
            }
        });

        // Filter and show suggestions on input
        searchInput.addEventListener('input', () => {
            showSuggestions(searchInput.value);
        });

        function showSuggestions(query) {
            currentLang = getCurrentLang();
            searchSuggestions.innerHTML = '';
            
            const allSuggestions = getSearchSuggestionsData();
            const filtered = query.trim() === '' 
                ? allSuggestions.slice(0, 5) // default top 5
                : allSuggestions.filter(item => 
                    item.title.toLowerCase().includes(query.toLowerCase()) || 
                    item.category.toLowerCase().includes(query.toLowerCase())
                  );

            if (filtered.length === 0) {
                const emptyLi = document.createElement('li');
                emptyLi.className = 'px-4 py-3 text-sm text-gray-400 italic';
                emptyLi.textContent = currentLang === 'en' ? `No results found for "${query}"` : `Tidak ditemukan hasil untuk "${query}"`;
                searchSuggestions.appendChild(emptyLi);
            } else {
                filtered.forEach(item => {
                    const li = document.createElement('li');
                    li.className = 'px-4 py-3 hover:bg-forest-800/50 cursor-pointer flex justify-between items-center transition border-b border-forest-800/20 last:border-0';
                    const translatedTitle = currentLang === 'en' ? (dictionary[item.title] || item.title) : item.title;
                    const translatedCategory = currentLang === 'en' ? (dictionary[item.category] || item.category) : item.category;
                    li.innerHTML = `
                        <div>
                            <span class="font-medium text-white block text-sm">${highlightMatch(translatedTitle, query)}</span>
                            <span class="text-xs text-gold-400/80">${translatedCategory}</span>
                        </div>
                        <svg class="w-4 h-4 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    `;
                    li.addEventListener('click', () => {
                        searchInput.value = item.title;
                        searchSuggestions.classList.add('hidden');
                        if (item.isNews) {
                            openNewsDrawer(item.targetId);
                        } else {
                            const targetEl = document.querySelector(item.targetId);
                            if (targetEl) {
                                scrollToTarget(targetEl);
                                
                                // Highlight the section briefly
                                targetEl.classList.add('ring-2', 'ring-gold-500/50');
                                setTimeout(() => {
                                    targetEl.classList.remove('ring-2', 'ring-gold-500/50');
                                }, 1500);
                            }
                        }
                    });
                    searchSuggestions.appendChild(li);
                });
            }
            searchSuggestions.classList.remove('hidden');
        }

        function highlightMatch(text, query) {
            if (!query) return text;
            const regex = new RegExp(`(${query})`, 'gi');
            return text.replace(regex, '<span class="text-gold-500 font-bold">$1</span>');
        }
    }

    // Quick tag search buttons
    const quickTags = document.querySelectorAll('.quick-tag');
    quickTags.forEach(tag => {
        tag.addEventListener('click', () => {
            const tagText = tag.getAttribute('data-tag') || tag.textContent.trim();
            if (searchInput) {
                searchInput.value = tagText;
                searchInput.focus();
                
                // Also scroll to pilar section if it's parahyangan/pawongan/palemahan
                if (['Parahyangan', 'Pawongan', 'Palemahan', 'Tri Hita Karana'].includes(tagText)) {
                    scrollToTarget(document.getElementById('tentang-thk'));
                } else if (tagText === 'THK Awards') {
                    scrollToTarget(document.getElementById('thk-awards'));
                }
            }
        });
    });


    /* ==========================================================================
       3. Animasi Angka Statistik (Counters)
       ========================================================================== */
    const statsSection = document.getElementById('stats-section');
    const counters = document.querySelectorAll('.stat-counter');
    let countersAnimated = false;

    if (statsSection && counters.length > 0) {
        const runCounters = () => {
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'), 10);
                const suffix = counter.getAttribute('data-suffix') || '';
                let current = 0;
                const duration = 1500; // 1.5s
                const stepTime = Math.max(Math.floor(duration / target), 15);
                
                const timer = setInterval(() => {
                    current += Math.ceil(target / 60);
                    if (current >= target) {
                        counter.textContent = target + suffix;
                        clearInterval(timer);
                    } else {
                        counter.textContent = current + suffix;
                    }
                }, stepTime);
            });
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !countersAnimated) {
                    runCounters();
                    countersAnimated = true;
                }
            });
        }, { threshold: 0.3 });

        observer.observe(statsSection);
    }


    /* ==========================================================================
       4. Switch Tab THK Awards
       ========================================================================== */
    const awardTabs = document.querySelectorAll('.award-tab');
    const awardShowcaseImage = document.getElementById('award-showcase-image');
    const awardShowcaseTitle = document.getElementById('award-showcase-title');
    const awardShowcaseDesc = document.getElementById('award-showcase-desc');
    const awardShowcaseBadges = document.getElementById('award-showcase-badges');
    const awardShowcaseAsesorInit = document.getElementById('award-showcase-asesor-init');
    const awardShowcaseAsesorName = document.getElementById('award-showcase-asesor-name');
    const awardShowcaseAsesorRole = document.getElementById('award-showcase-asesor-role');
    const awardShowcaseCard = document.getElementById('award-showcase-card');

    const awardTabDetails = window.awardTabDetails || {
        'desa-adat': {
            image: "/images/Kategori desa adat.jpg",
            title: "Kategori Desa Adat",
            desc: "Diberikan kepada desa adat yang menerapkan Tri Hita Karana secara nyata — dari pengelolaan Subak hingga pelestarian upacara adat dan ruang hijau desa.",
            badges: ["Penghargaan", "Komunitas", "Keberlanjutan"],
            asesorInit: "D",
            asesorName: "Tim Kurator THK Awards",
            asesorRole: "Kategori Aktif - 2026"
        },
        'individu': {
            image: "/images/Kategori Individu.jpg",
            title: "Kategori Individu",
            desc: "Apresiasi tertinggi untuk tokoh masyarakat, budayawan, atau aktivis lingkungan yang mendedikasikan hidupnya demi menjaga nilai kearifan lokal Bali dan kerukunan.",
            badges: ["Kepeloporan", "Inspiratif", "Sosial-Budaya"],
            asesorInit: "I",
            asesorName: "Dewan Juri THK",
            asesorRole: "Panel Penilai Utama"
        },
        'organisasi': {
            image: "/images/Kategori Organisasi.jpg",
            title: "Kategori Organisasi",
            desc: "Ditujukan bagi instansi pemerintah, yayasan, LSM, maupun badan usaha swasta yang berhasil menyelaraskan program kerjanya dengan tiga pilar kelestarian Bali.",
            badges: ["Sinergi", "Institusi", "Lingkungan"],
            asesorInit: "O",
            asesorName: "Tim Verifikator Independen",
            asesorRole: "Asosiasi Audit Eksternal"
        }
    };

    let activeAwardTab = 'desa-adat';

    if (awardTabs.length > 0 && awardShowcaseCard) {
        awardTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                currentLang = getCurrentLang();
                const category = tab.getAttribute('data-tab');
                activeAwardTab = category;
                const data = awardTabDetails[category];
                
                if (!data) return;

                // Toggle active tab classes
                awardTabs.forEach(t => {
                    t.classList.remove('border-gold-500', 'bg-forest-800/80');
                    t.classList.add('border-transparent', 'bg-forest-800/30');
                });
                tab.classList.add('border-gold-500', 'bg-forest-800/80');
                tab.classList.remove('border-transparent', 'bg-forest-800/30');

                // Animate transition
                awardShowcaseCard.style.opacity = '0';
                awardShowcaseCard.style.transform = 'translateY(15px)';
                
                setTimeout(() => {
                    // Safe property getters
                    const title = currentLang === 'en' 
                        ? (data.name_en || data.title_en || data.title || '') 
                        : (data.name_id || data.title_id || data.title || '');

                    const desc = currentLang === 'en' 
                        ? (data.description_en || data.desc_en || data.desc || '') 
                        : (data.description_id || data.desc_id || data.desc || '');

                    const badges = currentLang === 'en' 
                        ? (data.badges_en || data.badges || []) 
                        : (data.badges_id || data.badges || []);

                    const init = data.asesor_init || data.asesorInit || '';
                    const name = data.asesor_name || data.asesorName || '';
                    const role = data.asesor_role || data.asesorRole || '';

                    // Update content
                    if (awardShowcaseImage) awardShowcaseImage.src = data.image;
                    if (awardShowcaseTitle) awardShowcaseTitle.textContent = title;
                    if (awardShowcaseDesc) awardShowcaseDesc.textContent = desc;
                    
                    if (awardShowcaseBadges) {
                        awardShowcaseBadges.innerHTML = '';
                        const badgesList = Array.isArray(badges) ? badges : [];
                        badgesList.forEach(badge => {
                            const span = document.createElement('span');
                            span.className = 'px-3 py-1 text-xs border border-white/20 rounded-full text-white/80 tracking-wider uppercase bg-white/5';
                            span.textContent = currentLang === 'en' ? (dictionary[badge] || badge) : badge;
                            awardShowcaseBadges.appendChild(span);
                        });
                    }

                    if (awardShowcaseAsesorInit) awardShowcaseAsesorInit.textContent = init;
                    if (awardShowcaseAsesorName) awardShowcaseAsesorName.textContent = name;
                    if (awardShowcaseAsesorRole) awardShowcaseAsesorRole.textContent = role;

                    // Fade back in
                    awardShowcaseCard.style.opacity = '1';
                    awardShowcaseCard.style.transform = 'translateY(0)';
                }, 250);
            });
        });
    }

    /* Interactive Timeline Steps */
    const timelineNodes = document.querySelectorAll('.timeline-node');
    const timelineSteps = document.querySelectorAll('.timeline-step-detail');
    const timelineProgress = document.getElementById('timeline-progress-bar');
    
    if (timelineNodes.length > 0 && timelineProgress) {
        timelineNodes.forEach((node, index) => {
            node.addEventListener('click', () => {
                // Update node highlights
                timelineNodes.forEach((n, i) => {
                    if (i <= index) {
                        n.classList.remove('border-forest-400', 'bg-forest-900', 'text-forest-400');
                        n.classList.add('border-gold-500', 'bg-gold-500', 'text-forest-900', 'shadow-[0_0_10px_rgba(197,158,87,0.5)]');
                    } else {
                        n.classList.remove('border-gold-500', 'bg-gold-500', 'text-forest-900', 'shadow-[0_0_10px_rgba(197,158,87,0.5)]');
                        n.classList.add('border-forest-400', 'bg-forest-900', 'text-forest-400');
                    }
                });
                
                // Update progress bar width
                const pct = (index / (timelineNodes.length - 1)) * 100;
                timelineProgress.style.width = `${pct}%`;

                // Highlight content detail
                timelineSteps.forEach((step, i) => {
                    if (i === index) {
                        step.classList.add('scale-105', 'text-white');
                        step.classList.remove('opacity-60');
                    } else {
                        step.classList.remove('scale-105', 'text-white');
                        step.classList.add('opacity-60');
                    }
                });
            });
        });
    }


    /* ==========================================================================
       5. Penyaringan Kategori Berita (News Filter)
       ========================================================================== */
    const filterButtons = document.querySelectorAll('.news-filter-btn');
    const newsCards = document.querySelectorAll('.news-card');

    if (filterButtons.length > 0 && newsCards.length > 0) {
        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.getAttribute('data-filter');

                // Toggle active filter button style
                filterButtons.forEach(b => {
                    b.classList.remove('bg-forest-500', 'text-white', 'border-transparent');
                    b.classList.add('border-beige-300', 'text-forest-700/80', 'bg-transparent');
                });
                btn.classList.add('bg-forest-500', 'text-white', 'border-transparent');
                btn.classList.remove('border-beige-300', 'text-forest-700/80', 'bg-transparent');

                // Filter cards with animations
                newsCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    if (filter === 'Semua' || category === filter) {
                        card.classList.remove('hidden');
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        }, 50);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            card.classList.add('hidden');
                        }, 300);
                    }
                });
            });
        });
    }


    /* ==========================================================================
       6. Lightbox Galeri Foto
       ========================================================================== */
    const galleryItems = document.querySelectorAll('.gallery-item');
    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');
    
    let currentGalleryIndex = 0;
    const galleryImages = [];

    galleryItems.forEach((item, index) => {
        const img = item.querySelector('img');
        const title = item.getAttribute('data-title') || 'Dokumentasi THK Bali';
        if (img) {
            galleryImages.push({
                src: img.src,
                caption: title
            });

            item.addEventListener('click', () => {
                currentGalleryIndex = index;
                openLightbox();
            });
        }
    });

    if (lightbox && lightboxImage && lightboxClose) {
        function openLightbox() {
            currentLang = getCurrentLang();
            updateLightboxContent();
            lightbox.classList.remove('hidden', 'opacity-0');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden'; // Lock scrolling
        }

        function closeLightbox() {
            lightbox.classList.add('opacity-0');
            setTimeout(() => {
                lightbox.classList.add('hidden');
                lightbox.classList.remove('flex');
                document.body.style.overflow = '';
            }, 300);
        }

        function updateLightboxContent() {
            const item = galleryImages[currentGalleryIndex];
            if (item) {
                lightboxImage.src = item.src;
                lightboxCaption.textContent = currentLang === 'en' ? (dictionary[item.caption] || item.caption) : item.caption;
            }
        }

        lightboxClose.addEventListener('click', closeLightbox);
        
        lightboxPrev.addEventListener('click', (e) => {
            e.stopPropagation();
            currentGalleryIndex = (currentGalleryIndex - 1 + galleryImages.length) % galleryImages.length;
            updateLightboxContent();
        });

        lightboxNext.addEventListener('click', (e) => {
            e.stopPropagation();
            currentGalleryIndex = (currentGalleryIndex + 1) % galleryImages.length;
            updateLightboxContent();
        });

        // Close lightbox when clicking overlay outside image
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });

        // Handle Escape, Left and Right keys
        document.addEventListener('keydown', (e) => {
            if (lightbox.classList.contains('hidden')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') {
                currentGalleryIndex = (currentGalleryIndex - 1 + galleryImages.length) % galleryImages.length;
                updateLightboxContent();
            }
            if (e.key === 'ArrowRight') {
                currentGalleryIndex = (currentGalleryIndex + 1) % galleryImages.length;
                updateLightboxContent();
            }
        });
    }


    /* ==========================================================================
       7. Modal Controller (Login / Register / Hubungi Kami)
       ========================================================================== */
    const authModal = document.getElementById('auth-modal');
    const authModalClose = document.getElementById('auth-modal-close');
    const openLoginBtns = document.querySelectorAll('.open-login-btn');
    const openRegisterBtns = document.querySelectorAll('.open-register-btn');
    
    const tabLoginBtn = document.getElementById('tab-login');
    const tabRegisterBtn = document.getElementById('tab-register');
    const formLogin = document.getElementById('form-login');
    const formRegister = document.getElementById('form-register');
    const formResetPassword = document.getElementById('form-reset-password');
    const btnForgotPassword = document.getElementById('btn-forgot-password');
    const btnBackToLogin = document.getElementById('btn-back-to-login');

    // Contact Us Modal
    const contactModal = document.getElementById('contact-modal');
    const contactModalClose = document.getElementById('contact-modal-close');
    const openContactBtns = document.querySelectorAll('.open-contact-btn');
    const contactForm = document.getElementById('contact-form');

    // Open Login
    openLoginBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            switchTab('login');
            openModal(authModal);
        });
    });

    // Open Register
    openRegisterBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            switchTab('register');
            openModal(authModal);
        });
    });

    // Close Auth Modal
    if (authModalClose) {
        authModalClose.addEventListener('click', () => closeModal(authModal));
    }

    // Switch Tab Auth Modal
    if (tabLoginBtn && tabRegisterBtn && formLogin && formRegister) {
        tabLoginBtn.addEventListener('click', () => switchTab('login'));
        tabRegisterBtn.addEventListener('click', () => switchTab('register'));
    }


    const paymentInfoStep = document.getElementById('payment-info-step');
    const btnProceedToRegister = document.getElementById('btn-proceed-to-register');
    let paymentInfoLoaded = false;

    function loadPaymentInfo() {
        if (paymentInfoLoaded) return;
        fetch('/payment-info')
            .then(r => r.json())
            .then(data => {
                paymentInfoLoaded = true;
                const placeholder = document.getElementById('pay-qr-placeholder');
                if (placeholder) placeholder.classList.add('hidden');

                const bankName = document.getElementById('pay-bank-name');
                const accNum = document.getElementById('pay-account-number');
                const accName = document.getElementById('pay-account-name');
                const amount = document.getElementById('pay-amount');
                const desc = document.getElementById('pay-description');
                const qrContainer = document.getElementById('pay-qr-container');
                const qrImg = document.getElementById('pay-qr-img');

                if (bankName) bankName.textContent = data.bank_name || '-';
                if (accNum) accNum.textContent = data.account_number || '-';
                if (accName) accName.textContent = 'a/n ' + (data.account_name || '-');
                if (amount) amount.textContent = data.amount || '-';

                if (desc && data.description) {
                    desc.textContent = data.description;
                    desc.classList.remove('hidden');
                }
                if (qrImg && qrContainer && data.qr_image) {
                    qrImg.src = '/' + data.qr_image;
                    qrContainer.classList.remove('hidden');
                    qrContainer.classList.add('flex');
                }
            })
            .catch(() => {
                const placeholder = document.getElementById('pay-qr-placeholder');
                if (placeholder) { placeholder.innerHTML = '<span class="text-xs text-red-400">Gagal memuat info pembayaran.</span>'; }
            });
    }

    function switchTab(tab) {
        if (tab === 'login') {
            tabLoginBtn.classList.add('border-forest-500', 'text-forest-950');
            tabLoginBtn.classList.remove('border-transparent', 'text-forest-400', 'hover:text-forest-800');
            tabRegisterBtn.classList.add('border-transparent', 'text-forest-400', 'hover:text-forest-800');
            tabRegisterBtn.classList.remove('border-forest-500', 'text-forest-950');

            formLogin.classList.remove('hidden');
            formRegister.classList.add('hidden');
            if (paymentInfoStep) paymentInfoStep.classList.add('hidden');
            if (formResetPassword) formResetPassword.classList.add('hidden');
        } else {
            tabRegisterBtn.classList.add('border-forest-500', 'text-forest-950');
            tabRegisterBtn.classList.remove('border-transparent', 'text-forest-400', 'hover:text-forest-800');
            tabLoginBtn.classList.add('border-transparent', 'text-forest-400', 'hover:text-forest-800');
            tabLoginBtn.classList.remove('border-forest-500', 'text-forest-950');

            formLogin.classList.add('hidden');
            if (formResetPassword) formResetPassword.classList.add('hidden');

            // Show payment info step first, keep form hidden
            if (paymentInfoStep) {
                paymentInfoStep.classList.remove('hidden');
                loadPaymentInfo();
                
                // Reset payment proof file input and proceed button
                if (regPaymentProof) regPaymentProof.value = '';
                if (btnProceedToRegister) {
                    btnProceedToRegister.classList.add('opacity-50', 'pointer-events-none');
                    btnProceedToRegister.classList.remove('hover:bg-forest-950', 'cursor-pointer');
                    btnProceedToRegister.innerHTML = '<i class="fas fa-check-circle"></i> Bukti Pembayaran Belum Diunggah';
                }
            }
            formRegister.classList.add('hidden');
        }
    }

    const regPaymentProof = document.getElementById('reg-payment-proof');
    if (regPaymentProof && btnProceedToRegister) {
        regPaymentProof.addEventListener('change', () => {
            if (regPaymentProof.files && regPaymentProof.files.length > 0) {
                // Enable button
                btnProceedToRegister.classList.remove('opacity-50', 'pointer-events-none');
                btnProceedToRegister.classList.add('hover:bg-forest-950', 'cursor-pointer');
                btnProceedToRegister.innerHTML = '<i class="fas fa-check-circle"></i> Saya Sudah Melakukan Pembayaran &rarr; Isi Form';
            } else {
                // Disable button
                btnProceedToRegister.classList.add('opacity-50', 'pointer-events-none');
                btnProceedToRegister.classList.remove('hover:bg-forest-950', 'cursor-pointer');
                btnProceedToRegister.innerHTML = '<i class="fas fa-check-circle"></i> Bukti Pembayaran Belum Diunggah';
            }
        });
    }

    if (btnProceedToRegister) {
        btnProceedToRegister.addEventListener('click', () => {
            if (paymentInfoStep) paymentInfoStep.classList.add('hidden');
            formRegister.classList.remove('hidden');
            // Reset to Peserta role to show peserta fields
            const regRole = document.getElementById('reg-role');
            if (regRole && regRole.value !== 'peserta') {
                regRole.value = 'peserta';
            }
            if (typeof toggleRegisterFields === 'function') toggleRegisterFields();
        });
    }


    // Forgot Password Transition
    if (btnForgotPassword && formResetPassword && formLogin) {
        btnForgotPassword.addEventListener('click', (e) => {
            e.preventDefault();
            formLogin.classList.add('hidden');
            formRegister.classList.add('hidden');
            formResetPassword.classList.remove('hidden');
            
            // Deactivate both tabs style
            tabLoginBtn.classList.remove('border-forest-500', 'text-forest-950');
            tabLoginBtn.classList.add('border-transparent', 'text-forest-400');
            tabRegisterBtn.classList.remove('border-forest-500', 'text-forest-950');
            tabRegisterBtn.classList.add('border-transparent', 'text-forest-400');
        });
    }

    if (btnBackToLogin) {
        btnBackToLogin.addEventListener('click', (e) => {
            e.preventDefault();
            switchTab('login');
        });
    }

    // Toggle Login Password Visibility
    const toggleLoginPassBtn = document.getElementById('toggle-login-pass');
    const loginPassInput = document.getElementById('login-pass');
    if (toggleLoginPassBtn && loginPassInput) {
        toggleLoginPassBtn.addEventListener('click', () => {
            const isPass = loginPassInput.getAttribute('type') === 'password';
            loginPassInput.setAttribute('type', isPass ? 'text' : 'password');
            const icon = toggleLoginPassBtn.querySelector('i');
            if (icon) {
                if (isPass) {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        });
    }

    // Toggle Register Password Visibility
    const toggleRegPassBtn = document.getElementById('toggle-reg-pass');
    const regPassInput = document.getElementById('reg-pass');
    if (toggleRegPassBtn && regPassInput) {
        toggleRegPassBtn.addEventListener('click', () => {
            const isPass = regPassInput.getAttribute('type') === 'password';
            regPassInput.setAttribute('type', isPass ? 'text' : 'password');
            const icon = toggleRegPassBtn.querySelector('i');
            if (icon) {
                if (isPass) {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        });
    }

    // Toggle Reset Password Visibility
    const toggleResetPassBtn = document.getElementById('toggle-reset-pass');
    const resetPassInput = document.getElementById('reset-pass');
    if (toggleResetPassBtn && resetPassInput) {
        toggleResetPassBtn.addEventListener('click', () => {
            const isPass = resetPassInput.getAttribute('type') === 'password';
            resetPassInput.setAttribute('type', isPass ? 'text' : 'password');
            const icon = toggleResetPassBtn.querySelector('i');
            if (icon) {
                if (isPass) {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        });
    }

    const toggleResetPassConfirmBtn = document.getElementById('toggle-reset-pass-confirm');
    const resetPassConfirmInput = document.getElementById('reset-pass-confirm');
    if (toggleResetPassConfirmBtn && resetPassConfirmInput) {
        toggleResetPassConfirmBtn.addEventListener('click', () => {
            const isPass = resetPassConfirmInput.getAttribute('type') === 'password';
            resetPassConfirmInput.setAttribute('type', isPass ? 'text' : 'password');
            const icon = toggleResetPassConfirmBtn.querySelector('i');
            if (icon) {
                if (isPass) {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        });
    }

    // Contact Modal Open
    openContactBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal(contactModal);
        });
    });

    if (contactModalClose) {
        contactModalClose.addEventListener('click', () => closeModal(contactModal));
    }

    function openModal(modalEl) {
        if (!modalEl) return;
        hideWhatsAppWidget();
        modalEl.classList.remove('hidden', 'opacity-0');
        modalEl.classList.add('flex');
        document.body.style.overflow = 'hidden';
        
        // Modal zoom animation
        const dialog = modalEl.querySelector('.modal-dialog');
        if (dialog) {
            setTimeout(() => {
                dialog.classList.remove('scale-95', 'opacity-0');
                dialog.classList.add('scale-100', 'opacity-100');
            }, 10);
        }
    }

    function closeModal(modalEl) {
        if (!modalEl) return;
        const dialog = modalEl.querySelector('.modal-dialog');
        if (dialog) {
            dialog.classList.add('scale-95', 'opacity-0');
            dialog.classList.remove('scale-100', 'opacity-100');
        }
        
        setTimeout(() => {
            modalEl.classList.add('opacity-0');
            setTimeout(() => {
                modalEl.classList.add('hidden');
                modalEl.classList.remove('flex');
                document.body.style.overflow = '';
                showWhatsAppWidget();
            }, 150);
        }, 100);
    }

    // Helper to display alert notices inside modals
    function showAuthAlert(alertId, message, type = 'success') {
        const alertEl = document.getElementById(alertId);
        const iconEl = document.getElementById(`${alertId}-icon`);
        const msgEl = document.getElementById(`${alertId}-msg`);
        
        if (!alertEl || !msgEl || !iconEl) return;

        alertEl.className = "p-4 rounded-2xl text-xs font-bold transition-all duration-300 transform scale-95 opacity-0 flex items-start gap-3";
        if (type === 'success') {
            alertEl.classList.add('bg-emerald-500/15', 'border', 'border-emerald-500/30', 'text-emerald-700');
            iconEl.innerHTML = '<i class="fas fa-check-circle text-base"></i>';
        } else {
            alertEl.classList.add('bg-rose-500/15', 'border', 'border-rose-500/30', 'text-rose-700');
            iconEl.innerHTML = '<i class="fas fa-exclamation-circle text-base"></i>';
        }

        msgEl.textContent = message;
        alertEl.classList.remove('hidden');

        setTimeout(() => {
            alertEl.classList.remove('scale-95', 'opacity-0');
            alertEl.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function hideAuthAlert(alertId) {
        const alertEl = document.getElementById(alertId);
        if (!alertEl) return;
        alertEl.classList.remove('scale-100', 'opacity-100');
        alertEl.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            alertEl.classList.add('hidden');
        }, 300);
    }

    // Modal Unggah Berkas Trigger
    const uploadModal = document.getElementById('upload-proposal-modal');
    const openUploadBtn = document.getElementById('open-upload-btn');
    const openUploadBtnMobile = document.getElementById('open-upload-btn-mobile');
    const uploadModalCloseBtn = document.getElementById('upload-modal-close');
    const formUploadProposal = document.getElementById('form-upload-proposal');

    if (openUploadBtn) {
        openUploadBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal(uploadModal);
        });
    }

    if (openUploadBtnMobile) {
        openUploadBtnMobile.addEventListener('click', (e) => {
            e.preventDefault();
            closeMobileMenu();
            openModal(uploadModal);
        });
    }

    if (uploadModalCloseBtn) {
        uploadModalCloseBtn.addEventListener('click', () => {
            closeModal(uploadModal);
            hideAuthAlert('upload-alert');
        });
    }

    // Form Submission Actions
    if (formLogin) {
        formLogin.addEventListener('submit', (e) => {
            e.preventDefault();
            hideAuthAlert('auth-alert');

            const email = document.getElementById('login-email').value;
            const pass = document.getElementById('login-pass').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ email, password: pass })
            })
            .then(res => {
                if (!res.ok) {
                    return res.json().then(err => { throw err; });
                }
                return res.json();
            })
            .then(data => {
                showAuthAlert('auth-alert', data.message, 'success');
                setTimeout(() => {
                    closeModal(authModal);
                    if (data.redirect_url && data.redirect_url !== '/') {
                        window.location.href = data.redirect_url;
                    } else {
                        window.location.reload();
                    }
                }, 1200);
            })
            .catch(err => {
                showAuthAlert('auth-alert', err.message || 'Gagal masuk. Silakan periksa kembali email dan kata sandi Anda.', 'error');
            });
        });
    }

    if (formRegister) {
        formRegister.addEventListener('submit', (e) => {
            e.preventDefault();
            hideAuthAlert('auth-alert');

            const formData = new FormData(formRegister);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Show loading state
            const submitBtn = formRegister.querySelector('button[type="submit"]');
            const originalText = submitBtn ? submitBtn.textContent : 'Kirim Pendaftaran';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Mengirim...';
            }

            fetch('/register', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(res => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
                if (!res.ok) {
                    return res.json().then(err => { throw err; });
                }
                return res.json();
            })
            .then(data => {
                // Show a persistent success notice with a login button — no auto redirect
                const alertContainer = document.getElementById('auth-alert');
                if (alertContainer) {
                    alertContainer.innerHTML = `
                        <div class="flex flex-col gap-2 w-full">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-emerald-800 text-sm font-medium leading-snug">${data.message}</span>
                            </div>
                            <button id="go-to-login-btn" type="button" class="self-start mt-1 px-4 py-1.5 bg-forest-900 text-white rounded-full text-xs font-bold hover:bg-forest-950 transition cursor-pointer">
                                Masuk Sekarang &rarr;
                            </button>
                        </div>
                    `;
                    alertContainer.classList.remove('hidden');
                    alertContainer.classList.add('bg-emerald-50', 'border', 'border-emerald-200', 'rounded-2xl', 'p-3');

                    document.getElementById('go-to-login-btn')?.addEventListener('click', () => {
                        switchTab('login');
                        document.getElementById('login-email').value = data.email || '';
                        document.getElementById('login-pass').value = '';
                        document.getElementById('login-pass').focus();
                        formRegister.reset();
                        if (typeof toggleRegisterFields === 'function') {
                            toggleRegisterFields();
                        }
                        alertContainer.classList.add('hidden');
                        alertContainer.innerHTML = '';
                        alertContainer.classList.remove('bg-emerald-50', 'border', 'border-emerald-200', 'rounded-2xl', 'p-3');
                    });
                }
            })
            .catch(err => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
                showAuthAlert('auth-alert', err.message || 'Pendaftaran gagal. Silakan coba kembali.', 'error');
            });
        });
    }

    if (formResetPassword) {
        formResetPassword.addEventListener('submit', (e) => {
            e.preventDefault();
            hideAuthAlert('auth-alert');

            const email = document.getElementById('reset-email').value;
            const pass = document.getElementById('reset-pass').value;
            const passConfirm = document.getElementById('reset-pass-confirm').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/forgot-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    email: email,
                    password: pass,
                    password_confirmation: passConfirm
                })
            })
            .then(res => {
                if (!res.ok) {
                    return res.json().then(err => { throw err; });
                }
                return res.json();
            })
            .then(data => {
                showAuthAlert('auth-alert', data.message, 'success');
                setTimeout(() => {
                    // Switch to login tab and autofill email
                    switchTab('login');
                    document.getElementById('login-email').value = email;
                    document.getElementById('login-pass').value = '';
                    document.getElementById('login-pass').focus();
                    
                    // Clear reset form
                    formResetPassword.reset();
                    hideAuthAlert('auth-alert');
                }, 2000);
            })
            .catch(err => {
                showAuthAlert('auth-alert', err.message || 'Gagal mengatur ulang kata sandi. Silakan coba kembali.', 'error');
            });
        });
    }

    if (formUploadProposal) {
        formUploadProposal.addEventListener('submit', (e) => {
            e.preventDefault();
            hideAuthAlert('upload-alert');

            const formData = new FormData(formUploadProposal);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const submitBtn = document.getElementById('btn-submit-proposal');
            const submitText = document.getElementById('btn-submit-text');
            const spinner = document.getElementById('upload-spinner');
            const progressContainer = document.getElementById('upload-progress-container');
            const progressBar = document.getElementById('upload-progress-bar');
            const progressPercent = document.getElementById('upload-progress-percent');

            // Set loading state
            if (submitBtn) submitBtn.disabled = true;
            if (submitText) submitText.textContent = 'Mengirim...';
            if (spinner) spinner.classList.remove('hidden');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/proposal/upload');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

            xhr.upload.addEventListener('progress', (e) => {
                if (e.lengthComputable) {
                    const percentComplete = Math.round((e.loaded / e.total) * 100);
                    if (progressContainer) progressContainer.classList.remove('hidden');
                    if (progressBar) progressBar.style.width = percentComplete + '%';
                    if (progressPercent) progressPercent.textContent = percentComplete + '%';
                }
            });

            xhr.onload = () => {
                // Reset states
                if (submitBtn) submitBtn.disabled = false;
                if (submitText) submitText.textContent = 'Unggah Sekarang';
                if (spinner) spinner.classList.add('hidden');
                if (progressContainer) progressContainer.classList.add('hidden');
                if (progressBar) progressBar.style.width = '0%';
                if (progressPercent) progressPercent.textContent = '0%';

                if (xhr.status >= 200 && xhr.status < 300) {
                    const data = JSON.parse(xhr.responseText);
                    showAuthAlert('upload-alert', data.message, 'success');
                    formUploadProposal.reset();
                    setTimeout(() => {
                        closeModal(uploadModal);
                        window.location.reload();
                    }, 2000);
                } else {
                    let errorMessage = 'Gagal mengunggah berkas.';
                    try {
                        const data = JSON.parse(xhr.responseText);
                        if (data.message) errorMessage = data.message;
                    } catch(e) {}
                    showAuthAlert('upload-alert', errorMessage, 'error');
                }
            };

            xhr.onerror = () => {
                if (submitBtn) submitBtn.disabled = false;
                if (submitText) submitText.textContent = 'Unggah Sekarang';
                if (spinner) spinner.classList.add('hidden');
                if (progressContainer) progressContainer.classList.add('hidden');
                showAuthAlert('upload-alert', 'Koneksi bermasalah. Gagal mengirim data.', 'error');
            };

            xhr.send(formData);
        });
    }

    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Pesan Anda telah dikirim! Tim THK Bali akan menghubungi Anda segera.');
            closeModal(contactModal);
            contactForm.reset();
        });
    }

    // Close modals when clicking backdrop
    window.addEventListener('click', (e) => {
        if (e.target === authModal) {
            closeModal(authModal);
            hideAuthAlert('auth-alert');
        }
        if (e.target === contactModal) closeModal(contactModal);
        if (e.target === uploadModal) {
            closeModal(uploadModal);
            hideAuthAlert('upload-alert');
        }
    });

    // Escape key closes open modal
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeModal(authModal);
            hideAuthAlert('auth-alert');
            closeModal(contactModal);
            closeModal(uploadModal);
            hideAuthAlert('upload-alert');
        }
    });


    /* ==========================================================================
       8. Scroll Reveal Animations (IntersectionObserver)
       ========================================================================== */
    const revealElements = document.querySelectorAll('.scroll-reveal');
    
    if (revealElements.length > 0) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                } else {
                    entry.target.classList.remove('active');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px' // Trigger slightly before it fully enters viewport
        });

        revealElements.forEach(el => {
            revealObserver.observe(el);
        });
    }


    /* ==========================================================================
       9. Pilar Slide-over Drawer Controller
       ========================================================================== */
    const drawerBackdrop = document.getElementById('pilar-drawer-backdrop');
    const drawer = document.getElementById('pilar-drawer');
    const drawerCloseBtn = document.getElementById('pilar-drawer-close');
    const drawerActionBtn = document.getElementById('pilar-drawer-action');
    const learnMoreBtns = document.querySelectorAll('.learn-more-btn');
    const drawerTitle = document.getElementById('drawer-title');
    const drawerBadge = document.getElementById('drawer-badge');

    // Function to open drawer
    function openPilarDrawer(pillarKey) {
        currentLang = getCurrentLang();
        if (!drawer || !drawerBackdrop) return;
        hideWhatsAppWidget();

        // Hide all pilar content sections first
        document.querySelectorAll('.pilar-content-section').forEach(sec => {
            sec.classList.add('hidden');
        });

        // Show the specific content section
        const contentSec = document.getElementById(`drawer-content-${pillarKey}`);
        if (contentSec) {
            contentSec.classList.remove('hidden');
        }

        // Set Title & Badge dynamically
        if (pillarKey === 'parahyangan') {
            drawerTitle.textContent = 'Parahyangan';
            drawerBadge.textContent = currentLang === 'en' ? 'Relationship with God' : 'Hubungan dengan Tuhan';
        } else if (pillarKey === 'pawongan') {
            drawerTitle.textContent = 'Pawongan';
            drawerBadge.textContent = currentLang === 'en' ? 'Relationship Among People' : 'Hubungan Antar Manusia';
        } else if (pillarKey === 'palemahan') {
            drawerTitle.textContent = 'Palemahan';
            drawerBadge.textContent = currentLang === 'en' ? 'Relationship with Nature' : 'Hubungan dengan Alam';
        }

        // Trigger drawer entrance animation
        drawerBackdrop.classList.remove('hidden');
        setTimeout(() => {
            drawerBackdrop.classList.remove('opacity-0');
            drawerBackdrop.classList.add('opacity-100');
            drawer.classList.remove('translate-x-full');
            drawer.classList.add('translate-x-0');
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    // Function to close drawer
    function closePilarDrawer() {
        if (!drawer || !drawerBackdrop) return;

        drawer.classList.remove('translate-x-0');
        drawer.classList.add('translate-x-full');
        
        drawerBackdrop.classList.remove('opacity-100');
        drawerBackdrop.classList.add('opacity-0');

        setTimeout(() => {
            drawerBackdrop.classList.add('hidden');
            document.body.style.overflow = '';
            showWhatsAppWidget();
        }, 300); // match duration-300 transition
    }

    // Attach listeners
    learnMoreBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const pillar = btn.getAttribute('data-pillar');
            openPilarDrawer(pillar);
        });
    });

    if (drawerCloseBtn) {
        drawerCloseBtn.addEventListener('click', closePilarDrawer);
    }
    if (drawerActionBtn) {
        drawerActionBtn.addEventListener('click', closePilarDrawer);
    }
    if (drawerBackdrop) {
        drawerBackdrop.addEventListener('click', closePilarDrawer);
    }

    // Escape key listener for drawer
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && drawer && !drawer.classList.contains('translate-x-full')) {
            closePilarDrawer();
        }
    });


    /* ==========================================================================
       10. THK Awards Slide-over Drawer Controller
       ========================================================================== */
    const awardDrawerBackdrop = document.getElementById('award-drawer-backdrop');
    const awardDrawer = document.getElementById('award-drawer');
    const awardDrawerCloseBtn = document.getElementById('award-drawer-close');
    const awardDrawerActionBtn = document.getElementById('award-drawer-action');
    const awardShowcaseBtn = document.getElementById('award-showcase-btn');
    const awardDrawerTitle = document.getElementById('award-drawer-title');
    const awardDrawerBadge = document.getElementById('award-drawer-badge');

    // Function to open award drawer
    function openAwardDrawer(categoryKey) {
        currentLang = getCurrentLang();
        if (!awardDrawer || !awardDrawerBackdrop) return;
        hideWhatsAppWidget();

        // Hide all award content sections first
        document.querySelectorAll('.award-content-section').forEach(sec => {
            sec.classList.add('hidden');
        });

        // Show the specific content section
        const contentSec = document.getElementById(`drawer-content-${categoryKey}`);
        if (contentSec) {
            contentSec.classList.remove('hidden');
        }

        // Set Title & Badge dynamically
        if (categoryKey === 'desa-adat') {
            awardDrawerTitle.textContent = currentLang === 'en' ? 'Customary Village Category' : 'Kategori Desa Adat';
            awardDrawerBadge.textContent = currentLang === 'en' ? 'THK Awards — Customary Village' : 'THK Awards — Desa Adat';
        } else if (categoryKey === 'individu') {
            awardDrawerTitle.textContent = currentLang === 'en' ? 'Individual Category' : 'Kategori Individu';
            awardDrawerBadge.textContent = currentLang === 'en' ? 'THK Awards — Individual' : 'THK Awards — Perorangan';
        } else if (categoryKey === 'lembaga-pendidikan') {
            awardDrawerTitle.textContent = currentLang === 'en' ? 'Education Institute Category' : 'Kategori Lembaga Pendidikan';
            awardDrawerBadge.textContent = currentLang === 'en' ? 'THK Awards — Education Institute' : 'THK Awards — Lembaga Pendidikan';
        } else if (categoryKey === 'akomodasi') {
            awardDrawerTitle.textContent = currentLang === 'en' ? 'Accommodation Category' : 'Kategori Akomodasi';
            awardDrawerBadge.textContent = currentLang === 'en' ? 'THK Awards — Accommodation' : 'THK Awards — Akomodasi';
        } else if (categoryKey === 'destinasi') {
            awardDrawerTitle.textContent = currentLang === 'en' ? 'Destination Category' : 'Kategori Destinasi';
            awardDrawerBadge.textContent = currentLang === 'en' ? 'THK Awards — Destination' : 'THK Awards — Destinasi';
        } else if (categoryKey === 'restoran') {
            awardDrawerTitle.textContent = currentLang === 'en' ? 'Restaurant Category' : 'Kategori Restoran';
            awardDrawerBadge.textContent = currentLang === 'en' ? 'THK Awards — Restaurant' : 'THK Awards — Restoran';
        }

        // Dynamically filter awardees list in the left slide panel
        const seeVillagesBtn = document.getElementById('award-drawer-see-villages');
        const villageSelect = document.getElementById('awardee-village-select');
        
        if (villageSelect && seeVillagesBtn) {
            // Clear existing options
            villageSelect.innerHTML = '<option value="" disabled selected>-- Pilih Penerima --</option>';
            
            const awardees = window.awardeesData || [];
            const filteredAwardees = awardees.filter(aw => aw.category_key === categoryKey);
            
            if (filteredAwardees.length > 0) {
                filteredAwardees.forEach(aw => {
                    const opt = document.createElement('option');
                    opt.value = aw.id;
                    opt.textContent = `${aw.name} (${aw.medal} - ${aw.year})`;
                    villageSelect.appendChild(opt);
                });
                seeVillagesBtn.classList.remove('hidden');
            } else {
                seeVillagesBtn.classList.add('hidden');
            }
        }

        // Trigger drawer entrance animation
        awardDrawerBackdrop.classList.remove('hidden');
        setTimeout(() => {
            awardDrawerBackdrop.classList.remove('opacity-0');
            awardDrawerBackdrop.classList.add('opacity-100');
            awardDrawer.classList.remove('translate-x-full');
            awardDrawer.classList.add('translate-x-0');
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    function hideLanguageWidget() {
        const widget = document.getElementById('google-translate-container');
        if (widget) {
            widget.classList.add('hidden');
        }
    }

    function showLanguageWidget() {
        const widget = document.getElementById('google-translate-container');
        if (widget) {
            widget.classList.remove('hidden');
        }
    }

    // Function to close award drawer
    function closeAwardDrawer() {
        if (!awardDrawer || !awardDrawerBackdrop) return;

        // Reset sliding villages panel state
        const awardeeVillagesPanel = document.getElementById('awardee-villages-panel');
        const awardeeVillageSelect = document.getElementById('awardee-village-select');
        const awardeeVillageDetail = document.getElementById('awardee-village-detail');
        const awardeeVillagePlaceholder = document.getElementById('awardee-village-placeholder');

        if (awardeeVillagesPanel) {
            awardeeVillagesPanel.style.transform = 'translateX(-100%)';
        }
        if (awardeeVillageSelect) {
            awardeeVillageSelect.value = '';
        }
        if (awardeeVillageDetail) awardeeVillageDetail.classList.add('hidden');
        if (awardeeVillagePlaceholder) awardeeVillagePlaceholder.classList.remove('hidden');

        awardDrawer.classList.remove('translate-x-0');
        awardDrawer.classList.add('translate-x-full');
        
        awardDrawerBackdrop.classList.remove('opacity-100');
        awardDrawerBackdrop.classList.add('opacity-0');

        setTimeout(() => {
            awardDrawerBackdrop.classList.add('hidden');
            document.body.style.overflow = '';
            showWhatsAppWidget();
            showLanguageWidget();
        }, 300); // match duration-300 transition
    }

    // Attach listeners
    if (awardShowcaseBtn) {
        awardShowcaseBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openAwardDrawer(activeAwardTab);
        });
    }

    if (awardDrawerCloseBtn) {
        awardDrawerCloseBtn.addEventListener('click', closeAwardDrawer);
    }
    if (awardDrawerActionBtn) {
        awardDrawerActionBtn.addEventListener('click', closeAwardDrawer);
    }
    if (awardDrawerBackdrop) {
        awardDrawerBackdrop.addEventListener('click', closeAwardDrawer);
    }

    // Escape key listener for award drawer
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && awardDrawer && !awardDrawer.classList.contains('translate-x-full')) {
            closeAwardDrawer();
        }
    });

    // Awardee Customary Villages Sliding Panel Controller
    const awardeeVillagesPanel = document.getElementById('awardee-villages-panel');
    const awardeeVillagesPanelBack = document.getElementById('awardee-villages-panel-back');
    const awardDrawerSeeVillagesBtn = document.getElementById('award-drawer-see-villages');
    const awardeeVillageSelect = document.getElementById('awardee-village-select');
    const awardeeVillageDetail = document.getElementById('awardee-village-detail');
    const awardeeVillagePlaceholder = document.getElementById('awardee-village-placeholder');

    if (awardDrawerSeeVillagesBtn && awardeeVillagesPanel) {
        awardDrawerSeeVillagesBtn.addEventListener('click', () => {
            awardeeVillagesPanel.style.transform = 'translateX(0)';
            hideLanguageWidget();
        });
    }

    if (awardeeVillagesPanelBack && awardeeVillagesPanel) {
        awardeeVillagesPanelBack.addEventListener('click', () => {
            awardeeVillagesPanel.style.transform = 'translateX(-100%)';
            showLanguageWidget();
        });
    }

    if (awardeeVillageSelect) {
        awardeeVillageSelect.addEventListener('change', () => {
            const selectedVal = awardeeVillageSelect.value;
            if (!selectedVal) {
                if (awardeeVillageDetail) awardeeVillageDetail.classList.add('hidden');
                if (awardeeVillagePlaceholder) awardeeVillagePlaceholder.classList.remove('hidden');
                return;
            }

            const item = window.awardeesData ? window.awardeesData.find(aw => aw.id == selectedVal) : null;
            if (item) {
                document.getElementById('awardee-detail-image').src = item.image || '/images/Desa News.jpg';
                document.getElementById('awardee-detail-medal').textContent = item.medal;
                document.getElementById('awardee-detail-name').textContent = item.name;
                document.getElementById('awardee-detail-year').textContent = `Tahun Penghargaan: ${item.year}`;
                document.getElementById('awardee-detail-desc').textContent = item.description;

                document.getElementById('awardee-detail-parahyangan').textContent = item.parahyangan_achievement || '-';
                document.getElementById('awardee-detail-pawongan').textContent = item.pawongan_achievement || '-';
                document.getElementById('awardee-detail-palemahan').textContent = item.palemahan_achievement || '-';

                if (awardeeVillagePlaceholder) awardeeVillagePlaceholder.classList.add('hidden');
                if (awardeeVillageDetail) awardeeVillageDetail.classList.remove('hidden');
            }
        });
    }

    /* ==========================================================================
       10.5. News Slide-over Drawer Controller
       ========================================================================== */
    const newsData = {
        'subak': {
            id: 'subak',
            title: 'Subak: Demokrasi Air dalam Peradaban Bali',
            titleEn: 'Subak: Water Democracy in Balinese Civilization',
            category: 'Filosofi',
            categoryEn: 'Philosophy',
            date: '12 Jun 2026',
            image: '/images/Subak News.jpg',
            content: [
                'Sistem irigasi Subak merupakan manifestasi sosiokultural yang sangat mendalam dari filosofi Tri Hita Karana di Bali. Lebih dari sekadar teknik mengalirkan air ke sawah, Subak mengatur distribusi air secara adil dan merata kepada seluruh petani anggota perkumpulan.',
                'Melalui prinsip gotong royong dan keadilan sosial, Subak mengajarkan pilar <strong>Pawongan</strong> (hubungan harmonis sesama manusia) melalui rapat banjar subak dan musyawarah pembagian air, menghindari konflik perebutan sumber daya.',
                'Pilar <strong>Palemahan</strong> tercermin dari pemeliharaan saluran air, bendungan tanah, dan terasering sawah yang menjaga konservasi lahan serta mencegah erosi secara alami. Sementara pilar <strong>Parahyangan</strong> diwujudkan dengan berdirinya Pura Bedugul atau Pura Ulun Danu di setiap kawasan danau atau sumber air, di mana para petani berkumpul mempersembahkan sesaji syukur atas kesuburan tanah.'
            ],
            contentEn: [
                'The Subak irrigation system is a deep sociocultural manifestation of the Tri Hita Karana philosophy in Bali. More than just a method to channel water to rice paddies, Subak manages water distribution fairly and equally to all member farmers.',
                'Through the principles of mutual cooperation and social justice, Subak teaches the <strong>Pawongan</strong> pillar (harmonious relationship among fellow humans) through subak council meetings and water sharing agreements, preventing conflicts over resources.',
                'The <strong>Palemahan</strong> pillar is reflected in the maintenance of water channels, soil dams, and terraced rice paddies that conserve land and prevent natural erosion. Meanwhile, the <strong>Parahyangan</strong> pillar is manifested through the Bedugul Temple or Ulun Danu Temple in every lake or water source region, where farmers gather to offer gratitude ceremonies for the land’s fertility.'
            ]
        },
        'desa-adat': {
            id: 'desa-adat',
            title: 'Desa Adat Penerima THK Awards 2026 Diumumkan',
            titleEn: 'Customary Villages Receiving THK Awards 2026 Announced',
            category: 'Komunitas',
            categoryEn: 'Community',
            date: '05 Jun 2026',
            image: '/images/Desa News.jpg',
            content: [
                'Komite Evaluasi Tri Hita Karana Awards 2026 resmi mengumumkan delapan desa adat di seluruh penjuru Bali yang berhasil meraih predikat Gold Award tahun ini.',
                'Penghargaan ini diberikan setelah melalui audit lapangan yang ketat selama okeh tim verifikator independen. Desa adat penerima dinilai sukses menerapkan konsep keselarasan Tri Hita Karana di era modern.',
                'Beberapa parameter penilaian kunci meliputi pengelolaan sampah organik desa yang mandiri (Palemahan), pelestarian tari adat sakral anak-anak (Pawongan), serta pelestarian arsitektur pura kuno tanpa mengubah keaslian batu paras (Parahyangan). Selamat kepada para pemenang yang terus melestarikan taksu Bali.'
            ],
            contentEn: [
                'The Tri Hita Karana Awards 2026 Evaluation Committee has officially announced eight customary villages across Bali that have successfully achieved the Gold Award status this year.',
                'This award is granted following a rigorous six-month on-site audit by an independent team of verifiers. The recipient customary villages are judged to have successfully implemented the harmony concepts of Tri Hita Karana in the modern era.',
                'Key evaluation parameters include self-managed organic waste management in the village (Palemahan), preservation of children’s sacred traditional dances (Pawongan), and conservation of ancient temple architecture without altering the authenticity of the paras stone (Parahyangan). Congratulations to the winners who continue to preserve Bali’s soul.'
            ]
        },
        'registrasi-awards': {
            id: 'registrasi-awards',
            title: 'Pendaftaran THK Awards 2027 Resmi Dibuka',
            titleEn: 'THK Awards 2027 Registration Officially Open',
            category: 'THK Awards',
            categoryEn: 'THK Awards',
            date: '28 Mei 2026',
            image: '/images/Awrds News.jpg',
            content: [
                'Bagi desa adat, organisasi kemasyarakatan, instansi pemerintahan, maupun pelaku usaha swasta di Bali, pendaftaran untuk siklus penilaian Tri Hita Karana Awards 2027 kini telah resmi dibuka.',
                'Peserta dapat mulai melakukan pengisian data profil, mengunduh panduan evaluasi per pilar, serta mengunggah dokumen pendukung di portal web resmi THK Bali.',
                'Proses pendaftaran awal ini akan ditutup pada akhir bulan depan, sebelum dilanjutkan ke tahap verifikasi dokumen administratif dan kunjungan tim asesor ke lapangan. Pastikan instansi Anda ikut berpartisipasi dalam melestarikan harmoni Bali.'
            ],
            contentEn: [
                'For customary villages, community organizations, government agencies, as well as private business actors in Bali, registration for the Tri Hita Karana Awards 2027 evaluation cycle is now officially open.',
                'Participants can begin filling in their profile data, downloading evaluation guides for each pillar, and uploading supporting documents on the official web portal of THK Bali.',
                'This initial registration phase will close at the end of next month, before continuing to the administrative document verification phase and assessors’ field visits. Ensure your institution participates in preserving Bali’s harmony.'
            ]
        }
    };

    const newsDrawerBackdrop = document.getElementById('news-drawer-backdrop');
    const newsDrawer = document.getElementById('news-drawer');
    const newsDrawerCloseBtn = document.getElementById('news-drawer-close');
    const newsDrawerActionBtn = document.getElementById('news-drawer-action');

    function openNewsDrawer(newsId) {
        currentLang = getCurrentLang();
        const item = window.newsData ? window.newsData[newsId] : newsData[newsId];
        if (!item || !newsDrawer || !newsDrawerBackdrop) return;
        hideWhatsAppWidget();

        const isEn = (currentLang === 'en');

        // Populate elements
        const drawerImage = document.getElementById('news-drawer-image');
        const drawerDate = document.getElementById('news-drawer-date');
        const drawerCategory = document.getElementById('news-drawer-category');
        const drawerHeadline = document.getElementById('news-drawer-headline');
        const drawerContentContainer = document.getElementById('news-drawer-content');
        const drawerViews = document.getElementById('news-drawer-views');

        if (drawerImage) drawerImage.src = item.image;
        if (drawerDate) drawerDate.textContent = item.date;
        if (drawerCategory) {
            drawerCategory.textContent = isEn ? item.categoryEn : item.category;
        }
        if (drawerHeadline) {
            drawerHeadline.textContent = isEn ? item.titleEn : item.title;
        }
        if (drawerViews) {
            drawerViews.innerHTML = '<i class="far fa-eye mr-1"></i>' + (item.views || 0) + ' dibaca';
        }

        // Setup share URLs and actions
        const shareUrl = window.location.origin + window.location.pathname + '?news=' + item.id;
        const shareTitle = isEn ? item.titleEn : item.title;

        const fbBtn = document.getElementById('news-share-fb');
        const waBtn = document.getElementById('news-share-wa');
        const lineBtn = document.getElementById('news-share-line');
        const tgBtn = document.getElementById('news-share-tg');
        const xBtn = document.getElementById('news-share-x');
        const copyBtn = document.getElementById('news-share-copy');

        if (fbBtn) fbBtn.href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`;
        if (waBtn) waBtn.href = `https://api.whatsapp.com/send?text=${encodeURIComponent(shareTitle + '\n\n' + shareUrl)}`;
        if (lineBtn) lineBtn.href = `https://social-plugins.line.me/lineit/share?url=${encodeURIComponent(shareUrl)}`;
        if (tgBtn) tgBtn.href = `https://t.me/share/url?url=${encodeURIComponent(shareUrl)}&text=${encodeURIComponent(shareTitle)}`;
        if (xBtn) xBtn.href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(shareUrl)}&text=${encodeURIComponent(shareTitle)}`;

        if (copyBtn) {
            const newCopyBtn = copyBtn.cloneNode(true);
            copyBtn.parentNode.replaceChild(newCopyBtn, copyBtn);
            newCopyBtn.addEventListener('click', (e) => {
                e.preventDefault();
                navigator.clipboard.writeText(shareUrl).then(() => {
                    const originalHTML = newCopyBtn.innerHTML;
                    newCopyBtn.innerHTML = '<i class="fas fa-check text-[11px]"></i>';
                    setTimeout(() => {
                        newCopyBtn.innerHTML = originalHTML;
                    }, 2000);
                }).catch(err => console.error(err));
            });
        }

        // Increment views count in database
        fetch(`/news/view/${item.id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(resData => {
            if (resData.success) {
                item.views = resData.views;
                if (window.newsData && window.newsData[newsId]) {
                    window.newsData[newsId].views = resData.views;
                }
                if (drawerViews) {
                    drawerViews.innerHTML = '<i class="far fa-eye mr-1"></i>' + resData.views + ' dibaca';
                }
            }
        })
        .catch(err => console.error(err));

        if (drawerContentContainer) {
            drawerContentContainer.innerHTML = '';
            let paragraphs = isEn ? item.contentEn : item.content;
            if (typeof paragraphs === 'string') {
                paragraphs = paragraphs.split('\n').filter(p => p.trim() !== '');
            } else if (!Array.isArray(paragraphs)) {
                paragraphs = [paragraphs];
            }
            paragraphs.forEach(p => {
                const pEl = document.createElement('p');
                pEl.innerHTML = p;
                pEl.className = 'text-white/80 leading-relaxed text-sm md:text-base mb-4 last:mb-0';
                drawerContentContainer.appendChild(pEl);
            });
        }

        // Open Drawer
        newsDrawerBackdrop.classList.remove('hidden');
        setTimeout(() => {
            newsDrawerBackdrop.classList.remove('opacity-0');
            newsDrawerBackdrop.classList.add('opacity-100');
            newsDrawer.classList.remove('translate-x-full');
            newsDrawer.classList.add('translate-x-0');
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    function closeNewsDrawer() {
        if (!newsDrawer || !newsDrawerBackdrop) return;

        newsDrawer.classList.remove('translate-x-0');
        newsDrawer.classList.add('translate-x-full');
        newsDrawerBackdrop.classList.remove('opacity-100');
        newsDrawerBackdrop.classList.add('opacity-0');

        setTimeout(() => {
            newsDrawerBackdrop.classList.add('hidden');
            document.body.style.overflow = '';
            showWhatsAppWidget();
        }, 300);
    }

    // Attach card click handlers
    document.querySelectorAll('.news-card').forEach(card => {
        const newsId = card.getAttribute('data-news-id');
        if (!newsId) return;

        card.addEventListener('click', (e) => {
            // If click is on standard layout link or button inside the card, do not intercept
            if (e.target.closest('a') && !e.target.closest('.open-news-btn')) return;
            e.preventDefault();
            openNewsDrawer(newsId);
        });
    });

    // Attach standalone click handlers for open-news-btn (e.g. inside the news ticker)
    document.querySelectorAll('.open-news-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const newsId = btn.getAttribute('data-news-id');
            if (newsId) {
                openNewsDrawer(newsId);
            }
        });
    });

    if (newsDrawerCloseBtn) newsDrawerCloseBtn.addEventListener('click', closeNewsDrawer);
    if (newsDrawerActionBtn) newsDrawerActionBtn.addEventListener('click', closeNewsDrawer);
    if (newsDrawerBackdrop) newsDrawerBackdrop.addEventListener('click', closeNewsDrawer);

    // Escape key listener for news drawer
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && newsDrawer && !newsDrawer.classList.contains('translate-x-full')) {
            closeNewsDrawer();
        }
    });

    /* ==========================================================================
       11. Sistem Penerjemahan Multi-Bahasa Frontend (ID / EN)
       ========================================================================== */
    const dictionary = {
        // Navbar
        "Beranda": "Home",
        "Tentang THK": "About THK",
        "THK Awards": "THK Awards",
        "Berita": "News",
        "Galeri": "Gallery",
        "Hubungi Kami": "Contact Us",
        "Masuk": "Log In",
        "Daftar": "Register",
        
        // Hero
        "— Filosofi Hidup Masyarakat Bali —": "— Balinese Society Life Philosophy —",
        "Discover Bali Through Harmony": "Discover Bali Through Harmony",
        "Tri Hita Karana mengajarkan keseimbangan antara manusia, alam, dan Tuhan — filosofi yang menjaga harmoni Bali dari generasi ke generasi.": "Tri Hita Karana teaches the balance between humans, nature, and God — a philosophy that preserves the harmony of Bali across generations.",
        "Cari filosofi, kategori THK Awards, berita...": "Search philosophy, THK Awards categories, news...",
        "Jelajahi THK": "Explore THK",
        
        // Stats
        "Pilar Filosofi": "Philosophical Pillars",
        "Peserta Awards": "Awards Participants",
        "Asesor Aktif": "Active Assessors",
        "Kategori Awards": "Award Categories",
        "Desa Adat Penerima": "Awarded Customary Villages",
        
        // About
        "— Tentang THK": "— About THK",
        "Tiga Pilar Harmoni": "Three Pillars of Harmony",
        "Setiap pilar menuntun keseimbangan hidup masyarakat Bali — dengan Tuhan, sesama manusia, dan alam semesta.": "Each pillar guides the life balance of Balinese society — with God, fellow human beings, and the natural universe.",
        "Hubungan dengan Tuhan": "Relationship with God",
        "Hubungan harmonis antara manusia dengan Tuhan, terwujud lewat persembahyangan, upacara, dan pura yang menyatu dengan kehidupan sehari-hari.": "Harmonious relationship between humans and God, manifested through prayers, ceremonies, and temples integrated into daily life.",
        "Pelajari Lebih Lanjut": "Learn More",
        "Hubungan Antar Manusia": "Relationship Among People",
        "Hubungan harmonis antar sesama manusia — gotong royong, musyawarah banjar, dan kepedulian yang merajut kehidupan bermasyarakat.": "Harmonious relationship among fellow humans — mutual cooperation, community council meetings, and care that weaves community life.",
        "Hubungan dengan Alam": "Relationship with Nature",
        "Hubungan harmonis manusia dengan alam — tercermin dalam sistem Subak, pelestarian hutan, dan tanggung jawab menjaga lingkungan.": "Harmonious relationship between humans and nature — reflected in the Subak system, forest conservation, and environmental responsibility.",
        
        // Awards
        "— Sorotan": "— Spotlight",
        "Kategori Desa Adat": "Customary Village Category",
        "Kategori Individu": "Individual Category",
        "Kategori Organisasi": "Organization Category",
        "Diberikan kepada desa adat yang menerapkan Tri Hita Karana secara nyata — dari pengelolaan Subak hingga pelestarian upacara adat dan ruang hijau desa.": "Given to customary villages that practically apply Tri Hita Karana — from Subak management to customary ceremonies and village green space preservation.",
        "Apresiasi tertinggi untuk tokoh masyarakat, budayawan, atau aktivis lingkungan yang mendedikasikan hidupnya demi menjaga nilai kearifan lokal Bali dan kerukunan.": "The highest appreciation for community figures, cultural leaders, or environmental activists who dedicate their lives to maintaining Bali's local wisdom values and harmony.",
        "Ditujukan bagi instansi pemerintah, yayasan, LSM, maupun badan usaha swasta yang berhasil menyelaraskan program kerjanya dengan tiga pilar kelestarian Bali.": "Intended for government agencies, foundations, NGOs, as well as private businesses that successfully align their work programs with the three pillars of Bali's sustainability.",
        "Penghargaan": "Award",
        "Komunitas": "Community",
        "Keberlanjutan": "Sustainability",
        "Kepeloporan": "Pioneering",
        "Inspiratif": "Inspirative",
        "Sosial-Budaya": "Socio-Cultural",
        "Sinergi": "Synergy",
        "Institusi": "Institution",
        "Lingkungan": "Environment",
        "Tim Kurator THK Awards": "THK Awards Curator Team",
        "Kategori Aktif - 2026": "Active Category - 2026",
        "Dewan Juri THK": "THK Jury Board",
        "Panel Penilai Utama": "Main Evaluation Panel",
        "Tim Verifikator Independen": "Independent Verificator Team",
        "Asosiasi Audit Eksternal": "External Audit Association",
        "Lihat Detail": "View Details",
        "Pengajuan": "Submission",
        "Peserta mendaftar dan mengunggah berkas portofolio penilaian di sistem.": "Participants register and upload assessment portfolio files in the system.",
        "Verifikasi Admin": "Admin Verification",
        "Admin memeriksa kelengkapan berkas administrasi dan dokumen pendukung.": "Admin checks the completeness of administrative files and supporting documents.",
        "Penilaian Lapangan": "Field Assessment",
        "Asesor melakukan peninjauan dan penilaian langsung ke lokasi peserta.": "Assessors conduct reviews and evaluation directly at the participant's location.",
        "Hasil Penilaian": "Evaluation Results",
        "Hasil penilaian dikompilasi oleh tim kurator dan disahkan dalam rapat pleno.": "Evaluation results are compiled by the curator team and ratified in a plenary meeting.",
        "Penghargaan": "Awards",
        "Penyerahan penghargaan THK Awards kepada penerima dalam acara resmi tahunan.": "Presentation of the THK Awards to the recipients in the official annual ceremony.",
        
        // News
        "— Berita": "— News",
        "Berita Pilihan": "Selected News",
        "Semua": "All",
        "Filosofi": "Philosophy",
        "Terverifikasi": "Verified",
        "Subak: Demokrasi Air dalam Peradaban Bali": "Subak: Water Democracy in Balinese Civilization",
        "Sistem irigasi Subak bukan sekadar teknik pertanian — ia adalah wujud nyata Tri Hita Karana dalam tata kelola desa.": "The Subak irrigation system is not just an agricultural technique — it is a tangible manifestation of Tri Hita Karana in village governance.",
        "Desa Adat Penerima THK Awards 2026 Diumumkan": "Customary Villages Receiving THK Awards 2026 Announced",
        "Delapan desa adat menerima penghargaan atas praktik nyata keseimbangan Parahyangan, Pawongan, dan Palemahan.": "Eight customary villages receive awards for practical balance of Parahyangan, Pawongan, and Palemahan.",
        "Pendaftaran THK Awards 2027 Resmi Dibuka": "THK Awards 2027 Registration Officially Open",
        "Peserta individu, desa adat, dan organisasi dapat mendaftar mulai bulan ini melalui portal peserta.": "Individual participants, customary villages, and organizations can register starting this month through the participant portal.",
        "Baca Detail": "Read Details",
        "12 Jun 2026": "12 Jun 2026",
        "5 Jun 2026": "5 Jun 2026",
        "28 Mei 2026": "28 May 2026",
        "Detail Berita": "News Details",
        "Berita Terbaru": "Latest News",
        
        // Gallery
        "— Galeri": "— Gallery",
        "Bali, dalam Keseimbangan": "Bali, in Balance",
        "Pura Ulun Danu Bratan — Refleksi Parahyangan": "Ulun Danu Bratan Temple — Parahyangan Reflection",
        "Pura Ulun Danu Bratan": "Ulun Danu Bratan Temple",
        "Tanah Lot di Waktu Senja — Keindahan Suasana Suci": "Tanah Lot at Dusk — Beauty of Sacred Atmosphere",
        "Tanah Lot di Senja Hari": "Tanah Lot at Dusk",
        "Upacara Adat Lembu Ngaben — Tradisi Agung Gotong Royong": "Lembu Ngaben Customary Ceremony — Noble Mutual Cooperation Tradition",
        "Tradisi Upacara Adat Bali": "Balinese Customary Ceremony Tradition",
        "Tari Tradisional membawa Sesajen Gebogan — Keanggunan Seni Bali": "Traditional Dance carrying Gebogan Offerings — Balinese Art Elegance",
        "Keanggunan Tari Bali": "Elegance of Balinese Dance",
        "Meditasi & Yoga di Tepi Pantai — Harmoni Menyatukan Jiwa dan Alam": "Meditation & Yoga at the Beach — Harmony Uniting Soul and Nature",
        "Meditasi Harmoni Alam": "Nature Harmony Meditation",
        
        // Roles
        "— Bergabung Bersama": "— Join Us",
        "Pilih Peran Anda": "Choose Your Role",
        "Setiap peran memiliki bagian penting dalam menjaga dan merayakan filosofi Tri Hita Karana.": "Each role plays an important part in maintaining and celebrating the Tri Hita Karana philosophy.",
        "Populer": "Popular",
        "Peserta": "Participant",
        "Asesor": "Assessor",
        "Admin": "Admin",
        "Pendaftar THK Awards": "THK Awards Registrant",
        "Daftar Sebagai Peserta": "Register as Participant",
        "Tim Penilai": "Evaluation Team",
        "Akun diundang oleh Admin — Hubungi Kami": "Account invited by Admin — Contact Us",
        "Pengelola Platform": "Platform Manager",
        "Akses internal — Hubungi Kami": "Internal Access — Contact Us",
        
        // Footer
        "&copy; 2026 THK Bali — Hak Cipta Dilindungi": "&copy; 2026 THK Bali — All Rights Reserved",
        
        // Modals
        "Masuk Akun": "Log In Account",
        "Daftar Baru": "Register New",
        "Email Address": "Email Address",
        "Password": "Password",
        "Ingat saya": "Remember me",
        "Lupa Password?": "Forgot Password?",
        "Masuk Sekarang": "Log In Now",
        "Nama Lengkap": "Full Name",
        "Alamat Email": "Email Address",
        "Daftar Sebagai": "Register As",
        "Peserta / Pendaftar THK Awards": "Participant / THK Awards Registrant",
        "Asesor / Tim Penilai": "Assessor / Evaluation Team",
        "Masyarakat Umum": "General Public",
        "Password Baru": "New Password",
        "Buat Akun Peserta": "Create Participant Account",
        "Tutup": "Close",
        
        // Contact Modal
        "Hubungi Tim THK Bali": "Contact THK Bali Team",
        "Kirimkan pesan Anda untuk pengajuan pendaftaran, undangan asesor, akses admin platform, atau pertanyaan umum seputar program Tri Hita Karana.": "Send your message for registration submission, assessor invitations, internal admin access, or general inquiries about the Tri Hita Karana program.",
        "Nama": "Name",
        "Email": "Email",
        "Subjek": "Subject",
        "Pendaftaran THK Awards": "THK Awards Registration",
        "Undangan / Verifikasi Asesor": "Assessor Invitation / Verification",
        "Akses Admin Internal": "Internal Admin Access",
        "Kemitraan & Sponsorship": "Partnership & Sponsorship",
        "Pertanyaan Umum": "General Inquiries",
        "Pesan / Pengajuan": "Message / Submission",
        "Tulis rincian pesan atau deskripsi peran yang diajukan...": "Write message details or description of the role applied for...",
        "Batal": "Cancel",
        "Kirim Pesan": "Send Message",
        
        // Drawers detail
        "Tutup Detail": "Close Details",
        "Hubungan dengan Sesama": "Relationship with Others",
        "Kembali": "Back",
        "Unduh Panduan": "Download Guide",
        "Hubungi Admin": "Contact Admin",
        "Lihat Berita": "View News",
        "Aktivitas Terkait": "Related Activities",
        "Kriteria Penilaian": "Evaluation Criteria",
        "Metode Audit": "Audit Method",
        "Langkah Pelaksanaan": "Implementation Steps",
        
        // Roles bullet lists
        "Ajukan THK Awards": "Apply for THK Awards",
        "Unggah dokumen pendukung": "Upload supporting documents",
        "Pantau status verifikasi": "Monitor verification status",
        "Lihat hasil penilaian": "View evaluation results",
        "Akses seluruh artikel & galeri": "Access all articles & galleries",
        "Tinjau peserta yang ditugaskan": "Review assigned participants",
        "Isi form penilaian per pilar": "Fill pilar evaluation form",
        "Lihat riwayat penilaian": "View evaluation history",
        "Akses dokumen peserta": "Access participant documents",
        "Kelola peserta & asesor": "Manage participants & assessors",
        "Kelola berita & galeri": "Manage news & galleries",
        "Kelola kategori THK Awards": "Manage THK Awards categories",
        "Pantau seluruh penilaian": "Monitor all evaluations"
    };

    currentLang = getCurrentLang();

    function translatePage(lang) {
        currentLang = lang;
        localStorage.setItem('preferred-language', lang);
        
        // Update switcher buttons UI active class
        document.querySelectorAll('.lang-btn').forEach(btn => {
            if (btn.getAttribute('data-lang') === lang) {
                btn.classList.add('active-lang');
            } else {
                btn.classList.remove('active-lang');
            }
        });

        // Walk through all text nodes in the document body
        const walk = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
        let node;
        while (node = walk.nextNode()) {
            const parentTagName = node.parentElement ? node.parentElement.tagName.toLowerCase() : '';
            if (['script', 'style', 'svg', 'path', 'circle'].includes(parentTagName)) {
                continue;
            }

            const text = node.nodeValue.trim();
            if (lang === 'en') {
                if (dictionary[text]) {
                    if (!node.originalValue) node.originalValue = node.nodeValue;
                    const leadingSpace = node.nodeValue.match(/^\s*/)[0];
                    const trailingSpace = node.nodeValue.match(/\s*$/)[0];
                    node.nodeValue = leadingSpace + dictionary[text] + trailingSpace;
                }
            } else {
                if (node.originalValue) {
                    node.nodeValue = node.originalValue;
                }
            }
        }

        // Translate placeholders
        document.querySelectorAll('input, textarea').forEach(el => {
            const ph = el.placeholder;
            if (ph) {
                if (lang === 'en') {
                    if (dictionary[ph]) {
                        if (!el.originalPlaceholder) el.originalPlaceholder = ph;
                        el.placeholder = dictionary[ph];
                    }
                } else {
                    if (el.originalPlaceholder) {
                        el.placeholder = el.originalPlaceholder;
                    }
                }
            }
        });

        // Translate select options
        document.querySelectorAll('select option').forEach(el => {
            const text = el.textContent.trim();
            if (lang === 'en') {
                if (dictionary[text]) {
                    if (!el.originalValue) el.originalValue = el.textContent;
                    el.textContent = dictionary[text];
                }
            } else {
                if (el.originalValue) {
                    el.textContent = el.originalValue;
                }
            }
        });
    }

    // Bind lang button listeners
    document.querySelectorAll('.lang-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const lang = btn.getAttribute('data-lang');
            translatePage(lang);
        });
    });

    // Run initial translation on page load
    // translatePage(currentLang);

    /* ==========================================================================
       12. Fitur Slide / Scroll Horizontal (Tabs & Galeri)
       ========================================================================== */
    const awardTabsContainer = document.getElementById('award-tabs-container');
    const awardScrollLeft = document.getElementById('award-scroll-left');
    const awardScrollRight = document.getElementById('award-scroll-right');
    if (awardTabsContainer && awardScrollLeft && awardScrollRight) {
        awardScrollLeft.addEventListener('click', () => {
            awardTabsContainer.scrollBy({ left: -240, behavior: 'smooth' });
        });
        awardScrollRight.addEventListener('click', () => {
            awardTabsContainer.scrollBy({ left: 240, behavior: 'smooth' });
        });
    }

    const galleryTrack = document.getElementById('gallery-track');
    const galleryScrollLeft = document.getElementById('gallery-scroll-left');
    const galleryScrollRight = document.getElementById('gallery-scroll-right');
    if (galleryTrack && galleryScrollLeft && galleryScrollRight) {
        galleryScrollLeft.addEventListener('click', () => {
            galleryTrack.scrollBy({ left: -360, behavior: 'smooth' });
        });
        galleryScrollRight.addEventListener('click', () => {
            galleryTrack.scrollBy({ left: 360, behavior: 'smooth' });
        });
    }

    /* ==========================================================================
       13. Fitur Lihat Semua Berita
       ========================================================================== */
    const showAllNewsBtn = document.getElementById('show-all-news-btn');
    if (showAllNewsBtn) {
        showAllNewsBtn.addEventListener('click', () => {
            const extraNews = document.querySelectorAll('.extra-news');
            extraNews.forEach((card, idx) => {
                card.classList.remove('hidden');
                setTimeout(() => {
                    card.classList.add('opacity-100');
                    card.classList.remove('opacity-0');
                }, idx * 100);
            });
            showAllNewsBtn.classList.add('hidden');
        });
    }

    /* ==========================================================================
       14. Fitur Agenda Detail Modal
       ========================================================================== */
    const agendaModal = document.getElementById('agenda-modal');
    const agendaModalClose = document.getElementById('agenda-modal-close');
    const agendaModalCancel = document.getElementById('agenda-modal-cancel');

    function openAgendaModal(id) {
        const item = window.agendaData ? window.agendaData[id] : null;
        if (!item || !agendaModal) return;
        hideWhatsAppWidget();

        document.getElementById('agenda-modal-title').textContent = item.title;
        document.getElementById('agenda-modal-image').src = item.image;
        document.getElementById('agenda-modal-views').textContent = `${item.views || 0} dibaca`;
        document.getElementById('agenda-modal-contributor').textContent = `Kontributor: ${item.contributor}`;
        document.getElementById('agenda-modal-date').textContent = item.date_range;
        document.getElementById('agenda-modal-time').textContent = item.time;
        document.getElementById('agenda-modal-place').textContent = item.place;
        document.getElementById('agenda-modal-desc').innerHTML = item.description;

        // Setup share URLs and actions
        const shareUrl = window.location.origin + window.location.pathname + '?agenda=' + item.id;
        const shareTitle = item.title;

        const fbBtn = document.getElementById('agenda-share-fb');
        const waBtn = document.getElementById('agenda-share-wa');
        const lineBtn = document.getElementById('agenda-share-line');
        const tgBtn = document.getElementById('agenda-share-tg');
        const xBtn = document.getElementById('agenda-share-x');
        const copyBtn = document.getElementById('agenda-share-copy');

        if (fbBtn) fbBtn.href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`;
        if (waBtn) waBtn.href = `https://api.whatsapp.com/send?text=${encodeURIComponent(shareTitle + '\n\n' + shareUrl)}`;
        if (lineBtn) lineBtn.href = `https://social-plugins.line.me/lineit/share?url=${encodeURIComponent(shareUrl)}`;
        if (tgBtn) tgBtn.href = `https://t.me/share/url?url=${encodeURIComponent(shareUrl)}&text=${encodeURIComponent(shareTitle)}`;
        if (xBtn) xBtn.href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(shareUrl)}&text=${encodeURIComponent(shareTitle)}`;

        if (copyBtn) {
            const newCopyBtn = copyBtn.cloneNode(true);
            copyBtn.parentNode.replaceChild(newCopyBtn, copyBtn);
            newCopyBtn.addEventListener('click', (e) => {
                e.preventDefault();
                navigator.clipboard.writeText(shareUrl).then(() => {
                    const originalHTML = newCopyBtn.innerHTML;
                    newCopyBtn.innerHTML = '<i class="fas fa-check text-[11px]"></i>';
                    setTimeout(() => {
                        newCopyBtn.innerHTML = originalHTML;
                    }, 2000);
                }).catch(err => console.error(err));
            });
        }

        // Increment views count in database
        fetch(`/agenda/view/${item.id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(resData => {
            if (resData.success) {
                item.views = resData.views;
                if (window.agendaData && window.agendaData[id]) {
                    window.agendaData[id].views = resData.views;
                }
                const viewsEl = document.getElementById('agenda-modal-views');
                if (viewsEl) {
                    viewsEl.textContent = `${resData.views} dibaca`;
                }
            }
        })
        .catch(err => console.error(err));

        agendaModal.classList.remove('hidden');
        agendaModal.classList.add('flex');
        setTimeout(() => {
            agendaModal.classList.remove('opacity-0');
            agendaModal.classList.add('opacity-100');
            agendaModal.querySelector('.modal-dialog').classList.remove('scale-95', 'opacity-0');
            agendaModal.querySelector('.modal-dialog').classList.add('scale-100', 'opacity-100');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeAgendaModal() {
        if (!agendaModal) return;
        agendaModal.classList.remove('opacity-100');
        agendaModal.classList.add('opacity-0');
        agendaModal.querySelector('.modal-dialog').classList.remove('scale-100', 'opacity-100');
        agendaModal.querySelector('.modal-dialog').classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            agendaModal.classList.add('hidden');
            agendaModal.classList.remove('flex');
            document.body.style.overflow = '';
            showWhatsAppWidget();
        }, 300);
    }

    document.querySelectorAll('.agenda-card').forEach(card => {
        card.addEventListener('click', (e) => {
            if (e.target.closest('button') || e.target.closest('.open-agenda-btn')) return;
            const id = card.getAttribute('data-agenda-id');
            openAgendaModal(id);
        });
    });

    document.querySelectorAll('.open-agenda-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const id = btn.getAttribute('data-agenda-id');
            openAgendaModal(id);
        });
    });

    if (agendaModalClose) agendaModalClose.addEventListener('click', closeAgendaModal);
    if (agendaModalCancel) agendaModalCancel.addEventListener('click', closeAgendaModal);
    if (agendaModal) {
        agendaModal.addEventListener('click', (e) => {
            if (e.target === agendaModal) closeAgendaModal();
        });
    }

    // Deep linking handler on page load
    const urlParams = new URLSearchParams(window.location.search);
    const initialNewsId = urlParams.get('news');
    const initialAgendaId = urlParams.get('agenda');
    if (initialNewsId) {
        setTimeout(() => openNewsDrawer(initialNewsId), 600);
    } else if (initialAgendaId) {
        setTimeout(() => openAgendaModal(initialAgendaId), 600);
    }

    // ==========================================================================
    // Realtime Status Polling & Auto Refresh
    // ==========================================================================
    let currentProposalStatus = null;
    let initialAdminHash = null;

    function initRealtimePolling() {
        // Poll every 8 seconds
        setInterval(performRealtimeCheck, 8000);
        // Also run immediately
        performRealtimeCheck();
    }

    function performRealtimeCheck() {
        fetch('/api/realtime-check', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Offline or Session ended');
            return response.json();
        })
        .then(data => {
            if (!data.authenticated) return;

            // 1. Handle Peserta role (auto-update status badge without refresh)
            if (data.role === 'peserta' && data.status) {
                if (currentProposalStatus === null) {
                    currentProposalStatus = data.status;
                } else if (currentProposalStatus !== data.status) {
                    // Update current status tracker
                    currentProposalStatus = data.status;

                    // Automatically update status badges in DOM
                    document.querySelectorAll('span.ml-1.px-2.py-0.5.bg-gold-500\\/20').forEach(el => {
                        el.textContent = data.status;
                    });
                    
                    document.querySelectorAll('.text-xs.font-semibold.text-gold-400.bg-gold-500\\/10').forEach(el => {
                        el.textContent = 'Status: ' + data.status;
                    });

                    // Trigger a custom notification using our nice alert banner if visible, or a toast
                    console.log('Status updated in real-time to: ' + data.status);
                    
                    // Show a toast or beautiful reload notification
                    showRealtimeNotification(`Status pendaftaran Anda telah diperbarui menjadi "${data.status}" secara real-time!`);
                }
            }

            // 2. Handle Admin or Assessor roles
            if (['admin', 'asesor'].includes(data.role) && data.hash) {
                if (initialAdminHash === null) {
                    initialAdminHash = data.hash;
                } else if (initialAdminHash !== data.hash) {
                    // Hash changed! That means a new proposal was added or status updated.
                    initialAdminHash = data.hash;

                    // Check if they are typing in any input field or have a modal open.
                    // If they are actively filling out a form, do not reload automatically to avoid data loss.
                    const isUserEditing = document.activeElement && 
                        (document.activeElement.tagName === 'INPUT' || 
                         document.activeElement.tagName === 'TEXTAREA' || 
                         document.activeElement.tagName === 'SELECT' ||
                         document.activeElement.getAttribute('contenteditable') === 'true' ||
                         document.activeElement.closest('.note-editable')); // Summernote editor check
                    
                    const isAnyModalOpen = document.querySelector('.modal-pane:not(.hidden), #modal-news:not(.hidden), #modal-assessor:not(.hidden), #modal-agenda:not(.hidden), #modal-gallery:not(.hidden), #modal-awardee:not(.hidden), #modal-assessor-proposal-detail:not(.hidden)');

                    if (!isUserEditing && !isAnyModalOpen) {
                        console.log('New data detected on server. Auto-refreshing dashboard...');
                        window.location.reload();
                    } else {
                        console.log('New data detected on server, but skipped reload because admin is currently active in a form or modal.');
                    }
                }
            }
        })
        .catch(err => {
            // Silently ignore network connection failures during polling
        });
    }

    function showRealtimeNotification(msg) {
        // Create an elegant floating notification toast
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-5 right-5 z-50 max-w-sm bg-forest-950 text-white rounded-2xl shadow-[0_10px_30px_rgba(4,28,21,0.3)] border border-gold-500/30 p-4 transform translate-y-10 opacity-0 transition-all duration-500 flex items-start gap-3';
        toast.innerHTML = `
            <div class="p-1.5 bg-gold-500/10 rounded-lg text-gold-400 shrink-0">
                <i class="fas fa-bell animate-bounce text-sm"></i>
            </div>
            <div class="flex-1 space-y-1">
                <h4 class="text-xs font-black uppercase tracking-wider text-gold-400">Pembaruan Real-Time</h4>
                <p class="text-[11px] text-white/80 font-medium leading-relaxed">${msg}</p>
            </div>
            <button class="text-white/40 hover:text-white transition cursor-pointer select-none" onclick="this.parentElement.remove()">
                <i class="fas fa-times text-xs"></i>
            </button>
        `;
        document.body.appendChild(toast);

        // Animate entrance
        setTimeout(() => {
            toast.classList.remove('translate-y-10', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
        }, 10);

        // Auto remove after 7 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-10', 'opacity-0');
                setTimeout(() => toast.remove(), 500);
            }
        }, 7000);
    }

    // Initialize polling
    initRealtimePolling();
});
