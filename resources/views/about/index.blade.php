<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meet our team') }}
        </h2>
    </x-slot>

    <div class="mx-auto bg-white p-6 flex flex-col items-center justify-center">
        <!-- ITEM 1 (Alex Gonzalez) -->
        <div class="max-w-5xl mx-auto flex mb-8 rounded-md" id="persona1">
            <div class="flex-shrink-0 mr-8">
                <img src="{{ asset('image/usuario.png') }}" id="imagen1" alt="Image" class="w-32 h-32 rounded-full">
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-2">Alex Gonzalez</h2>
                <p class="text-gray-700 mb-2">Ingeniero de software apasionado por la resolución creativa de problemas. Amante de la música clásica y pianista en sus momentos libres...
                    <a href="{{ route('about.alex') }}" class="text-blue-600 hover:underline">Leer mas</a>
                </p>
                <p class="text-gray-500" id="cargo1">Ingeniero de Software</p>
            </div>
        </div>

        <!-- ITEM 2 (Younes) -->
        <div class="max-w-5xl mx-auto flex mb-8 py-4 rounded-md" id="persona2">
            <div class="flex-shrink-0 mr-8">
                <img src="{{ asset('image/usuario.png') }}" id="imagen2" alt="Image" class="w-32 h-32 rounded-full">
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-2">Younes</h2>
                <p class="text-gray-700 mb-2">Aventurero y fotógrafo de viajes que encuentra inspiración en los rincones del mundo. Captura momentos únicos desde las calles de Tokio hasta los paisajes serenos de la Patagonia...
                    <a href="{{ route('about.younes') }}" class="text-blue-600 hover:underline">Leer mas</a>
                </p>
                <p class="text-gray-500" id="cargo2">Fotógrafo de Viajes</p>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function setupPersonaEvents(personaId, cargoId, imagenId, originalImage, modifiedImage, hoverText, defaultText) {
        const cargo = document.getElementById(cargoId);
        const imagen = document.getElementById(imagenId);

        document.getElementById(personaId).addEventListener('mouseout', function() {
            cargo.innerText = defaultText;
            imagen.src = originalImage;
        });

        document.getElementById(personaId).addEventListener('mouseover', function() {
            cargo.innerText = hoverText;
            imagen.src = modifiedImage;
        });
    }

    setupPersonaEvents('persona1', 'cargo1', 'imagen1', "{{ asset('image/usuario.png') }}", "{{ asset('image/usuario-modified.png') }}", "Explorar sabores y texturas en la cocina es mi forma de arte culinario.", "Ingeniero de Software.");
    setupPersonaEvents('persona2', 'cargo2', 'imagen2', "{{ asset('image/usuario.png') }}", "{{ asset('image/usuario-modified.png') }}", "A través de la lente de mi cámara, capturo momentos efímeros que cuentan historias", "Fotógrafo de Viajes.");
</script>
