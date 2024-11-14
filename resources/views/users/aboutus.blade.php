@extends('layout.user')

@section('users')
    <div class="bg-gray-100 text-gray-900 flex justify-center py-10">
        <div class="max-w-screen-lg m-0 sm:m-10 bg-white shadow sm:rounded-lg p-6 sm:p-12">
            <div class="text-center flex justify-center flex-col items-center">
                <img src="{{ asset('assets/logo.png') }}" class="w-40 mb-10" data-aos="fade-right">
                <h1 class="text-4xl font-bold mb-4">About ClubConnect</h1>
                <p class="text-lg mb-6">Connecting Passionate Individuals Across Diverse Clubs</p>
            </div>

            <div class="mt-8" data-aos="">
                <h2 class="text-3xl font-semibold mb-4">Our Mission</h2>
                <p class="text-gray-700 mb-6">
                    At ClubConnect, our mission is to foster a vibrant community where enthusiasts and learners can connect, share their passions, and grow together. We aim to provide a platform that facilitates meaningful interactions, organizes exciting events, and helps build lasting friendships.
                </p>
            </div>

            <div class="mt-8">
                <h2 class="text-3xl font-semibold mb-4">What We Offer</h2>
                <p class="text-gray-700 mb-6">
                    ClubConnect offers a wide range of features to enhance your club experience:
                </p>
                <ul class="list-disc list-inside text-gray-700 mb-6">
                    <li>Discover and join clubs that match your interests.</li>
                    <li>Participate in events, workshops, and meetups.</li>
                    <li>Connect with like-minded individuals and build your network.</li>
                    <li>Access resources and tools to manage and grow your clubs.</li>
                    <li>Stay updated with the latest news and announcements from your favorite clubs.</li>
                </ul>
            </div>

            <div class="mt-8">
                <h2 class="text-3xl font-semibold mb-4">Our Story</h2>
                <p class="text-gray-700 mb-6">
                    ClubConnect was built to let viewers of the website know about the different clubs and events being held at a particular college by the clubs. It was also built for smooth collaboration, helping clubs connect and manage their activities effectively.
                </p>
                <p class="text-gray-700 mb-6">
                    Since our inception, we have grown into a thriving community that spans various interests and fields. From academic clubs to hobby groups, ClubConnect is home to a diverse array of clubs that cater to everyone.
                </p>
            </div>

            <div class="mt-8">
                <h2 class="text-3xl font-semibold mb-4">Join Us</h2>
                <p class="text-gray-700 mb-6">
                    Whether you are looking to join a club or start one of your own, ClubConnect is here to help you every step of the way. Explore our platform, connect with others, and become a part of our growing community.
                </p>
                <p class="text-gray-700 mb-6">
                    Together, let's make ClubConnect a place where passions come to life and friendships are forged.
                </p>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('clubs.userclub') }}" class="bg-purple-500 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition duration-300">
                    Explore Clubs
                </a>
            </div>
        </div>
    </div>
@endsection
