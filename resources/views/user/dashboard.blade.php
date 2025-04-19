<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-blue-600 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">Dashboard</h1>
                <nav>
                    <a href="#" class="text-white hover:underline">Logout</a>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- View Partners -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-bold mb-4">View Partners</h2>
                    <p class="text-gray-600">Manage and connect with your study partners.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View</a>
                </div>

                <!-- Upcoming/Past Sessions -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-bold mb-4">Sessions</h2>
                    <p class="text-gray-600">Track your upcoming and past sessions.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Sessions</a>
                </div>

                <!-- Streaks -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-bold mb-4">Streaks</h2>
                    <p class="text-gray-600">Keep track of your daily streaks.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Streaks</a>
                </div>

                <!-- Progress -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-bold mb-4">Progress</h2>
                    <p class="text-gray-600">Monitor your overall progress.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Progress</a>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white p-4">
            <div class="container mx-auto text-center">
                <p>&copy; 2023 Quran Revision App. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>