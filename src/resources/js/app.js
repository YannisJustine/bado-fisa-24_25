import.meta.glob([
    '../images/**',
]);

import './bootstrap';
import './dark'
import '../css/app.css';
import 'flowbite';

import '../sass/app.sass';
import Alpine from 'alpinejs'
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import Calendar from './vue/Calendar.vue';
import Planning from './vue/Planning.vue';
import Map from './vue/Components/Map.vue';

const app = createApp()
const StatutEnum = {
    ATTENTE : 0,
    IMPOSSIBLE : 1,
    REFUSE : 2,
    PLANIFIE : 3,
}
const StatutInfo = {
    0: { text: "En attente", "bg-color": "bg-yellow-300", "text-color" : "text-yellow-300" },
    1: { text: "Impossible", "bg-color": "bg-red-300", "text-color" : "text-yellow-300" },
    2: { text: "Refusé", "bg-color": "bg-red-300", "text-color" : "text-yellow-300" },
    3: { text: "Planifié", "bg-color": "bg-green-300", "text-color" : "text-yellow-300" },
};


const options = {
    defaultTabId: null,
    activeClasses:
        'text-logo-orange-600 hover:text-logo-orange-600 dark:text-logo-orange-500 border-logo-orange-600 dark:border-logo-orange-500',
    inactiveClasses:
        'text-gray-500 hover:text-logo-orange-600 dark:text-gray-400 border-gray-100 hover:border-logo-orange-300 dark:border-gray-700 dark:hover:text-logo-orange-300 dark:hover:border-logo-orange-300',
    onShow: () => {
    },
};


initTabs = () =>{
    document.querySelectorAll('[data-tabs-toggle]').forEach(function ($parentEl) {
        var tabItems = [];
        var currentOptions = options;
        $parentEl
            .querySelectorAll('[role="tab"]')
            .forEach(function ($triggerEl) {
            var isActive = $triggerEl.getAttribute('aria-selected') === 'true';
            var tab = {
                id: $triggerEl.getAttribute('data-tabs-target'),
                triggerEl: $triggerEl,
                targetEl: document.querySelector($triggerEl.getAttribute('data-tabs-target')),
            };
            tabItems.push(tab);
            if (isActive) {
                currentOptions.defaultTabId = tab.id;
            }
        });
        new Tabs($parentEl, tabItems, options, {
            id: $parentEl.getAttribute('data-tabs-toggle'),
            override: true,
        });
    });
};


if(document.getElementById('app')) {
    app.provide('StatutEnum', StatutEnum);
    app.provide('StatutInfo', StatutInfo);
    app.component('Calendar', Calendar);
    app.component('Planning', Planning);
    app.component('CustomMap', Map);
    app.mount('#app');
}

window.Alpine = Alpine;
Alpine.start();