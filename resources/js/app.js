import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/vue3';  // Import Link here
import { InertiaProgress } from '@inertiajs/progress';
InertiaProgress.init();
createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('Link', Link)
            .mount(el);
    },
});
