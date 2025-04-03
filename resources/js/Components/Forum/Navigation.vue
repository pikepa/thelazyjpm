<script setup >
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <nav>
                <ul class="space-y-2">
                    <li>
                        <Link href="/">All discussions</Link>
                    </li>
                    <li>
                        <Link href="/?filter[noreplies]=1">No Replies</Link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>