<template>
    <footer class="bg-purple-700 text-gray-100 px-4 md:px-12 pt-0 pb-4 mt-0">
        <div class="container mx-auto pt-8">
            <div class="flex flex-wrap mb-6 px-4">
                <div class="w-full md:w-1/2 text-center md:text-left px-3 mb-2 md:mb-0 pb-3 sm:pb-0">
                    <p class="font-sigmar text-teal-400 font-bold text-3xl my-6">Glowing<span class="text-teal-100">Grace</span></p>
                    <p class="text-gray-200 font-normal text-sm my-3">maintained by: &nbsp;<a class="font-medium hover:text-blue-200" :href="meta.admin.sites.github.url">{{ meta.admin.sites.github.profile }}</a></p>
                    <p class="text-gray-200 font-normal text-sm my-3">base template: &nbsp;<a class="font-medium hover:text-blue-200" :href="meta.links.template.url">{{ meta.links.template.name }}</a></p>
                </div>
                <div class="w-full md:w-1/2 text-center md:text-left px-3 sm:px-1 mb-2 md:mb-0 pb-3 sm:pb-0">
                    <p class="text-teal-400 font-medium text-xl my-6">My favorite podcasts:</p>
                    <ul>
                        <li class="mb-3"><a class="text-lg font-medium hover:text-blue-200" href="https://noplanstomerge.simplecast.com/" target="_blank" rel="noopener">No Plans To Merge</a></li>
                        <li class="mb-3"><a class="text-lg font-medium hover:text-blue-200" href="https://syntax.fm/" target="_blank" rel="noopener">SyntaxFM</a></li>
                        <li class="mb-3"><a class="text-lg font-medium hover:text-blue-200" href="https://laracasts.com/podcast" target="_blank" rel="noopener">Laracasts Snippet</a></li>
                    </ul>
                </div>
            </div>
            <p class="py-3 text-center">
                <a class="font-medium hover:text-blue-200" :href="meta.admin.sites.twitter.url" target="_blank" rel="noopener"><svg class="inline fill-current text-brand-ondark w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Twitter - Kimberlyn Stone</title><path d="M6.29 18.25c7.55 0 11.67-6.25 11.67-11.67v-.53c.8-.59 1.49-1.3 2.04-2.13-.75.33-1.54.55-2.36.65a4.12 4.12 0 0 0 1.8-2.27c-.8.48-1.68.81-2.6 1a4.1 4.1 0 0 0-7 3.74 11.65 11.65 0 0 1-8.45-4.3 4.1 4.1 0 0 0 1.27 5.49C2.01 8.2 1.37 8.03.8 7.7v.05a4.1 4.1 0 0 0 3.3 4.03 4.1 4.1 0 0 1-1.86.07 4.1 4.1 0 0 0 3.83 2.85A8.23 8.23 0 0 1 0 16.4a11.62 11.62 0 0 0 6.29 1.84" /></svg></a>
            </p>
        </div>
    </footer>
</template>

<script>
import { config } from 'Config';

export default {
    store: ['meta'],
}
</script>
