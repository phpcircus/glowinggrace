<template>
    <div class="mt-2">
        <span class="text-red-500 text-sm font-semibold italic block">{{errors[0]}}</span>
    </div>
</template>

<script>
export default {
    props: ['errors'],
}
</script>
