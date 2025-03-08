<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- Prevent MIME type sniffing -->
        <meta http-equiv="X-Content-Type-Options" content="nosniff">
        <!-- Disallow the page to be framed -->
        <meta http-equiv="X-Frame-Options" content="DENY">
        <!-- Enable built-in XSS protection in some browsers -->
        <meta http-equiv="X-XSS-Protection" content="1; mode=block">
        <!-- Control referrer information sent with requests -->
        <meta name="referrer" content="no-referrer">
        <!-- Optional: Permissions Policy to disable features like geolocation, microphone, and camera -->
        <meta http-equiv="Permissions-Policy" content="geolocation=(), microphone=(), camera=()">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nidavellir</title>

        <!-- Google Fonts: Inter -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS (via Vite or CDN) -->
        @vite('resources/css/app.css')

        <!-- Swiper CSS (CDN) -->
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
        />

        <style>
            /*
              1) .card sets user-select: none to block selection of the entire card background.
              2) We override user-select: text on text-related elements so users can still highlight text.
            */
            .card {
                user-select: none;
            }
            .card h1,
            .card h2,
            .card h3,
            .card h4,
            .card h5,
            .card h6,
            .card p,
            .card span,
            .card svg,
            .card .swiper-slide,
            .card .swiper-slide * {
                user-select: text;
            }

            /* Swiper slide alignment & no box shadow */
            .swiper-slide {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                box-shadow: none; /* remove light gray border/shadow */
                background: transparent; /* let the card's background show through */
                border-radius: 0.5rem;
                min-width: 60px; /* tweak as needed */
            }
        </style>
    </head>
    <!-- Light mode: bg-gray-100, dark mode: bg-gray-900 text-gray-100 -->
    <body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

            <!-- (1) Bitcoin Card -->
            <!-- Light mode: bg-white border-gray-200, dark mode: bg-gray-800 border-gray-700 -->
            <div class="card rounded-xl shadow border border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-700">
                <!-- Header: blue in light mode, slightly darker in dark mode -->
                <div class="px-4 py-3 rounded-t-xl bg-blue-600 dark:bg-blue-700 text-white">
                    <div class="flex items-center space-x-2">
                        <img
                            src="https://s2.coinmarketcap.com/static/img/coins/64x64/1.png"
                            alt="Bitcoin"
                            class="w-6 h-6"
                        >
                        <h2 class="text-lg font-semibold">Bitcoin</h2>
                    </div>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                        <!-- Current Price -->
                        <div>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Current Price</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">$50,000</p>
                        </div>
                        <!-- Last 1h -->
                        <div>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Last 1h</p>
                            <p class="text-lg font-bold text-green-500">+4.5%</p>
                            <p class="text-sm text-gray-400 dark:text-gray-500">$65,400</p>
                        </div>
                        <!-- Last 24h -->
                        <div>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Last 24h</p>
                            <p class="text-lg font-bold text-green-500">+2.3%</p>
                            <p class="text-sm text-gray-400 dark:text-gray-500">$64,000</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- (2) Weekly PnL Card with Swiper Slider -->
            <div class="card rounded-xl shadow border border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-700">
                <div class="px-4 py-3 rounded-t-xl bg-blue-600 dark:bg-blue-700 text-white">
                    <div class="flex items-center space-x-2">
                        <!-- Trending-up icon -->
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 17l6-6 4 4 8-8" />
                        </svg>
                        <h2 class="text-lg font-semibold">Weekly PnL</h2>
                    </div>
                </div>
                <div class="p-4 sm:p-6">
                    <!-- Swiper Container -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <!-- 7 slides (one for each day) -->
                            <div class="swiper-slide">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Mon</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">$100</p>
                            </div>
                            <div class="swiper-slide">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Tue</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">$150</p>
                            </div>
                            <div class="swiper-slide">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Wed</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">$200</p>
                            </div>
                            <div class="swiper-slide">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Thu</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">$50</p>
                            </div>
                            <div class="swiper-slide">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Fri</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">$300</p>
                            </div>
                            <div class="swiper-slide">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Sat</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">$0</p>
                            </div>
                            <div class="swiper-slide">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Sun</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">$250</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- (3) Current Total PnL Card -->
            <div class="card rounded-xl shadow border border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-700">
                <div class="px-4 py-3 rounded-t-xl bg-blue-600 dark:bg-blue-700 text-white">
                    <h2 class="text-lg font-semibold">Current Total PnL</h2>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                        <!-- Shorts -->
                        <div>
                            <div class="flex items-center justify-center space-x-1">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 text-red-500"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181"
                                    />
                                </svg>
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Shorts</p>
                            </div>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">$300</p>
                        </div>
                        <!-- Longs -->
                        <div>
                            <div class="flex items-center justify-center space-x-1">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 text-green-500"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"
                                    />
                                </svg>
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Longs</p>
                            </div>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">$900</p>
                        </div>
                        <!-- Total -->
                        <div>
                            <div class="flex items-center justify-center space-x-1">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 text-blue-500"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 4.5v15m7.5-7.5h-15"
                                    />
                                </svg>
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Total</p>
                            </div>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">$1,200</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Swiper JS (CDN) -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
          const swiper = new Swiper('.mySwiper', {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 16,
            grabCursor: true,
            // 7 slides on 2xl (1536px+)
            breakpoints: {
              1536: {
                slidesPerView: 7,
                slidesPerGroup: 7
              }
            }
          });
        </script>
    </body>
</html>
