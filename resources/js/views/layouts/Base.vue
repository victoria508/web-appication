<template>
    <navbar></navbar>
    <router-view></router-view>
</template>

<script>
    import navbar from './navbar.Vue'

    export default {
        comments: {
            navbar,
        },
    }
</script>
