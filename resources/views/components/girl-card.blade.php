@props(['girl', 'index' => 0])

<div x-data="(() => {
       const card = girlCard({{ json_encode($girl->gallery_images ?? []) }}, '{{ Storage::url($girl->featured_image) }}');
       const reveal = scrollReveal({{ $index * 100 }});
       return {
         ...card,
         ...reveal,
         init() {
           card.init.call(this);
           reveal.init.call(this);
         }
       };
     })()"
     @mouseenter="startPreview"
     @mouseleave="stopPreview"
     class="group relative bg-[#0A0A0A] aspect-[2/3] overflow-hidden
            border border-white/5 hover:border-[#C5A059] transition-all duration-500 cursor-pointer scroll-reveal"
     :class="{ 'is-visible': isVisible }">

  <a href="{{ route('girls.show', $girl) }}" class="block w-full h-full">
    <!-- Alpine-controlled image src -->
    <img :src="currentImage"
         :alt="'{{ $girl->name }}'"
         loading="lazy"
         class="absolute inset-0 w-full h-full object-cover
                transition-transform duration-700 group-hover:scale-105">

    <!-- Gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent
                opacity-80 group-hover:opacity-60 transition-opacity"></div>

    <!-- Card content -->
    <div class="absolute bottom-0 left-0 right-0 p-6
                translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
      <h3 class="text-2xl font-serif text-white group-hover:text-[#C5A059] transition-colors">
        {{ $girl->name }}
      </h3>

      <!-- Availability badges -->
      @php
        $orderedDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $girlDays = collect($girl->availability ?? [])->sortBy(function($day) use ($orderedDays) {
            return array_search($day, $orderedDays);
        });
      @endphp

      @if($girlDays->isNotEmpty())
        <div class="flex flex-wrap gap-2 mt-2">
          @foreach($girlDays as $day)
            <span class="px-2 py-1 rounded text-[10px] uppercase tracking-wide {{ $day === date('l') ? 'bg-[#C5A059] text-black font-medium' : 'bg-white/10 text-gray-300' }}">
              {{ substr($day, 0, 3) }}
            </span>
          @endforeach
        </div>
      @endif
    </div>

    <!-- Preview indicator dots -->
    <div x-show="isPreviewing"
         x-cloak
         class="absolute top-4 right-4 flex gap-1">
      <template x-for="(img, index) in images" :key="index">
        <div :class="currentIndex === index ? 'bg-[#C5A059]' : 'bg-white/30'"
             class="w-1.5 h-1.5 rounded-full transition-colors"></div>
      </template>
    </div>
  </a>
</div>
