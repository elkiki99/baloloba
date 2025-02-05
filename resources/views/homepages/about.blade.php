<x-app-layout>
    <div class="flex flex-col pt-12 space-y-32 sm:pt-0">
        <!-- Header -->
        @php
            $header = \App\Models\Header::where('id', 3)->first() ?? null;
        @endphp

        @if ($header)
            <livewire:headers.show :header="$header" />
        @else
            <div class="min-h-[20vh] bg-white"></div>
        @endif

        <!-- Studio -->
        @php
            $section = \App\Models\Section::where('id', 2)->first();
        @endphp

        @if ($section)
            <livewire:sections.show.my-study :section="$section" />
        @endif
        
        <style>
            @keyframes typing {
                0% {
                    width: 0;
                }

                100% {
                    width: 100%;
                }
            }

            .typing-effect {
                display: inline-block;
                overflow: hidden;
                white-space: nowrap;
                max-width: 100%;
                border-right: 4px solid black;
                animation: typing 3s steps(30, end) 1s forwards, blink-caret 0.75s step-end 3s infinite;
            }

            @keyframes blink-caret {
                50% {
                    border-color: transparent;
                }
            }
        </style>
</x-app-layout>
