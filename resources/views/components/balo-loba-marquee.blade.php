<div x-data="marquee" x-init="init()" class="relative w-full bg-black container-block">
    <div
        class="relative w-full py-3 overflow-hidden tracking-wide text-white uppercase bg-black sm:text-xs md:text-sm lg:text-base xl:text-xl 2xl:text-2xl">
        <!-- Left gradient -->
        <div class="absolute left-0 z-20 w-40 h-full bg-gradient-to-r from-black to-transparent"></div>
        <!-- Right gradient -->
        <div class="absolute right-0 z-20 w-40 h-full bg-gradient-to-l from-black to-transparent"></div>
        <!-- Marquee Content -->
        <div x-ref="content" class="flex animate-marquee">
            <div x-ref="item"
                class="flex items-center justify-around flex-shrink-0 w-full px-2 py-2 text-xl text-white sm:text-2xl md:text-4xl xl:text-8xl">
                <p class="w-auto translate-y-0.5 fill-current">BALO</p>
                <p class="w-auto translate-y-0.5 fill-current">LOBA</p>
                <p class="w-auto translate-y-0.5 fill-current">•</p>
                <p class="w-auto translate-y-0.5 fill-current">BALO</p>
                <p class="w-auto translate-y-0.5 fill-current">LOBA</p>
                <p class="w-auto translate-y-0.5 fill-current">•</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('marquee', () => ({
            init() {
                this.cloneItem();
            },
            cloneItem() {
                const content = this.$refs.content;
                const item = this.$refs.item;
                const clone = item.cloneNode(true);
                content.appendChild(clone);
            }
        }));
    });
</script>

<style>
    /* Marquee Animation */
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-300%);
        }
    }

    .animate-marquee {
        animation: marquee 20s linear infinite;
    }

    /* Container query example */
    .container-block {
        container-type: inline-size;
    }

    @container (max-width: 1100px) {
        .container-block svg:nth-child(3),
        .container-block svg:nth-child(4) {
            display: none;
        }
    }
</style>