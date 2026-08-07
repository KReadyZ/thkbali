<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $webSetting->website_name ?? 'THK Bali' }} — Tri Hita Karana</title>
    
    <meta name="description" content="Filosofi hidup masyarakat Bali yang menjaga harmoni dan keseimbangan antara manusia, alam, dan Tuhan demi kebahagiaan dari generasi ke generasi.">
    <meta name="keywords" content="Tri Hita Karana, Bali, Parahyangan, Pawongan, Palemahan, THK Awards, Subak">
    
    <script>document.documentElement.classList.replace('no-js', 'js');</script>

    <!-- Fonts, CSS & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-beige-100 text-forest-900 font-sans antialiased overflow-x-hidden page-fade">

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.modals')

    <!-- Floating Google Translate Widget (Bottom Left) -->
    <div id="google-translate-container" class="fixed bottom-4 left-4 z-50">
        <div id="google_translate_element"></div>
    </div>

    <!-- Google Translate Script -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                autoDisplay: false
            }, 'google_translate_element');

            function renameLanguages() {
                const selectEl = document.querySelector('.goog-te-combo');
                if (selectEl && selectEl.options && selectEl.options.length > 0) {
                    let updated = false;
                    if (selectEl.options[0].textContent !== 'Indonesia') {
                        selectEl.options[0].textContent = 'Indonesia';
                        updated = true;
                    }
                    for (let i = 0; i < selectEl.options.length; i++) {
                        const opt = selectEl.options[i];
                        if (opt.value === 'jw' || opt.value === 'jv' || opt.textContent.toLowerCase() === 'jawa' || opt.textContent.toLowerCase() === 'javanese') {
                            if (opt.textContent !== 'Jawa (Krama)') {
                                opt.textContent = 'Jawa (Krama)';
                                updated = true;
                            }
                        }
                    }
                    return updated;
                }
                return false;
            }

            // Always observe changes to the translate element to re-rename option 0 back to "Indonesia"
            const observer = new MutationObserver(function(mutations) {
                renameLanguages();
            });
            const target = document.getElementById('google_translate_element');
            if (target) {
                observer.observe(target, {
                    childList: true,
                    subtree: true
                });

                // Listen to change events on the select dropdown to instantly restore original state if 'Indonesia' is selected
                target.addEventListener('change', function(e) {
                    if (e.target && e.target.classList.contains('goog-te-combo')) {
                        if (e.target.value === '' || e.target.value === 'id') {
                            // Prevent Google Translate from receiving this event and triggering a duplicate reload
                            e.stopPropagation();
                            
                            // Erase Google Translate cookies
                            document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=" + location.hostname + ";";
                            document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=." + location.hostname.replace(/^www\./, '') + ";";
                            
                            // Reload page to restore clean original Indonesian layout
                            window.location.reload();
                        }
                    }
                }, true);
            }

            // Run immediately and also set up a safety timer to verify rename state periodically during load
            renameLanguages();
            let checkCounts = 0;
            const interval = setInterval(() => {
                renameLanguages();
                checkCounts++;
                if (checkCounts > 12) clearInterval(interval); // check for 6 seconds
            }, 500);
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Floating WhatsApp Widget -->
    <a id="whatsapp-widget" href="https://wa.me/081337644463" target="_blank" rel="noopener noreferrer" 
       class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 bg-[#25D366] hover:bg-[#20ba5a] text-white rounded-[20px] shadow-2xl hover:scale-110 active:scale-95 transition-all duration-300 group"
       aria-label="Chat WhatsApp">
        <svg class="w-7 h-7 text-black transition-transform duration-300 group-hover:rotate-6" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12.012 2c-5.506 0-9.988 4.482-9.988 9.988 0 1.761.458 3.479 1.329 4.99l-1.413 5.161 5.281-1.385a9.939 9.939 0 004.791 1.222h.004c5.506 0 9.988-4.482 9.988-9.988C22 6.482 17.518 2 12.012 2zm3.325 13.064c-.215.604-1.246 1.183-1.717 1.25-.407.058-.934.088-1.5-.1a7.712 7.712 0 01-3.238-1.921 8.52 8.52 0 01-2.186-3.087 3.328 3.328 0 01-.137-.417c-.126-.454-.515-.758-.515-1.528 0-.77.402-1.15.546-1.298.144-.148.375-.222.563-.222.188 0 .375.005.534.013.167.009.39-.063.612.47.228.547.781 1.905.849 2.043.068.138.114.298.023.48-.09.183-.136.298-.272.457-.136.16-.285.358-.407.48-.137.137-.28.287-.12.563.16.276.711 1.171 1.524 1.895.736.655 1.357.947 1.677 1.107.32.16.503.138.692-.069.189-.207.809-.942 1.026-1.264.217-.322.434-.268.732-.16.297.107 1.884.887 2.204 1.047.32.16.534.238.612.373.078.135.078.784-.137 1.388z"/>
        </svg>
    </a>

</body>
</html>
