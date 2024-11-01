<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="style.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="bg-white" x-data="{ isOpen: false }">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-20 w-auto" src="img/logop.png" alt="">
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button" @click="isOpen = !isOpen"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                <div class="hidden items-center lg:flex lg:gap-x-12">
                    <a href="/" class="text-sm/6 font-semibold text-gray-900">Home</a>
                    <a href="/about" class="text-sm/6 font-semibold text-gray-900">About</a>
                    <a href="/contact" class="text-sm/6 font-semibold text-gray-900">Contact</a>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                </div>
            </nav>
            <!-- Mobile menu, show/hide based on menu open state. -->
            <div class="lg:hidden" x-show="isOpen" @click.outside="isOpen = false" role="dialog" aria-modal="true">
                <!-- Background backdrop, show/hide based on slide-over state. -->
                <div class="fixed inset-0 z-50"></div>
                <div
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-8 w-auto"
                                src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="">
                        </a>
                        <button type="button" @click="isOpen = false" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Home</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">About</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Contact</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Company</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
            aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>

    <div class="bg-gray-900 text-gray-400">
        <footer class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8 xl:col-span-1">
                    <img alt="Company Logo" class="h-30 w-40" height="50"
                        src="/img/logop.png"
                        width="50" />
                    <p class="text-gray-400 text-base">
                        Making the world a better place through constructing elegant hierarchies.
                    </p>
                    <div class="flex space-x-6">
                        <a class="text-gray-400 hover:text-gray-300" href="#">
                            <span class="sr-only">
                                Facebook
                            </span>
                            <i class="fab fa-facebook-f">
                            </i>
                        </a>
                        <a class="text-gray-400 hover:text-gray-300" href="#">
                            <span class="sr-only">
                                Instagram
                            </span>
                            <i class="fab fa-instagram">
                            </i>
                        </a>
                        <a class="text-gray-400 hover:text-gray-300" href="#">
                            <span class="sr-only">
                                Twitter
                            </span>
                            <i class="fab fa-x-twitter">
                            </i>
                        </a>
                        <a class="text-gray-400 hover:text-gray-300" href="#">
                            <span class="sr-only">
                                GitHub
                            </span>
                            <i class="fab fa-github">
                            </i>
                        </a>
                        <a class="text-gray-400 hover:text-gray-300" href="#">
                            <span class="sr-only">
                                YouTube
                            </span>
                            <i class="fab fa-youtube">
                            </i>
                        </a>
                    </div>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Solutions
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Marketing
                                    </a>
                                </li>
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Analytics
                                    </a>
                                </li>
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Automation
                                    </a>
                                </li>
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Commerce
                                    </a>
                                </li>
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Insights
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Support
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Submit ticket
                                    </a>
                                </li>
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Documentation
                                    </a>
                                </li>
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Guides
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Company
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        About
                                    </a>
                                </li>
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Blog
                                    </a>
                                </li>
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Jobs
                                    </a>
                                </li>
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Press
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Legal
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Terms of service
                                    </a>
                                </li>
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        Privacy policy
                                    </a>
                                </li>
                                <li>
                                    <a class="text-base text-gray-400 hover:text-gray-300" href="#">
                                        License
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-700 pt-8">
                <p class="text-base text-gray-400 xl:text-center">
                    © 2024 Your Company, Inc. All rights reserved.
                </p>
            </div>
        </footer>
    </div>

</body>

</html>