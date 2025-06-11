<div>
    <figure class="h-auto md:h-72 flex flex-col md:flex-row
                    rounded-none sm:rounded-xl
                    bg-zinc-50  dark:bg-gray-900
                    border border-zinc-200
                    my-4 p-8 md:p-0">
        <a class="h-48 w-48 md:h-72 md:w-72 md:min-w-72  mx-auto" href="{{ route('products.show', ['product' => $product]) }}">
            <img class="h-full aspect-auto mx-auto rounded-full
                        md:rounded-l-xl md:rounded-r-none" src="{{ $product->imageUrl }}">
        </a>
        <div class="h-auto p-6 text-center md:text-left space-y-1 flex flex-col">
            <a class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-5" href="{{ route('products.show', ['product' => $product]) }}">
                {{ $product->name }}
            </a>
            <figcaption class="font-medium">
                <div class="flex justify-center md:justify-start font-base
                            text-base space-x-6 text-gray-700 dark:text-gray-300">
                    <div>{{ $product->semesters }} semesters</div>
                    <div>{{ $product->ECTS }} ECTS</div>
                    <div>{{ $product->places }} places</div>
                </div>
                <address class="font-light text-gray-700 dark:text-gray-300">
                    <a href="mailto:{{ $product->contact }}">{{ $product->contact }}</a>.
                </address>
            </figcaption>
            <p class="pt-4 font-light text-gray-700 dark:text-gray-300 overflow-y-auto">
                {{ $product->objectives }}
            </p>
        </div>
    </figure>
</div>
