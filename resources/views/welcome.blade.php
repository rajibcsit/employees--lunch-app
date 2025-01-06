@extends('layouts.app')

@section('content')

<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="container mx-auto px-4 py-16">
        <section class="flex flex-wrap items-center justify-between">
            <div class="w-full lg:w-1/2 mb-10 lg:mb-0">
                <h1 class="text-5xl font-extrabold leading-tight text-pink-600">Effortless Lunch Management</h1>
                <p class="text-lg text-gray-600 mt-6">Track and manage employee lunches with ease. A seamless solution designed for efficiency.</p>
                <button class="mt-8 px-6 py-3 bg-pink-600 text-white text-lg rounded-lg shadow-lg hover:bg-pink-500">
                    Get Started
                </button>
            </div>
            <div class="w-full lg:w-1/2">
                <img src="{{ asset('hero.png') }}" alt="Lunch Entry Illustration" class="w-full max-w-lg mx-auto rounded-xl shadow-xl">
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="mt-24 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-12">Why Choose Our System?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="text-pink-600 text-5xl mb-6">&#x1F4C8;</div>
                    <h3 class="text-xl font-bold mb-4">Efficiency</h3>
                    <p class="text-gray-600">Log your lunch entries in seconds and manage records effortlessly.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="text-pink-600 text-5xl mb-6">&#x1F4BB;</div>
                    <h3 class="text-xl font-bold mb-4">Integration</h3>
                    <p class="text-gray-600">Easily integrates with your existing employee database.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="text-pink-600 text-5xl mb-6">&#x1F4B8;</div>
                    <h3 class="text-xl font-bold mb-4">Transparency</h3>
                    <p class="text-gray-600">Keep track of expenses, preferences, and meal logs with ease.</p>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="mt-24 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-12">
                How It Works
            </h2>
            <p class="text-gray-600 text-lg mb-8 max-w-3xl mx-auto">
                Our streamlined system ensures a smooth experience for employees and administrators alike. Follow these simple steps to get started!
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 px-6 md:px-0">
                <div class="bg-white p-8 rounded-lg shadow-lg transition-transform transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-pink-600 text-5xl mb-6">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Step 1: Register</h3>
                    <p class="text-gray-600">
                        Employees sign up and create their accounts to access the lunch management system.
                    </p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg transition-transform transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-pink-600 text-5xl mb-6">
                        <i class="fa fa-utensils"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Step 2: Log Preferences</h3>
                    <p class="text-gray-600">
                        Employees log their lunch preferences and submit entries in seconds.
                    </p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg transition-transform transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-pink-600 text-5xl mb-6">
                        <i class="fa fa-chart-line"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Step 3: Track Entries</h3>
                    <p class="text-gray-600">
                        Administrators review and track entries to ensure seamless management.
                    </p>
                </div>
            </div>
        </section>

        <!-- Features at a Glance - Cards -->
        <section class="mt-24">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Features at a Glance</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-gradient-to-r from-pink-500 to-pink-400 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold mb-3">Daily Lunch Tracking</h3>
                    <p>Record and monitor daily lunch orders effortlessly.</p>
                </div>
                <div class="bg-gradient-to-r from-blue-500 to-blue-400 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold mb-3">Automated Reports</h3>
                    <p>Generate detailed reports automatically for analysis.</p>
                </div>
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-400 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold mb-3">Mobile Compatibility</h3>
                    <p>Log entries from any device with mobile support.</p>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-green-400 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold mb-3">Employee Interface</h3>
                    <p>A user-friendly interface for employees to manage lunches.</p>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="mt-32 bg-pink-600 py-20 text-center text-white rounded-lg shadow-lg">
            <h2 class="text-5xl font-bold mb-8">Start Managing Lunches Today!</h2>
            <p class="text-lg mb-12">Simplify lunch entry, reduce administrative work, and empower employees.</p>
            <button class="bg-white text-pink-600 text-lg px-8 py-4 rounded-full shadow-lg hover:bg-pink-100">
                Get Started Now
            </button>
        </section>
    </div>
</div>
@endsection