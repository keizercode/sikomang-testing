@props([
    'image' => '',
    'date' => '',
    'author' => 'Admin, DLH Jakarta',
    'title' => '',
    'excerpt' => '',
    'link' => '#'
])

<article class="article-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg">
    {{-- Article Image --}}
    <div class="aspect-[4/3] overflow-hidden">
        <img
            src="{{ $image }}"
            alt="{{ $title }}"
            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
        >
    </div>

    {{-- Article Content --}}
    <div class="p-5">
        {{-- Meta Info --}}
        <div class="flex items-center space-x-2 text-sm text-muted mb-3">
            <span>{{ $date }}</span>
            <span class="text-gray-300">|</span>
            <div class="flex items-center space-x-1">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="font-medium text-secondary">{{ $author }}</span>
            </div>
        </div>

        {{-- Title --}}
        <h3 class="text-lg font-bold text-secondary mb-2 line-clamp-2 hover:text-primary transition-colors">
            <a href="{{ $link }}">{{ $title }}</a>
        </h3>

        {{-- Excerpt --}}
        <p class="text-sm text-muted leading-relaxed mb-4 line-clamp-4">
            {{ $excerpt }}
        </p>

        {{-- Read More Link --}}
        <a
            href="{{ $link }}"
            class="inline-flex items-center text-primary font-semibold text-sm hover:text-primary-dark transition-colors"
        >
            Selengkapnya
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</article>
