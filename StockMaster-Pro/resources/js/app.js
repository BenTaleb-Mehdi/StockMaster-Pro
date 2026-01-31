import "./bootstrap";
import "preline";
import { createIcons, icons } from 'lucide';

createIcons({ icons });

document.addEventListener('livewire:init', () => {
    Livewire.hook('morph.updated', ({ el, component }) => {
        createIcons({ icons });
    });
});
