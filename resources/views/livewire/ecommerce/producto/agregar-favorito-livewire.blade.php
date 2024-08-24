<div>
    <button wire:click="toggleFavorito">
        @if ($esFavorito)
            <i class="fa-solid fa-heart"></i>
        @else
            <i class="fa-regular fa-heart"></i>
        @endif
    </button>
</div>
