<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Home</title>

    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">My Blog</h1>
            <nav class="space-x-4">
                <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
                <a href="#posts" class="text-gray-700 hover:text-blue-600 font-medium">Posts</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">About</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12 space-y-16">

        <!-- Hero Section -->
        <section class="relative bg-blue-50 rounded-3xl overflow-hidden shadow-lg flex flex-col md:flex-row items-center gap-8 p-12">
            <div class="md:w-1/2 space-y-6">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 leading-tight">
                    Welcome to the Ultimate Tech Blog
                </h2>
                <p class="text-gray-600 text-lg">
                    Explore tutorials, articles, and insights from our expert team. Stay updated with the latest trends in technology, design, and development.
                </p>
                <a href="#posts" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                    Explore Posts
                </a>
            </div>
            <div class="md:w-1/2">
                <img src="https://png.pngtree.com/png-clipart/20241125/original/pngtree-robot-photo-png-image_17308416.png" alt="Hero Image" class="rounded-3xl shadow-lg object-cover w-full h-80 md:h-full">
            </div>
        </section>

        <!-- Blog Posts Cards -->
        <section id="posts">
            <h3 class="text-3xl font-bold text-gray-800 mb-8">Latest Posts</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">
                    <img src="https://www.junkiescoder.com/wp-content/uploads/2025/10/Emerging-Front-End-Tech-Skills-for-2026-Blog.jpg" alt="Post 1" class="w-full h-56 object-cover">
                    <div class="p-6 space-y-4">
                        <h4 class="text-xl font-semibold text-gray-800">Mastering Web Development in 2026</h4>
                        <p class="text-gray-600 text-sm line-clamp-3">
                            Learn the latest frameworks, tools, and best practices to become a pro web developer.
                        </p>
                        <a href="#" class="text-blue-600 font-medium hover:underline">Read More →</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1603791440384-56cd371ee9a7?auto=format&fit=crop&w=800&q=80" alt="Post 2" class="w-full h-56 object-cover">
                    <div class="p-6 space-y-4">
                        <h4 class="text-xl font-semibold text-gray-800">UI/UX Design Trends You Should Know</h4>
                        <p class="text-gray-600 text-sm line-clamp-3">
                            Discover the most modern UI/UX practices that enhance user experience and engagement.
                        </p>
                        <a href="#" class="text-blue-600 font-medium hover:underline">Read More →</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">
                    <img src="https://astract.com/wp-content/uploads/2024/09/IMG_3622.png" alt="Post 3" class="w-full h-56 object-cover">
                    <div class="p-6 space-y-4">
                        <h4 class="text-xl font-semibold text-gray-800">10 Productivity Tips for Developers</h4>
                        <p class="text-gray-600 text-sm line-clamp-3">
                            Boost your coding workflow with practical tips that save time and increase efficiency.
                        </p>
                        <a href="#" class="text-blue-600 font-medium hover:underline">Read More →</a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-white mt-16 shadow-inner">
        <div class="max-w-7xl mx-auto px-6 py-6 text-center text-gray-500 text-sm">
            &copy; 2026 My Blog. All rights reserved.
        </div>
    </footer>

</body>
</html>
