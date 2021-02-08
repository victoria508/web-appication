<script>
    export default {
        render(h)
        {
            if (!this.$store.getters['auth/authenticated'])
            {
                return null;
            }

            return this.$scopedSlots.default({
                user: this.$store.state.auth.user,
            });
        },
    };
</script>
