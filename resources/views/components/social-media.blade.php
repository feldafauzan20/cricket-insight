<div>
    <h1 class="text-[#121212] dark:text-white font-semibold text-[16px]">Follow Us</h1>
    <div class="flex my-4 md:my-0 md:mt-4 md:mb-8">
        <div class="w-17.5 h-px bg-[#EC0226]"></div>
        <div class="w-full h-px bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-2 gap-3" id="social-media-cards">
        <x-cards.social-media-card name="Facebook" url="https://facebook.com" bg-color="bg-[#1877F2]">
            <x-slot:icon>
                <x-bi-facebook class="w-5 h-5 text-white" />
            </x-slot:icon>
        </x-cards.social-media-card>

        <x-cards.social-media-card name="X" url="https://x.com" bg-color="bg-black">
            <x-slot:icon>
                <x-bi-twitter-x class="w-4 h-4 text-white" />
            </x-slot:icon>
        </x-cards.social-media-card>

        <x-cards.social-media-card name="Youtube" url="https://youtube.com/@cricketindonesia8372"
            bg-color="bg-[#FF0000]">
            <x-slot:icon>
                <x-bi-youtube class="w-5 h-5 text-white" />
            </x-slot:icon>
        </x-cards.social-media-card>

        <x-cards.social-media-card name="Instagram" url="https://instagram.com/cricket_ina"
            bg-color="bg-linear-to-br from-[#833AB4] via-[#FD1D1D] to-[#FCAF45]">
            <x-slot:icon>
                <x-bi-instagram class="w-5 h-5 text-white" />
            </x-slot:icon>
        </x-cards.social-media-card>
    </div>

    <!-- Social Media Embed Container - Only visible on 2xl screens -->
    <div id="social-embed-container" class="hidden mt-4">
        <div class="relative">

            <div id="social-embed-content" class="mt-2"></div>
        </div>
    </div>
</div>
