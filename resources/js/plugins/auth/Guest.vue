<script>
    export default {
        render()
        {
            if (!this.$store.getters['auth/guest'])
            {
                return null;
            }

            return this.$slots.default;
        },
    };
</script>
