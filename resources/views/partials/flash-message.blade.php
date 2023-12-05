@php
$tailwindClass = [
    'success' => 'p-5 text-[#0f5132] bg-[#d1e7dd] border border-[#badbcc] rounded',
    'danger'  => 'p-5 text-[#842029] bg-[#f8d7da] border border-[#f5c2c7] rounded',
    'warning' => 'p-5 text-[#664d03] bg-[#fff3cd] border border-[#ffecb5] rounded',
    'info'    => 'p-5 text-[#055160] bg-[#cff4fc] border border-[#b6effb] rounded',
]
@endphp
<div class="{{ $tailwindClass[$type] }} relative" role="alert">
    {{ $message }}
    <button type="button" class="float-right" data-dismiss-target="alert" aria-label="Close" onclick="closeAlert(this)">X</button>
</div>

<script>
    function closeAlert(button) {
        // Encuentra el elemento padre del botón (el div que contiene el mensaje)
        var alertDiv = button.closest('.relative');
        
        // Oculta el elemento del mensaje
        alertDiv.style.display = 'none';
    }
</script>
